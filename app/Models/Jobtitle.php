<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jobtitle extends Model
{
    //
    public $timestamps = true;
    
    protected $table = 'jobtitles';
    
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'created_by',
        'updated_by',
        'status',
    ];

    public function users () {
        return $this->hasMany(User::class, 'job_title_id');
    }

    public function getNameAttribute() {
        return App()->getLocale() == 'en' ? $this->name_en : $this->name_ar;
    }

    public function getDescriptionAttribute() {
        return App()->getLocale() == 'en' ? $this->description_en : $this->description_ar;
    }

    public function creator () {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function editor () {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
