<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Anasayfa slider'ındaki başlık/açıklama metni şablonda her zaman
     * ortalıydı. Admin panelinden görsele göre metnin sola, ortaya ya
     * da sağa yaslanabilmesi için eklendi (bkz. general/home.blade.php
     * ve dashboard/slider/add.blade.php).
     */
    public function up(): void
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->string('text_position')->default('orta')->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn('text_position');
        });
    }
};
