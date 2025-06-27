<?php

namespace App\Modules\Vaccine\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaccinationRecord extends Model
{
    use HasFactory;

    

    protected $table = 'vaccination_records'; // Specify your table name here

    protected $fillable = [
        'child_id',
        'vaccine_id',
        'dose_number',
        'date_given',
        'next_due_date',
        'status',
        'health_worker_id',
    ];


    // Relationships
    public function child()
    {
        return $this->belongsTo(\App\Modules\Child\Models\Child::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(\App\Modules\Vaccine\Models\Vaccine::class);
    }

    public function healthWorker()
    {
        return $this->belongsTo(\App\Models\User::class, 'health_worker_id');
    }

    // Accessors
    public function getStatusLabelAttribute()
    {
        return ucfirst($this->status); // Scheduled, Given, Missed
    }

    public function getDoseNameAttribute()
    {
        return 'Dose ' . $this->dose_number;
    }

    public function getDueInDaysAttribute()
    {
        return $this->next_due_date ? Carbon::now()->diffInDays($this->next_due_date, false) : null;
    }
}
