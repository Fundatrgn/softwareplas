<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Bu alanlar, admin panelindeki "Site Gorunumu / Renkler" bolumunden
     * sitenin ana renklerinin ve WhatsApp hizli randevu numarasinin
     * yonetilebilmesi icin eklenmistir.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('accent_color')->default('#D9784B')->after('address');
            $table->string('secondary_color')->default('#7FA36F')->after('accent_color');
            $table->string('heading_color')->default('#FFFFFF')->after('secondary_color');
            $table->string('body_text_color')->default('#E7E3D8')->after('heading_color');
            $table->string('background_color')->default('#1B1F1C')->after('body_text_color');
            $table->string('whatsapp_number')->nullable()->after('background_color');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'accent_color',
                'secondary_color',
                'heading_color',
                'body_text_color',
                'background_color',
                'whatsapp_number',
            ]);
        });
    }
};
