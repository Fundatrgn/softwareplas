<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * "Randevular" tablosu. Hem sitedeki halka açık randevu formundan,
     * hem de admin/CRM panelinden (yüz yüze gelen danışan için) buraya
     * kayıt düşülür. "doctor_notes" seans TAMAMLANDIĞINDA zorunlu tutulur
     * (bkz. AppointmentController), böylece her tamamlanmış randevunun
     * bir seans notu geçmişi oluşur.
     */
    public function up(): void
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->comment('Randevuyu alan/gerçekleştiren personel (psikolog)')->constrained('users')->nullOnDelete();
            $table->foreignId('created_by')->nullable()->comment('Kaydı oluşturan admin kullanıcı; null ise halka açık siteden gelmiştir')->constrained('users')->nullOnDelete();

            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->unsignedSmallInteger('duration_minutes')->default(50);

            $table->string('status')->default('bekliyor');
            // bekliyor | onaylandi | tamamlandi | iptal | gelmedi

            $table->string('source')->default('web');
            // web (halka açık site) | panel (CRM'den planlı) | yuz_yuze (kurumu ziyarete gelen için anlık)

            $table->string('patient_name_snapshot')->nullable();
            $table->string('patient_phone_snapshot')->nullable();
            $table->string('patient_email_snapshot')->nullable();

            $table->text('request_note')->nullable()->comment('Danışanın randevu alırken bıraktığı not/talep');
            $table->text('doctor_notes')->nullable()->comment('Seans sonrası psikolog notu; tamamlandı durumunda zorunlu');
            $table->text('cancel_reason')->nullable();

            $table->timestamp('confirmation_sent_at')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();

            $table->timestamps();

            $table->index(['starts_at', 'ends_at']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
