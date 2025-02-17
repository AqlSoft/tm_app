<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Team extends Model
{
    use HasFactory;

    protected $table = 'teams';
    public $timestamps = true;

    protected $fillable = [
        'name_ar',
        'name_en',
        'code',
        'brief',
        'leader_id',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function getNameAttribute()
    {
        return App::getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public static function generateTeamCode()
    {
        $prefix = 'GRP';
        $year = date('y');
        $month = date('m');
        $lastClient = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastClient) {
            $lastNumber = intval(substr($lastClient->s_number, -6));
            $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0000001';
        }

        return $prefix . $year . $month . $newNumber;
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }
}
