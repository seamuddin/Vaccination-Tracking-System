<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Committee\Models\Committee;
// use App\Modules\Committee\Models\CommitteeType;
use App\Modules\Event\Models\Event;
use App\Modules\Instructor\Models\Instructor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Modules\Child\Models\Child;
use App\Modules\Vaccine\Models\Vaccine;
use App\Modules\Vaccine\Models\VaccinationRecord;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Carbon\Carbon;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ChildRegistrationRequests;

class FrontendController extends Controller
{

    public function home()
    {
        try {
            // Get the most popular vaccination center based on the number of vaccination records
            $popularCenters = DB::table('vaccination_records as vr')
                ->join('vaccination_centers as vc', 'vr.vaccination_center_id', '=', 'vc.id')
                ->select('vc.id', 'vc.name', DB::raw('COUNT(vr.id) as total_visits'))
                ->groupBy('vc.id', 'vc.name')
                ->orderByDesc('total_visits')
                ->limit(5)
                ->get();

            $allCenters = DB::table('vaccination_centers')->get();

            // Optionally, pass $popularCenter to the view if needed
            return view('frontend.pages.home', compact('popularCenters', 'allCenters'));
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@home ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('frontend.index', ['error' => 'Unable to retrieve frontend data.']);
        }
    }

    public function guardianPortfolio()
    {
        try {

            // Assuming you have a Child model and user_id is the foreign key
            $user = auth()->user();
            $children = Child::where('parent_id', $user->id)->get();

            // Get upcoming vaccines for the children in the next 30 days
            $upcomingVaccines = [];
            $now = now();
            $in30Days = now()->addDays(30);

            foreach ($children as $child) {
                // Assuming you have a relationship 'vaccines' on Child model
                // Assuming you have a relationship 'vaccineRecords' on Child model
                $vaccineRecords = $child->vaccineRecords()
                    ->whereBetween('next_due_date', [$now, $in30Days])
                    ->orderBy('next_due_date', 'asc')
                    ->get();
                $upcomingVaccines = $vaccineRecords;

            }

            

            // Pass $vaccinationProgress to the view

            // Pass $upcomingVaccines to the view
            return view('parent-dashboard.guardian-dashboard', compact('children','upcomingVaccines'));
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@guardianPortfolio ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            dd($e->getMessage());
            return view('parent-dashboard.guardian-dashboard', ['error' => 'Unable to retrieve guardianPortfolio data.']);
        }
    }

    public function childRegisterForm()
    {
        try {
            return view('parent-dashboard.child-registration');
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@childRegisterForm ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('parent-dashboard.child-registration', ['error' => 'Unable to retrieve child registration form.']);
        }
    }

