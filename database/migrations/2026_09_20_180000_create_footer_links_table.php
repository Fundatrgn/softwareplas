<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Footer'da "Hizmetlerimiz" sekmesinin yanına eklenen, admin
     * panelinden yönetilebilen üçüncü bağlantı listesi (bkz.
     * FooterMenuController). Başlık settings.footer_menu_title'da
     * tutulur, buradaki her satır o listenin bir bağlantısıdır.
     */
    public function up(): void
    {
        Schema::create('footer_links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->string('footer_menu_title', 255)->nullable()->after('footer_copyright_text');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('footer_links');
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('footer_menu_title');
        });
    }
};
