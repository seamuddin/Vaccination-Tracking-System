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



class ChildControllers extends Controller
{
    public function list(Request $request)
    {
        try {
            if ($request->ajax() && $request->isMethod('post')) {
                $list = Child::select('id', 'name', 'date_of_birth', 'gender', 'guardian_name', 'guardian_contact', 'updated_at')
                    ->orderBy('id')
                    ->get();

                return \DataTables::of($list)
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
                    ->addColumn('action', function ($child) {
                        return '<a href="' . \URL::to('child/edit/' . $child->id . '/') . '" class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></a>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view("Child::list");
        } catch (\Exception $e) {
            \Log::error("Error occurred in ChildController@list ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            \Session::flash('error', "Something went wrong during application data load [Child-101]");
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
            // dd($request->all());
            // Fetch parent (user) info
            $parent = User::findOrFail($request->get('parent_id'));

            if ($request->get('id')) {
                $child = Child::findOrFail($request->get('id'));
                $update = true;
                
            } else {
                $child = new Child();
            }

            $child->name = $request->get('name');
            $child->date_of_birth = $request->get('date_of_birth');
            $child->gender = $request->get('gender');
            $child->user_id = $parent->id; // Save parent_id as user_id in child table
            $child->guardian_name = $parent->name; // Get guardian name from user
            $child->guardian_contact = $request->get('parent_contact');; // Get contact from user, fallback to null
            
            $child->save();
            if ($update) {
                Session::flash('success',"Child updated successfully");
            } else {
                Session::flash('success',"Child created successfully");
            }
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

}