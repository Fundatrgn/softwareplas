<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Danışan Portalı öz-değerlendirme test sistemi:
     * - tests: sabit ölçek tanımları (PHQ-9, GAD-7 — seeder ile eklenir)
     * - test_questions: her ölçeğin soruları (0-3 arası, standart 4'lü
     *   sıklık skalası: "Hiç / Birkaç gün / Yarısından fazla gün /
     *   Neredeyse her gün" — tüm sorularda aynı olduğu için ayrı bir
     *   seçenek tablosu yok, cevap sadece 0-3 tamsayı)
     * - test_assignments: bir testin belirli bir danışana atanması;
     *   cevaplar JSON olarak (soru_id => 0-3) tek satırda tutulur,
     *   tamamlanınca toplam puan (score) hesaplanıp kaydedilir.
     */
    public function up(): void
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->unsignedInteger('order')->default(0);
            $table->text('text');
            $table->timestamps();
        });

        Schema::create('test_assignments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->cascadeOnDelete();
            $table->foreignId('test_id')->constrained('tests')->cascadeOnDelete();
            $table->foreignId('appointment_id')->nullable()->constrained('appointments')->nullOnDelete();
            $table->foreignId('assigned_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('status')->default('bekliyor'); // bekliyor | tamamlandi
            $table->json('answers')->nullable();
            $table->unsignedInteger('score')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('test_assignments');
        Schema::dropIfExists('test_questions');
        Schema::dropIfExists('tests');
    }
};
