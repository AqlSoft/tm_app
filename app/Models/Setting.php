<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'group',
        'key',
        'value',
        'type',
        'scope',
        'scope_id',
        'description',
        'is_public',
        'options',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'options' => 'array'
    ];

    // الحصول على قيمة إعداد معين
    public static function get($key, $default = null, $group = 'general', $scope = 'global', $scope_id = null)
    {
        $setting = static::where('key', $key)
            ->where('group', $group)
            ->where('scope', $scope)
            ->where('scope_id', $scope_id)
            ->first();

        if (!$setting) {
            return $default;
        }

        return static::parseValue($setting->value, $setting->type);
    }

    // حفظ قيمة إعداد
    public static function set($key, $value, $group = 'general', $scope = 'global', $scope_id = null, $options = [])
    {
        $setting = static::updateOrCreate(
            [
                'key' => $key,
                'group' => $group,
                'scope' => $scope,
                'scope_id' => $scope_id
            ],
            array_merge([
                'value' => $value,
                'updated_by' => auth()->id()
            ], $options)
        );

        return $setting;
    }

    // تحويل القيمة حسب النوع
    protected static function parseValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'integer':
                return (int) $value;
            case 'float':
                return (float) $value;
            case 'array':
                return is_array($value) ? $value : json_decode($value, true);
            default:
                return $value;
        }
    }

    // تحويل القيمة قبل الحفظ
    public function setValueAttribute($value)
    {
        if ($this->type === 'array' && is_array($value)) {
            $this->attributes['value'] = json_encode($value);
        } elseif ($this->type === 'boolean') {
            $this->attributes['value'] = filter_var($value, FILTER_VALIDATE_BOOLEAN) ? '1' : '0';
        } else {
            $this->attributes['value'] = $value;
        }
    }

    // تحويل القيمة عند القراءة
    public function getValueAttribute($value)
    {
        return static::parseValue($value, $this->type);
    }

    // العلاقة مع المستخدم الذي أنشأ الإعداد
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // العلاقة مع المستخدم الذي قام بتحديث الإعداد
    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
