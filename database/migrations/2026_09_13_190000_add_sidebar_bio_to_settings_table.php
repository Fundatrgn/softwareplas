<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Header'daki menu (hamburger) butonuna tiklaninca acilan yan panelde
     * "Hakkimda" basligi altinda gosterilen kisa tanitim metni. Onceden
     * SEO "description" alaniyla ayni alani paylasiyordu; bu ikisi farkli
     * amaclara hizmet ettigi icin (biri arama motoru ozeti, digeri
     * ziyaretciye gorunen tanitim yazisi) ayri bir alana tasindi.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('sidebar_bio')->nullable()->after('kvkk_text');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('sidebar_bio');
        });
    }
};
