<?php

namespace App\Modules\Child\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Child extends Model
{
    use HasFactory;

    public function vaccineRecords()
    {
        return $this->hasMany(\App\Modules\Vaccine\Models\VaccinationRecord::class, 'child_id');
    }

    public function getDoseSummaryAttribute()
   {
        $result = DB::table('vaccination_records')
            ->selectRaw('child_id, COUNT(*) AS total_count, SUM(CASE WHEN status = \'given\' THEN 1 ELSE 0 END) AS given_count')
            ->where('child_id', $this->id)
            ->groupBy('child_id')
            ->first();

        return [
            'child_id' => $result->child_id ?? $this->id,
            'total_count' => $result->total_count ?? 0,
            'given_count' => $result->given_count ?? 0,
        ];
    }

    public function getNextVaccineAttribute()
    {
        // Get all records for this child ordered by vaccine and dose
        $records = DB::table('vaccination_records')
            ->where('child_id', $this->id)
            ->orderBy('vaccine_id')
            ->orderBy('dose_number')
            ->get();

        foreach ($records as $record) {
            if ($record->status !== 'given') {
                // Get vaccine name from vaccines table
                $vaccine = DB::table('vaccines')->where('id', $record->vaccine_id)->first();
                return [
                    'vaccine_id' => $record->vaccine_id,
                    'vaccine_name' => $vaccine ? $vaccine->name : null,
                    'dose_number' => $record->dose_number,
                    'next_due_date' => $record->next_due_date,
                    'status' => $record->status,
                ];
            }
        }

        // If all given, return null
        return null;
    }

    public function getRecentGivenVaccinesAttribute()
    {
        $records = DB::table('vaccination_records')
            ->where('child_id', $this->id)
            ->where('status', 'given')
            ->orderByDesc('date_given')
            ->limit(2)
            ->get();

        $result = [];
        foreach ($records as $record) {
            $vaccine = DB::table('vaccines')->where('id', $record->vaccine_id)->first();
            $result[] = [
                'vaccine_id' => $record->vaccine_id,
                'vaccine_name' => $vaccine ? $vaccine->name : null,
                'dose_number' => $record->dose_number,
                'date_given' => $record->date_given,
            ];
        }

        return $result;
    }
}
