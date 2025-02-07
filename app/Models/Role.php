<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Permission;
use App\Models\PermissionRole;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_role');
    }

    // givePermissionTo()
    public function givePermissionTo($permissions)
    {
        foreach ($permissions as $permission) {
            if ($permission instanceof Permission) {
                $this->permissions()->save($permission);
            }
        }
    }

    // removePermission()
    public function removePermissionFrom($permissions)
    {
        foreach($permissions as $permission){
            $this->permissions()->detach($permission);
        }
    }
}
