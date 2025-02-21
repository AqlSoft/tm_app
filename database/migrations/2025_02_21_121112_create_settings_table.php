<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('settings')) {
            Schema::create('settings', function (Blueprint $table) {
                $table->id();
                $table->string('group', 50)->default('general'); // مجموعة الإعدادات (مثل users, general, etc)
                $table->string('key', 50); // مفتاح الإعداد
                $table->text('value')->nullable(); // قيمة الإعداد
                $table->string('type', 20)->default('string'); // نوع القيمة (string, boolean, array, etc)
                $table->string('scope', 20)->default('global'); // نطاق الإعداد (global, user, role, etc)
                $table->unsignedBigInteger('scope_id')->nullable(); // معرف النطاق (مثل user_id إذا كان النطاق user)
                $table->text('description')->nullable(); // وصف الإعداد
                $table->boolean('is_public')->default(true); // هل الإعداد عام أم خاص
                $table->json('options')->nullable(); // خيارات إضافية للإعداد
                $table->unsignedBigInteger('created_by')->nullable();
                $table->unsignedBigInteger('updated_by')->nullable();
                $table->timestamps();
                
                // إضافة الفهارس
                $table->index('key');
                $table->index(['group', 'key']);
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
