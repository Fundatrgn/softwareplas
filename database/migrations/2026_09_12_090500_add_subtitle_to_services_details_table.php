<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Hizmet detay sayfasi gorunumu (service-detail.blade.php) bir "subtitle"
     * (kucuk ust baslik / kicker) alanini gosteriyordu ama ne migration'da
     * ne de admin panel formunda bu alan mevcuttu.
     */
    public function up(): void
    {
        Schema::table('services_details', function (Blueprint $table) {
            $table->string('subtitle')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('services_details', function (Blueprint $table) {
            $table->dropColumn('subtitle');
        });
    }
};
