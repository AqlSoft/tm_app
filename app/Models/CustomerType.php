<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
    ];

    public function getNameAttribute()
    {
        return session('locale') == 'ar' ? $this->name_ar : $this->name_en;
    }

    // علاقة العملاء (كل نوع عميل يمكن أن يكون لديه عملاء متعددون)
    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
