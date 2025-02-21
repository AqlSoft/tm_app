<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        // إعدادات عامة للتطبيق
        $this->createSetting('general', 'app_name', 'نظام إدارة المشاريع', 'string', 'global');
        $this->createSetting('general', 'app_description', 'نظام متكامل لإدارة المشاريع والمهام', 'string', 'global');
        $this->createSetting('general', 'company_name', 'اسم الشركة', 'string', 'global');
        $this->createSetting('general', 'default_language', 'ar', 'string', 'global');
        
        // إعدادات المستخدمين
        $this->createSetting('users', 'display_name_format', 'username', 'string', 'global', [
            'options' => json_encode([
                'username' => 'اسم المستخدم',
                'full_name' => 'الاسم الكامل',
                'first_name' => 'الاسم الأول',
                'email' => 'البريد الإلكتروني'
            ])
        ]);
        
        $this->createSetting('users', 'default_role', 'user', 'string', 'global');
        $this->createSetting('users', 'allow_registration', true, 'boolean', 'global');
        
        // إعدادات المشاريع
        $this->createSetting('projects', 'default_status', 'pending', 'string', 'global');
        $this->createSetting('projects', 'statuses', json_encode([
            'pending' => 'قيد الانتظار',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي'
        ]), 'array', 'global');
        
        // إعدادات المهام
        $this->createSetting('tasks', 'priorities', json_encode([
            'low' => 'منخفضة',
            'medium' => 'متوسطة',
            'high' => 'عالية',
            'urgent' => 'عاجلة'
        ]), 'array', 'global');
    }

    private function createSetting($group, $key, $value, $type, $scope, $additional = [])
    {
        Setting::updateOrCreate(
            ['group' => $group, 'key' => $key],
            array_merge([
                'value' => $value,
                'type' => $type,
                'scope' => $scope,
                'is_public' => true,
                'created_by' => 1,
                'updated_by' => 1
            ], $additional)
        );
    }
}
