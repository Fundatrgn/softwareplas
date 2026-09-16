<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Randevu bildirimleri (e-posta/SMS) için gönderim geçmişi. Şu an
     * e-posta çalışır durumda, SMS için gerçek bir sağlayıcı henüz
     * bağlı değil ("log" sürücüsü ile sadece burada kayıt tutulur) —
     * bkz. App\Services\Notifications\SmsService. İleride gerçek bir
     * SMS sağlayıcısı bağlanınca bu tablo aynen kullanılmaya devam eder.
     */
    public function up(): void
    {
        Schema::create('notification_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->cascadeOnDelete();
            $table->string('channel'); // email | sms
            $table->string('type'); // olusturuldu | hatirlatma | iptal | onay
            $table->string('recipient')->nullable();
            $table->string('status')->default('gonderildi'); // gonderildi | basarisiz | beklemede
            $table->text('message')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notification_logs');
    }
};
