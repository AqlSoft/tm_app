<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use HasFactory, SoftDeletes;

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

    protected $dates = [
        'subscription_date',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // أنواع العملاء المتاحة
    public static $types = [
        'individual' => 'فردي',
        'company' => 'شركة',
        'factory' => 'مصنع',
        'farm' => 'مزرعة',
        'government' => 'حكومي'
    ];

    // العلاقة مع منشئ السجل
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // العلاقة مع آخر من قام بالتعديل
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    // الحصول على اسم العميل حسب اللغة الحالية
    public function getNameAttribute()
    {
        return app()->getLocale() == 'ar' ? $this->name_ar : ($this->name_en ?? $this->name_ar);
    }

    // الحصول على نوع العميل مترجماً
    public function getTypeNameAttribute()
    {
        return self::$types[$this->type] ?? $this->type;
    }
}
