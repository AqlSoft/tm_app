<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'customers';

    public $timestamps = true;

    protected $fillable = [
        'name_ar',
        'name_en',
        'type',
        'identity_number',
        'commercial_record',
        'tax_number',
        'brand_name',
        'subscription_date',
        'phone',
        'mobile',
        'email',
        'website',
        'city',
        'address',
        'notes',
        'is_active',
        'created_by',
        'updated_by'
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
        $prefix = 'CTR';
        $year = date('Y');
        $month = date('m');
        return $lastClient = self::lastClient();
        if ($lastClient) {
            $lastNumber = intval(substr($lastClient->s_number, -6));
            $newNumber = str_pad($lastNumber + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '000001';
        }

        return $prefix . $year . $month . $newNumber;
    }

    public static function lastClient() {
        $lastClient = self::whereYear('created_at', date('Y'))
            ->orderBy('id', 'desc')
            ->first();
        return $lastClient;
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
        return $this->hasMany(Project::class, 'client_id');
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
        return $this->hasMany(Invoice::class, 'client_id');
    }

    public function payments() {
        return $this->hasMany(Payment::class, 'client_id');
    }
}
