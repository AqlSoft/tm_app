<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationJob extends Model
{
    //

    protected $table = 'application_jobs';
    public $timestamps = true;
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'created_by',
        'updated_by',
        'sataus',
    ];

    public function creator () {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor () {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function getNameAttribute() {
        return App()->getLocale() == 'ar' ? $this->name_ar : $this->name_en;
    }

    public function getDescriptionAttribute() {
        return App()->getLocale() == 'ar' ? $this->description_ar : $this->description_en;
    }
}
