<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Footer ve mobil menü gibi koyu zeminli alanlarda kullanılmak üzere
     * logonun beyaz/açık renkli sürümü. Boş bırakılırsa ana logo (image)
     * kullanılmaya devam eder.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('logo_white')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('logo_white');
        });
    }
};
