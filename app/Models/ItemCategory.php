<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    use HasFactory;

    public $timestamps = true;
    
    protected $table = 'item_categories';
    
    protected $fillable = [
        'name_ar',
        'name_en',
        'category_id',  // لإدارة الفئات
        'description_ar',
        'description_en',
        'created_by',
        'updated_by',
    ];

    protected $dates = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

   
    // العلاقة مع الفئات الفرعية
    public function children()
    {
        return $this->hasMany(ItemCategory::class, 'parent_id');
    }

    // العلاقة مع الفئة الأب
    public function parent()
    {
        return $this->belongsTo(ItemCategory::class, 'parent_id');
    }

    // العلاقة مع نموذج Item
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
