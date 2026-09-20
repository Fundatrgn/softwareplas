<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Randevu hatırlatma e-postaları artık TEK bir saat değeri yerine,
     * admin panelinden (E-posta Ayarları) birden çok gün seçeneği
     * (ör. "1 gün kala" VE "7 gün kala" aynı anda) olarak ayarlanabilir.
     * Eski reminder_hours_before sütunu geriye dönük uyumluluk için
     * (ve appointments:send-reminders --hours parametresi için) kalır.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->json('reminder_intervals_days')->nullable()->after('reminder_hours_before');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('reminder_intervals_days');
        });
    }
};
