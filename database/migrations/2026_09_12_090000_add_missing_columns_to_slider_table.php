<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Orijinal migration'da slider tablosuna "sira" (siralama) ve "image"
     * (gorsel) kolonlari eksikti, ama hem admin panel kontrolcusu hem de
     * anasayfa gorunumu bu iki alani kullaniyordu. Bu eksiklik, sifir bir
     * kurulumda slider ekleme/listelemeyi SQL hatasiyla cokertiyordu.
     */
    public function up(): void
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->integer('sira')->default(1)->after('id');
            $table->string('image')->nullable()->after('btn_text');
        });
    }

    public function down(): void
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn(['sira', 'image']);
        });
    }
};
