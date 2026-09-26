<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Admin panelinden yapıştırılan Google Ads/Analytics ve Meta (Facebook)
     * Pixel kodları; sitenin her sayfasının <head> bölümüne olduğu gibi
     * enjekte edilir (bkz. general/layout/header.blade.php).
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->longText('google_ads_code')->nullable();
            $table->longText('meta_pixel_code')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['google_ads_code', 'meta_pixel_code']);
        });
    }
};
