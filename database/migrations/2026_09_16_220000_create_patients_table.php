<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * "Danışanlar" (hastalar) tablosu. CRM'in çekirdeği: her randevu bir
     * danışana bağlıdır, aynı danışan zaman içinde birden fazla randevu
     * alabilir (geçmiş kayıt/CRM geçmişi buradan çıkar).
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender')->nullable();
            $table->text('notes')->nullable();
            $table->boolean('kvkk_approved')->default(false);
            $table->timestamps();

            $table->index('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
