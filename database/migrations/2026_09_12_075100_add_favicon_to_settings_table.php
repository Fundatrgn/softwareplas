<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Orijinal admin panel formunda favicon yukleme alani vardi
     * ama tabloda karsilik gelen kolon yoktu (kayit sirasinda hataya
     * neden oluyordu). Bu duzeltmeyle favicon gercekten kaydediliyor.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('favicon')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('favicon');
        });
    }
};
