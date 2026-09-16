<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Anasayfa slider'inin otomatik gecis suresini (milisaniye) admin
     * panelinden ayarlanabilir hale getirmek icin eklendi.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->integer('slider_speed')->default(6000)->after('whatsapp_number');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('slider_speed');
        });
    }
};
