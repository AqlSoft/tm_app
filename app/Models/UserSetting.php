<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    //
    public $timestamps = true;
    protected $table = "user_settings";
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'values',
        'default_value',
        'current_value',
        'satus',
        'created_by',
        'updated_by'
    ];

    public function getNameAttribute($attr)
    {
        if (session('locale') == 'en') {
            return $this->name_en;
        } else {
            return $this->name_ar;
        }
    }

    public function getDescriptionAttribute($attr)
    {
        if (session('locale') == 'en') {
            return $this->description_en;
        } else {
            return $this->description_ar;
        }
    }

    public function getValuesAttribute($attr)
    {
        return json_decode($this->values, true);
    }


    public function creator() {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function editor() {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
