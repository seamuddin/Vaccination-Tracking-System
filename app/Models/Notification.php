<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\Child\Models\Child;
use App\Modules\Vaccine\Models\Vaccine;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    protected $table = 'notifications';

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

}