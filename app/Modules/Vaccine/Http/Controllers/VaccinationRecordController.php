<?php

namespace App\Modules\Vaccine\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Child\Models\Child;
use App\Modules\Vaccine\Models\Vaccine;
use App\Modules\Vaccine\Models\VaccinationRecord;

class VaccinationRecordController extends Controller
{
    public function create()
    {
        $children = Child::pluck('name', 'id');
        $vaccines = Vaccine::pluck('name', 'id');

        return view('Vaccine::quick-vaccination', compact('children', 'vaccines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child_id' => 'required|exists:children,id',
            'vaccine_id' => 'required|exists:vaccines,id',
            'dose_number' => 'required|integer|min:1',
            'date_given' => 'required|date',
            'status' => 'required|in:given,missed',
        ]);

        $record = VaccinationRecord::where('child_id', $request->child_id)
            ->where('vaccine_id', $request->vaccine_id)
            ->where('dose_number', $request->dose_number)
            ->first();

        $child = Child::find($request->child_id);

        if (!$record) {
            return redirect()->back()->with('error', 'Vaccination schedule not found for this dose.');
        }

        $record->date_given = $request->date_given;
        $record->status = $request->status;
        $record->health_worker_id = auth()->id();
        $record->save();

        return redirect()->back()->with('success', 'Vaccination Completed for '.$child->name.'');
    }

}