    public function childRegisterStore(ChildRegistrationRequests $request)
    {

        try {
            DB::beginTransaction();

            $user = auth()->user();

            // Handle file upload
            $folder = 'children_certificate';
            $storagePath = storage_path('app/public/' . $folder);

            if (!file_exists($storagePath)) {
            mkdir($storagePath, 0777, true);
            }

            if ($request->hasFile('birth_certificate')) {
                $file = $request->file('birth_certificate');
                $filename = 'birth_certificate_' . date('Ymd_His') . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $publicPath = public_path('uploads/' . $folder);
                if (!file_exists($publicPath)) {
                    mkdir($publicPath, 0777, true);
                }
                $file->move($publicPath, $filename);
                $filePath = 'uploads/' . $folder . '/' . $filename;
            } else {
                $filePath = null;
            }

            // Generate unique card number
            do {
            $card_no = 'VACC-' . strtoupper(uniqid()) . rand(10000, 99999);
            } while (\App\Modules\Child\Models\Child::where('card_no', $card_no)->exists());

            // Store child data
            $child = new Child();
            $child->name = $request->input('name');
            $child->date_of_birth = $request->input('dob');
            $child->gender = $request->input('gender');
            $child->guardian_name = $user->name;
            $child->guardian_contact = $user->phone ?? null;
            $child->birth_certificate_no = $request->input('birth_certificate_no');
            $child->birth_certificate = $filePath;
            $child->parent_id = $user->id;
            $child->card_no = $card_no;
            $child->save();

            $vaccines = Vaccine::all();
            $birthDate = \Carbon\Carbon::parse($child->date_of_birth);

            foreach ($vaccines as $vaccine) {
                for ($dose = 1; $dose <= $vaccine->number_of_doses; $dose++) {
                    $dueDate = $birthDate->copy()->addDays(
                    $vaccine->age_due_days + ($vaccine->dose_interval_days * ($dose - 1))
                    );

                    VaccinationRecord::create([
                    'child_id' => $child->id,
                    'vaccine_id' => $vaccine->id,
                    'dose_number' => $dose,
                    'next_due_date' => $dueDate,
                    'status' => 'scheduled',
                    'health_worker_id' => auth()->id(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('guardian.child.list')->with('success', 'Child registered successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Error occurred in FrontendController@childRegisterStore ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return redirect()->back()->withErrors(['error' => 'Unable to register child.']);
        }
    }

    public function gurdianProfile()
    {
        try {
            // Assuming you have a User model and the authenticated user is available
            $user = auth()->user();
            return view('parent-dashboard.profile', compact('user'));
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@gurdianProfile ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('parent-dashboard.child-profile', ['error' => 'Unable to retrieve guardian profile.']);
        }
    }

    public function childProfile($id)
    {
        try {
            $user = auth()->user();
            $child = Child::where('id', $id)
                ->where('user_id', $user->id)
                ->firstOrFail();
            return view('parent-dashboard.child-profile', compact('child'));
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@childProfile ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('parent-dashboard.child-profile', ['error' => 'Unable to retrieve child profile.']);
        }
    }

    public function childVaccinationRecords($id)
    {
        try {
            // Fetch the child record first
            $child = Child::where('id', $id)->firstOrFail();
            // Vaccination report query
            $report = DB::table('vaccination_records as vr')
                ->join('vaccines as v', 'vr.vaccine_id', '=', 'v.id')
                ->select(
                    'v.name as vaccine_name',
                    \DB::raw('COUNT(vr.id) as total_doses'),
                    \DB::raw("SUM(CASE WHEN vr.status = 'given' THEN 1 ELSE 0 END) as given_doses"),
                    \DB::raw("
                    ROUND(
                        SUM(CASE WHEN vr.status = 'given' THEN 1 ELSE 0 END) / COUNT(vr.id) * 100, 1
                    ) as completion_percentage
                    ")
                )
                ->where('vr.child_id', $child->id)
                ->groupBy('vr.vaccine_id', 'v.name')
                ->orderBy('v.id', 'asc')
                ->get();
            
            return view('parent-dashboard.child-vaccination-records', compact('report'));
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@childVaccinationRecords ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            dd($e->getMessage());
            return view('parent-dashboard.child-vaccination-records', ['error' => 'Unable to retrieve child vaccination records.']);
        }
    }


    public function childListDetails()
    {
        try {
            // Fetch all children for the authenticated user
            $user = auth()->user();
            $children = Child::where('parent_id', $user->id)->get();
            return view('parent-dashboard.child-details', compact('children'));
        } catch (Exception $e) {
            Log::error("Error occurred in FrontendController@childListDetails ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            return view('parent-dashboard.child-list', ['error' => 'Unable to retrieve child list details.']);
        }
    }


    public function gurdian_reset_password():View
    {
        $data['data'] = Auth::user();
        return view( 'parent-dashboard.reset-password', $data);
    }
    public function gurdian_reset_password_update(Request $request):RedirectResponse
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|max:20'
        ]);

        try {
            $user = Auth::user();
            if (Hash::check($request->get('old_password'), $user->password))
            {
                $user->password = Hash::make($request->get('new_password'));
                $user->save();
            } else
            {
                Session::flash( 'error', "Password Not Matched [UPC-103]" );
                return Redirect::back()->withInput();
            }
            Session::flash( 'success', 'Password reset successful!' );
            return Redirect::back()->withInput();
        } catch ( Exception $e ) {
            Log::error( "Error occurred in AuthPasswordController@update_password ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}" );
            Session::flash( 'error', "Something went wrong during application data store [APC-103]" );
            return Redirect::back()->withInput();
        }
    }




}
