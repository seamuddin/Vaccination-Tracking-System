<?php

namespace App\Modules\UserPermission\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\UserPermission\Models\Permission;
use App\Modules\UserPermission\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Module extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'slug'];


    //relationships

    public function permissions():HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function roles():BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }



}
