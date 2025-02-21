<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;

class TranslationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        try {
            // تحديد اللغة الافتراضية من الإعدادات
            if (Schema::hasTable('settings')) {
                $locale = \App\Models\Setting::get('default_language', 'ar', 'general');
                if ($locale) {
                    App::setLocale($locale);
                }
            }
        } catch (\Exception $e) {
            // في حالة حدوث أي خطأ، استخدم اللغة العربية كلغة افتراضية
            App::setLocale('ar');
        }

        // تحميل ملفات الترجمة من المسار الصحيح
        $langPath = resource_path('lang');
        if (is_dir($langPath . '/ar')) {
            $this->loadTranslationsFrom($langPath . '/ar', 'ar');
        }
        if (is_dir($langPath . '/en')) {
            $this->loadTranslationsFrom($langPath . '/en', 'en');
        }
    }
}

function schema_exists($table) {
    try {
        return Schema::hasTable($table);
    } catch (\Exception $e) {
        return false;
    }
}
