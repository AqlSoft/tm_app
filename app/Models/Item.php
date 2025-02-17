<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // تحديد الجدول المرتبط بالنموذج
    protected $table = 'items';
    // اضافة توقيتات التسجيل بشكل تلقائى 
    public $timestamps = true;

    // تحديد الأعمدة القابلة للتعبئة بشكل جماعي
    protected $fillable = [
        'name_ar',
        'name_en',
        'barcode',
        'category_id',
        'brief_ar',
        'brief_en',
        'price',
        'tax',
        'discount',
        'created_by',
        'updated_by',
    ];

    // Dates 
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // العلاقة مع نموذج InvoiceEntry
    public function invoiceEntries()
    {
        return $this->hasMany(InvoiceEntry::class);
    }
    
    // العلاقة مع نموذج Category
    public function category()
    {
        return $this->belongsTo(ItemCategory::class);
    }

    // تحديد الأحداث التي تحدث عند حفظ النموذج
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;  // تعيين created_by إلى معرف المستخدم الحالي
            $model->updated_by = $model->created_by;  // تعيين updated_by إلى نفس القيمة
        });

        static::updating(function ($model) {
            $model->updated_by = auth()->user()->id;  // تحديث updated_by بمعرف المستخدم الحالي عند التحديث
        });
    }
}
