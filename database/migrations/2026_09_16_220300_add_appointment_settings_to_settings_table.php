<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Randevu/CRM sistemi için Ayarlar paneline eklenen alanlar:
     * çalışma saatleri (gün bazlı), randevu süresi, kapalı (tatil)
     * günler ve bildirim (e-posta/SMS) açma-kapama + SMS sağlayıcı
     * bilgileri. Gerçek bir SMS sağlayıcısı bağlanana kadar
     * sms_provider "log" olarak kalır (bkz. App\Services\Notifications\SmsService).
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->json('working_hours')->nullable()->after('whatsapp_number');
            $table->json('closed_dates')->nullable()->after('working_hours');
            $table->unsignedSmallInteger('appointment_duration_minutes')->default(50)->after('closed_dates');

            $table->boolean('notify_email_enabled')->default(true)->after('appointment_duration_minutes');
            $table->boolean('notify_sms_enabled')->default(false)->after('notify_email_enabled');
            $table->string('sms_provider')->default('log')->after('notify_sms_enabled');
            $table->string('sms_api_key')->nullable()->after('sms_provider');
            $table->string('sms_api_secret')->nullable()->after('sms_api_key');
            $table->string('sms_sender_title')->nullable()->after('sms_api_secret');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'working_hours',
                'closed_dates',
                'appointment_duration_minutes',
                'notify_email_enabled',
                'notify_sms_enabled',
                'sms_provider',
                'sms_api_key',
                'sms_api_secret',
                'sms_sender_title',
            ]);
        });
    }
};
