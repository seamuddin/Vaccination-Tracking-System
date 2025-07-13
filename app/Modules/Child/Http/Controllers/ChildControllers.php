<?php

namespace App\Modules\Child\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Child\Models\Child;
use App\Modules\User\Models\User;
use App\Modules\Child\Http\Requests\StoreChildRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Libraries\CommonFunction;
use Illuminate\Support\Facades\DB;
use App\Modules\Vaccine\Models\Vaccine;
use App\Modules\Vaccine\Models\VaccinationRecord;
use Carbon\Carbon;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\URL;
use Exception;

class ChildControllers extends Controller
{
    public function list(Request $request)
    {
        try {
            if ($request->ajax() && $request->isMethod('post')) {
                $list = Child::select('id', 'name', 'date_of_birth', 'gender', 'guardian_name', 'guardian_contact', 'updated_at')
                    ->orderBy('id')
                    ->get();

                return DataTables::of($list)
                    ->editColumn('name', function ($child) {
                        return $child->name ?? '';
                    })
                    ->editColumn('date_of_birth', function ($child) {
                        return $child->date_of_birth;
                    })
                    // ->editColumn('gender', function ($child) {
                    //     return ucfirst($child->gender);
                    // })
                    ->editColumn('guardian_name', function ($child) {
                        return $child->guardian_name;
                    })
                    ->editColumn('guardian_contact', function ($child) {
                        return $child->guardian_contact ?? '';
                    })
                    ->editColumn('vaccination_status', function ($child) {
                        return '';
                    })
                    ->editColumn('updated_at', function ($child) {
                        return CommonFunction::formatLastUpdatedTime($child->updated_at);
                    })
                    ->addColumn('vaccination_records', function ($child) {
                        return '<a href="' . URL::to('child/records/' . $child->id . '/') . '" class="btn btn-sm btn-primary text-center"><i class="fas fa-window-restore"></i></a>';
                    })
                    ->addColumn('action', function ($child) {
                        return '<a href="' . URL::to('child/edit/' . $child->id . '/') . '" class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></a>';
                    })
                    ->rawColumns(['action','vaccination_records'])
                    ->make(true);
            }
            return view("Child::list");
        } catch (Exception $e) {
            Log::error("Error occurred in ChildController@list ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            Session::flash('error', "Something went wrong during application data load [Child-101]");
            return response()->json(['error' => $e->getMessage()], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    

    public function create()
    {
        // Assuming you have a User model and a 'type' field to identify parents
        $parents = User::where('role_id', 4)->pluck('name', 'id');
        return view('Child::create', compact('parents'));
    }

    public function store(StoreChildRequest $request)
    {
        try {
            $update = false;

            DB::transaction(function () use ($request, &$update) {
                // Fetch parent (user) info
                $parent = User::findOrFail($request->get('parent_id'));

                if ($request->get('id')) {
                    $child = Child::findOrFail($request->get('id'));
                    $update = true;
                } else {
                    $child = new Child();
                }
                $card_no = '';
                do {
                    $card_no = 'VACC-' . strtoupper(uniqid()) . rand(10000, 99999);
                } while (\App\Modules\Child\Models\Child::where('card_no', $card_no)->exists());

                $child->name = $request->get('name');
                $child->date_of_birth = $request->get('date_of_birth');
                $child->gender = $request->get('gender');
                $child->parent_id = $parent->id;
                $child->guardian_name = $parent->name;
                $child->guardian_contact = $request->get('parent_contact');
                $child->card_no = $card_no;
                $child->save();

                // ✅ Add vaccination records if new child
                if (!$update) {
                    $vaccines = Vaccine::all();
                    $birthDate = Carbon::parse($child->date_of_birth);

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
                }
            });

            Session::flash('success', $update ? "Child updated successfully" : "Child created successfully");
            return redirect()->route('child.list');

        } catch (\Exception $e) {
            Log::error("Error occurred in ChildController@store ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            Session::flash('error', "Something went wrong during child data store [Child-103]");
            return redirect()->back()->withInput();
        }
    }


    public function show(Child $child)
    {
        return view('Child::show', compact('child'));
    }

    public function edit($id)
    {
        $child = Child::findOrFail($id);
        $parents = User::where('role_id', 4)->pluck('name', 'id');
        return view('Child::edit', compact('child', 'parents'));
    }

    public function update(Request $request, Child $child)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'guardian_name' => 'required|string|max:255',
            'guardian_contact' => 'nullable|string|max:20',
        ]);

        $child->update($request->all());
        return redirect()->route('children.index')->with('success', 'Child updated successfully.');
    }


    public function records(Request $request, $childId)
    {
        try {
            if ($request->ajax() && $request->isMethod('post')) {
                $records = VaccinationRecord::with(['vaccine', 'healthWorker'])
                    ->where('child_id', $childId)
                    ->orderBy('next_due_date')
                    ->get();

                return DataTables::of($records)
                    ->addColumn('vaccine_name', function ($record) {
                        return $record->vaccine->name ?? '';
                    })
                    ->addColumn('dose_number', function ($record) {
                        return $record->dose_number;
                    })
                    ->addColumn('next_due_date', function ($record) {
                        return $record->next_due_date ? Carbon::parse($record->next_due_date)->format('Y-m-d') : '';
                    })
                    ->addColumn('status', function ($record) {
                        $status = strtolower($record->status);
                        switch ($status) {
                            case 'scheduled':
                                $badgeClass = 'badge bg-warning';
                                break;
                            case 'given':
                                $badgeClass = 'badge bg-success';
                                break;
                            case 'missed':
                                $badgeClass = 'badge bg-danger';
                                break;
                            default:
                                $badgeClass = 'badge bg-secondary';
                                break;
                        }
                        return '<span class="' . $badgeClass . '">' . ucfirst($status) . '</span>';
                    })
                    ->addColumn('health_worker', function ($record) {
                        return $record->healthWorker->name ?? '';
                    })
                    ->rawColumns(['vaccine_name', 'status'])
                    ->make(true);
            }

            $child = Child::findOrFail($childId);
            return view('Child::vaccines', compact('child'));
        } catch (Exception $e) {
            Log::error("Error occurred in ChildController@records ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            Session::flash('error', "Something went wrong during vaccination records load [Child-201]");
            return response()->json(['error' => $e->getMessage()], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}