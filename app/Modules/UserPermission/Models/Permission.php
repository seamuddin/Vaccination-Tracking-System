<?php

namespace App\Modules\UserPermission\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\UserPermission\Models\Role;
use App\Modules\UserPermission\Models\Module;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug'];

    //relationships

    public function roles():BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function module():BelongsTo
    {
        return $this->belongsTo(Module::class);
    }
}
