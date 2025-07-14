<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\Child\Models\Child;
use App\Modules\Vaccine\Models\Vaccine;
use App\Modules\VaccinationCenter\Models\VaccinationCenter;
use App\Modules\User\Models\User;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'child_id',
        'vaccine_id',
        'dose',
        'vaccine_center_id',
        'appointment_date',
        'status',
        'created_by',
    ];

    /**
     * The child who the appointment is for.
     */
    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    /**
     * The vaccine being administered.
     */
    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    /**
     * The vaccine center where the appointment will occur.
     */
    public function vaccineCenter()
    {
        return $this->belongsTo(VaccinationCenter::class);
    }

    /**
     * The user (e.g., health worker/admin) who created the appointment.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
