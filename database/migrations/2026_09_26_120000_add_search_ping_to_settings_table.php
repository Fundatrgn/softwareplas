<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Blog yayınlandığında arama motorlarına (Bing/Yandex: IndexNow
     * protokolü; Google: en iyi çaba ile sitemap ping) otomatik haber
     * verme özelliği için ayarlar.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->boolean('search_ping_enabled')->default(true);
            $table->string('indexnow_key')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['search_ping_enabled', 'indexnow_key']);
        });
    }
};
