<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->enum('type', ['individual', 'company', 'factory', 'farm', 'government']);
            $table->string('identity_number')->nullable(); // رقم الهوية/الإقامة
            $table->string('commercial_record')->nullable(); // السجل التجاري
            $table->string('tax_number')->nullable(); // الرقم الضريبي
            $table->string('brand_name')->nullable(); // الاسم التجاري/البراند
            $table->date('subscription_date'); // تاريخ الاشتراك
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('city');
            $table->text('address')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('is_active')->default(true);
            
            // Audit Fields
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->constrained('users');
            $table->timestamps();
            $table->softDeletes();

            // Indexes
            $table->index('name_ar');
            $table->index('name_en');
            $table->index('type');
            $table->unique('identity_number');
            $table->unique('commercial_record');
            $table->unique('tax_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
