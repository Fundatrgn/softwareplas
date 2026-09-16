<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Site "koyu zemin" (v2) temasindan "acik zemin" temasina donuyor.
     * Sadece hala eski koyu varsayilan degerlerde duran (yani kimsenin
     * panelden ozellestirmedigi) mevcut settings satirlarini yeni acik
     * degerlere tasir. Panelden bilerek baska bir renk secmis olan
     * kurulumlara dokunmaz. Kolon DEFAULT'u degistirmiyoruz cunku
     * SettingController::store() degeri her zaman acikca yaziyor
     * (bkz. app/Http/Controllers/dashboard/SettingController.php).
     */
    public function up(): void
    {
        DB::table('settings')
            ->where('heading_color', '#FFFFFF')
            ->update(['heading_color' => '#1F2D30']);

        DB::table('settings')
            ->where('body_text_color', '#E7E3D8')
            ->update(['body_text_color' => '#4B5A5E']);

        DB::table('settings')
            ->where('background_color', '#1B1F1C')
            ->update(['background_color' => '#F7F5F0']);
    }

    public function down(): void
    {
        DB::table('settings')
            ->where('heading_color', '#1F2D30')
            ->update(['heading_color' => '#FFFFFF']);

        DB::table('settings')
            ->where('body_text_color', '#4B5A5E')
            ->update(['body_text_color' => '#E7E3D8']);

        DB::table('settings')
            ->where('background_color', '#F7F5F0')
            ->update(['background_color' => '#1B1F1C']);
    }
};
