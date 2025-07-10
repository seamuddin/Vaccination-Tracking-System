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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

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

    public function childRegisterStore(Request $request)
    {
        try {
            // Validate and store the child registration data
            // Assuming you have a Child model and appropriate validation rules
            // $child = Child::create($request->all());
            return redirect()->route('guardianPortfolio')->with('success', 'Child registered successfully.');
        } catch (Exception $e) {
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
