<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * "Terapi Odaları" — randevu onaylanırken hangi fiziksel odanın
     * kullanılacağını seçmek için. Aynı oda aynı saat aralığında iki
     * randevuya birden atanamaz (bkz. AppointmentController::updateStatus).
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
