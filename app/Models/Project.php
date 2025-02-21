<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';
    public $timestamps = true;

    // تحديد الأعمدة القابلة للتعبئة بشكل جماعي
    protected $fillable = [
        'client_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'start_date',
        'end_date',
        'status',
        'created_by',
        'updated_by',
        's_number'
    ];

    // دالة توليد الرقم التسلسلي
    public static function generateSerialNumber()
    {
        $prefix = 'PJT';
        $year = date('y');
        $month = date('m');
        $lastProject = Project::orderBy('id', 'desc')->first();
        if ($lastProject) {
            $lastNumber = intval(substr($lastProject->s_number, -6));
            $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '000001';
        }
        return $prefix . $year . $month . $newNumber;
    }

    // تحديد الأعمدة الخاصة بالتواريخ
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'start_date',
        'end_date'
    ];

    public static $statuses = [ 'held','tender','ongoing','finished', 'pending', ];

    // العلاقة مع نموذج Client
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // العلاقة مع نموذج Team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getNameAttribute()
    {
        return session('locale') == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        return session('locale') == 'ar' ? $this->description_ar : $this->description_en;
    }
    public function operations () {
        return $this->hasMany(Operation::class);
    }
}
