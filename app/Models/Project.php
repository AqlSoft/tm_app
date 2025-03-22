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
        'name',
        'description',
        'start_date',
        'est_period',
        'time_unit',
        'status',
        'base_budget',
        'project_type',
        'manager_id',
        's_number',
        'created_by',
        'updated_by',
        
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
        return $this->belongsTo(Customer::class, 'client_id');
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

    public function lastOperationOrder () {
        return ($this->operations()->count() ?? 0) + 1;
    }
}
