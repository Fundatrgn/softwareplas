<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Randevu hatırlatmasının kaç saat önceden gönderileceği artık
     * admin panelinden ayarlanabilir (bkz. SendAppointmentReminders
     * komutu ve Ayarlar > Randevu Bildirimleri).
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->unsignedSmallInteger('reminder_hours_before')->default(24)->after('sms_sender_title');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('reminder_hours_before');
        });
    }
};
