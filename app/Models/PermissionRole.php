<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PermissionRole extends Model
{
    protected $table = 'permission_role';
    public $timestamps = false;

    protected $fillable = [
        'permission_id',
        'role_id',
    ];
}
