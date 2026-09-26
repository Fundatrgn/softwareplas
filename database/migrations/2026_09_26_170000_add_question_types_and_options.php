<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Admin'in kendi testlerini/sorularını hazırlayabilmesi için:
     * - test_questions.type: soru cevap tipi (tek seçim / çoklu seçim /
     *   açık uçlu yazılı cevap)
     * - test_question_options: tek/çoklu seçimli sorular için seçenekler
     *   (etiket + puan değeri); PHQ-9/GAD-7 dahil TÜM testler aynı
     *   yapıyı kullanır (bkz. PsychTestsSeeder güncellemesi).
     * - test_assignments.question_ids: bir atamaya özel olarak testin
     *   hangi sorularının dahil edileceği (null ise testin tüm
     *   soruları kullanılır).
     */
    public function up(): void
    {
        Schema::table('test_questions', function (Blueprint $table) {
            $table->string('type')->default('single_choice')->after('text');
            // single_choice | multi_choice | text
        });

        Schema::create('test_question_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_question_id')->constrained('test_questions')->cascadeOnDelete();
            $table->string('label');
            $table->integer('value')->default(0);
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::table('test_assignments', function (Blueprint $table) {
            $table->json('question_ids')->nullable()->after('appointment_id');
        });
    }

    public function down(): void
    {
        Schema::table('test_assignments', function (Blueprint $table) {
            $table->dropColumn('question_ids');
        });
        Schema::dropIfExists('test_question_options');
        Schema::table('test_questions', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
