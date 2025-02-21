<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // إعدادات عامة
        Setting::create([
            'group' => 'general',
            'key' => 'site_name',
            'value' => 'نظام إدارة المشاريع',
            'type' => 'string',
            'scope' => 'global',
            'description' => 'اسم الموقع',
            'is_public' => true,
        ]);

        Setting::create([
            'group' => 'general',
            'key' => 'site_description',
            'value' => 'نظام متكامل لإدارة المشاريع والمهام',
            'type' => 'string',
            'scope' => 'global',
            'description' => 'وصف الموقع',
            'is_public' => true,
        ]);

        Setting::create([
            'group' => 'general',
            'key' => 'default_language',
            'value' => 'ar',
            'type' => 'string',
            'scope' => 'global',
            'description' => 'اللغة الافتراضية للنظام',
            'options' => json_encode(['ar' => 'العربية', 'en' => 'English']),
            'is_public' => true,
        ]);

        // إعدادات المظهر
        Setting::create([
            'group' => 'appearance',
            'key' => 'theme_color',
            'value' => '#3490dc',
            'type' => 'string',
            'scope' => 'global',
            'description' => 'اللون الرئيسي للموقع',
            'is_public' => true,
        ]);

        Setting::create([
            'group' => 'appearance',
            'key' => 'dark_mode',
            'value' => '0',
            'type' => 'boolean',
            'scope' => 'user',
            'description' => 'تفعيل الوضع الليلي',
            'is_public' => true,
        ]);

        // إعدادات الإشعارات
        Setting::create([
            'group' => 'notifications',
            'key' => 'email_notifications',
            'value' => '1',
            'type' => 'boolean',
            'scope' => 'user',
            'description' => 'تفعيل الإشعارات عبر البريد الإلكتروني',
            'is_public' => true,
        ]);

        Setting::create([
            'group' => 'notifications',
            'key' => 'push_notifications',
            'value' => '1',
            'type' => 'boolean',
            'scope' => 'user',
            'description' => 'تفعيل الإشعارات الفورية',
            'is_public' => true,
        ]);

        // إعدادات الأمان
        Setting::create([
            'group' => 'security',
            'key' => 'login_attempts',
            'value' => '5',
            'type' => 'integer',
            'scope' => 'global',
            'description' => 'عدد محاولات تسجيل الدخول المسموح بها',
            'is_public' => false,
        ]);

        Setting::create([
            'group' => 'security',
            'key' => 'password_expiry_days',
            'value' => '90',
            'type' => 'integer',
            'scope' => 'global',
            'description' => 'عدد أيام صلاحية كلمة المرور',
            'is_public' => false,
        ]);

        // إعدادات المستخدمين
        Setting::create([
            'group' => 'users',
            'key' => 'allow_registration',
            'value' => '1',
            'type' => 'boolean',
            'scope' => 'global',
            'description' => 'السماح بتسجيل مستخدمين جدد',
            'is_public' => true,
        ]);

        Setting::create([
            'group' => 'users',
            'key' => 'default_role',
            'value' => 'user',
            'type' => 'string',
            'scope' => 'global',
            'description' => 'الدور الافتراضي للمستخدمين الجدد',
            'options' => json_encode(['admin' => 'مدير', 'user' => 'مستخدم']),
            'is_public' => false,
        ]);
    }
}
