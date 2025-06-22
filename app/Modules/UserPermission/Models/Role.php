<?php

namespace App\Modules\UserPermission\Models;
use App\Modules\User\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Modules\UserPermission\Models\Permission;
use App\Modules\UserPermission\Models\Module;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['title','slug','deletable'];


    //relationship

    public function permissions():BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    public function modules():BelongsToMany
    {
        return $this->belongsToMany(Module::class);
    }

    public function users():HasMany
    {
        return $this->hasMany(User::class);
    }
}
