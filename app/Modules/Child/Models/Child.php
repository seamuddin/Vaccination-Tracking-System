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
}
