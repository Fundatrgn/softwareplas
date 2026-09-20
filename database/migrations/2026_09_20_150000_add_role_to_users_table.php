<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Admin panelinde rol bazlı yetkilendirme: "yonetici" (tam erişim +
     * kullanıcı/rol yönetimi) ve "psikolog" (sadece randevu/CRM bölümü:
     * Randevu Takvimi, Danışanlar, Raporlar). Mevcut kullanıcılar geriye
     * dönük uyumluluk için "yonetici" olarak varsayılır.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('yonetici')->after('email');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
};
