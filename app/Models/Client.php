<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Models\Project;

class Client extends Model
{
    //

    public $timestamps = true;
    protected $table = 'clients';
    protected $fillable = [
        'name_ar',
        'name_en',
        'type',
        'identity_number',
        'commercial_record',
        'tax_number',
        'brand_name',
        'phone',
        'mobile',
        'email',
        'website',
        'city',
        'address',
        'notes',
        'is_active',
        'created_by',
        'updated_by',
        's_number'
    ];

    // تعريف الحقول الفريدة
    public static $uniqueFields = [
        'identity_number',
        'commercial_record',
        'tax_number',
        'email',
        's_number'
    ];

    protected $dates = [
        'created_at',
        'updated_at', 
        'deleted_at'
    ];

    public static $types = [
        'individual', 
        'company', 
        'governmental', 
        'ngo',
        'factory', 
        'farm', 
        'office',
        'others'
    ];

    // دالة توليد الرقم التسلسلي
    public static function generateSerialNumber()
    {
        $prefix = 'CL';
        $year = date('Y');
        $month = date('m');
        $lastClient = self::whereYear('created_at', $year)
            ->orderBy('id', 'desc')
            ->first();

        if ($lastClient) {
            $lastNumber = intval(substr($lastClient->s_number, -6));
            $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '000001';
        }

        return $prefix . $year . $month . $newNumber;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getNameAttribute()
    {
        return session('locale') == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    // التحقق من عدم تكرار القيم الفريدة
    public static function boot()
    {
        parent::boot();
        
        static::saving(function ($model) {
            $uniqueFields = self::$uniqueFields;
            $uniqueFields = array_filter($uniqueFields, function($field) use ($model) {
                return !empty($model->{$field});
            });

            if (empty($uniqueFields)) {
                return;
            }

            $query = static::where(function ($query) use ($uniqueFields, $model) {
                foreach ($uniqueFields as $field) {
                    $query->orWhere($field, $model->{$field});
                }
            });

            if ($model->exists) {
                $query->where('id', '!=', $model->id);
            }

            if ($query->exists()) {
                $field = array_search($model->{$uniqueFields[0]}, array_column($query->get()->toArray(), $uniqueFields[0]));
                throw new \Exception(__('clients.' . $uniqueFields[0] . '_already_exists'));
            }
        });
    }

    public function invoices() {
        return $this->hasMany(Invoice::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
