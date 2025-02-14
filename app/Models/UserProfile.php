<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $table = 'user_profiles';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'gender',
        'job_title',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
