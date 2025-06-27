<?php

namespace App\Modules\Vaccine\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Vaccine\Models\Vaccine;
use App\Modules\User\Models\User;
use App\Modules\Vaccine\Http\Requests\StoreVaccineRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Libraries\CommonFunction;

class VaccineController extends Controller
{
    public function list(Request $request)
    {
        try {
            if ($request->ajax() && $request->isMethod('post')) {
            $list = Vaccine::select('id', 'name', 'manufacturer', 'doses_required', 'age_due_days', 'number_of_doses', 'dose_interval_days', 'updated_at')
                ->orderBy('id')
                ->get();

            return \DataTables::of($list)
                ->editColumn('name', function ($vaccine) {
                return $vaccine->name ?? '';
                })
                ->editColumn('manufacturer', function ($vaccine) {
                return $vaccine->manufacturer ?? '';
                })
                ->addColumn('dose_count', function ($vaccine) {
                return $vaccine->number_of_doses ?? $vaccine->doses_required ?? '';
                })
                ->editColumn('recommended_age', function ($vaccine) {
                return $vaccine->age_due_days . " Days" ?? '';
                })
    
                ->editColumn('updated_at', function ($vaccine) {
                return CommonFunction::formatLastUpdatedTime($vaccine->updated_at);
                })
                ->addColumn('action', function ($vaccine) {
                return '<a href="' . \URL::to('vaccine/edit/' . $vaccine->id . '/') . '" class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></a>';
                })
                ->rawColumns(['action'])
                ->make(true);
            }
            return view("Vaccine::list");
        } catch (\Exception $e) {
            \Log::error("Error occurred in VaccineController@list ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            \Session::flash('error', "Something went wrong during application data load [Vaccine-101]");
            return response()->json(['error' => $e->getMessage()], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create()
    {
        return view('Vaccine::create');
    }

    public function store(StoreVaccineRequest $request)
    {
        try {
            if ($request->get('id')) {
                $vaccine = Vaccine::findOrFail($request->get('id'));
            } else {
                $vaccine = new Vaccine();
            }

            $vaccine->name = $request->get('name');
            $vaccine->manufacturer = $request->get('manufacturer');
            $vaccine->doses_required = $request->get('doses_required');
            $vaccine->age_due_days = $request->get('age_due_days');
            $vaccine->number_of_doses = $request->get('number_of_doses');
            $vaccine->dose_interval_days = $request->get('dose_interval_days');
            $vaccine->description = $request->get('description');
            $vaccine->save();

            Session::flash('success', 'Vaccine saved successfully!');
            return redirect()->route('vaccine.list');
        } catch (\Exception $e) {
            Log::error("Error occurred in VaccineController@store ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            Session::flash('error', "Something went wrong during vaccine data store [Vaccine-103]");
            return redirect()->back()->withInput();
        }
    }

    public function show(Vaccine $vaccine)
    {
        return view('Vaccine::show', compact('vaccine'));
    }

    public function edit($id)
    {
        $vaccine = Vaccine::findOrFail($id);
        return view('Vaccine::edit', compact('vaccine'));
    }

    public function update(Request $request, Vaccine $vaccine)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'manufacturer' => 'required|string|max:255',
            'doses_required' => 'required|integer|min:1',
            'description' => 'nullable|string|max:1000',
        ]);

        $vaccine->update($request->all());
        return redirect()->route('vaccine.list')->with('success', 'Vaccine updated successfully.');
    }
}
