<?php

namespace App\Modules\VaccinationCenter\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\VaccinationCenter\Models\VaccinationCenter;
use App\Libraries\CommonFunction;
use yajra\Datatables\Datatables;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Modules\VaccinationCenter\Http\Requests\StoreVaccinationCenterRequest;

class VaccinationCenterController extends Controller
{

    /**
     * Display the module welcome screen
     *
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        try {
            if ($request->ajax() && $request->isMethod('post')) {
            $list = VaccinationCenter::select('id', 'name', 'address', 'phone', 'email', 'is_active', 'updated_at')
                ->orderBy('id')
                ->get();

            return DataTables::of($list)
                ->editColumn('name', function ($center) {
                return $center->name ?? '';
                })
                ->editColumn('address', function ($center) {
                return $center->address ?? '';
                })
                ->editColumn('phone', function ($center) {
                return $center->phone ?? '';
                })
                ->editColumn('email', function ($center) {
                return $center->email ?? '';
                })
                ->editColumn('is_active', function ($center) {
                    if ($center->is_active) {
                        return '<span class="btn btn-success btn-sm">Active</span>';
                    } else {
                        return '<span class="btn btn-danger btn-sm">Inactive</span>';
                    }
                })
                ->editColumn('updated_at', function ($center) {
                return CommonFunction::formatLastUpdatedTime($center->updated_at);
                })
                ->addColumn('action', function ($center) {
                return '<a href="' . url('vaccination-center/edit/' . $center->id . '/') . '" class="btn btn-sm btn-primary"><i class="bx bx-edit"></i></a>';
                })
                ->rawColumns(['action','is_active'])
                ->make(true);
            }
            return view("VaccinationCenter::list");
        } catch (\Exception $e) {
            \Log::error("Error occurred in VaccinationCenterController@list ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            \Session::flash('error', "Something went wrong during application data load [VaccinationCenter-101]");
            return response()->json(['error' => $e->getMessage()], \Illuminate\Http\Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function create()
    {
        return view('VaccinationCenter::create');
    }

    public function store(StoreVaccinationCenterRequest $request)
    {
        try {
            if ($request->get('id')) {
                $center = VaccinationCenter::findOrFail($request->get('id'));
            } else {
                $center = new VaccinationCenter();
            }

            $center->name = $request->get('name');
            $center->address = $request->get('address');
            $center->phone = $request->get('phone');
            $center->email = $request->get('email');
            $center->google_place_id = $request->get('google_place_id');
            $center->latitude = $request->get('latitude');
            $center->longitude = $request->get('longitude');
            $center->is_active = $request->get('is_active', false);
            $center->save();

            Session::flash('success', 'Vaccination Center saved successfully.');
            return redirect()->route('vaccinationcenter.list');
        } catch (\Exception $e) {
            Log::error("Error occurred in VaccinationCenterController@store ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            Session::flash('error', "Something went wrong while saving the vaccination center [VaccinationCenter-102]");
            return redirect()->back()->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $center = VaccinationCenter::findOrFail($id);
            return view('VaccinationCenter::edit', compact('center'));
        } catch (\Exception $e) {
            Log::error("Error occurred in VaccinationCenterController@edit ({$e->getFile()}:{$e->getLine()}): {$e->getMessage()}");
            Session::flash('error', "Something went wrong while loading the vaccination center for editing [VaccinationCenter-103]");
            return redirect()->route('vaccinationcenter.list');
        }
    }


}
