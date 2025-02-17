<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    use HasFactory;

    protected $table = 'team_members';
    public $timestamps = true;

    protected $fillable = [
        'team_id',
        'member_id',
        'role',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $dates = [
        'joined_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }
}
