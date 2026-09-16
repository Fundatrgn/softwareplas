<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Randevu/iletisim formlarindaki KVKK onay kutusunda gosterilecek
     * aydinlatma metni. Admin panelinden duzenlenebilir olmasi icin
     * settings tablosuna eklendi.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->longText('kvkk_text')->nullable()->after('slider_speed');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('kvkk_text');
        });
    }
};
