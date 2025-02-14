<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class UserRole extends Model
{
    protected $table = 'user_roles';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'role_id',
    ];
}
