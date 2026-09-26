<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Denetim (audit) alanları: bir randevuyu en son kimin, hangi
     * işlemle (oluşturuldu/onaylandı/güncellendi/yeniden planlandı/
     * tamamlandı/iptal edildi/gelmedi) değiştirdiğini takip eder.
     * Yönetici bir hata olduğunda kimin yaptığını görebilsin diye.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->foreignId('last_updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->string('last_action')->nullable()->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropConstrainedForeignId('last_updated_by');
            $table->dropColumn('last_action');
        });
    }
};
