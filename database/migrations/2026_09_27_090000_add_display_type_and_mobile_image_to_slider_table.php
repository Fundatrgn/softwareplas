<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Admin panelinden slayt eklerken iki farklı kullanım şekli seçilebilsin
     * diye eklendi: "normal" (mevcut metin + görsel düzeni) ve "tam" (görsel
     * tüm alanı kaplar, masaüstü/mobil için ayrı görsel yüklenebilir).
     * "image_mobile" boş bırakılırsa tam modda masaüstü görseli kullanılır.
     */
    public function up(): void
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->string('display_type')->default('normal')->after('text_position');
            $table->string('image_mobile')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn(['display_type', 'image_mobile']);
        });
    }
};
