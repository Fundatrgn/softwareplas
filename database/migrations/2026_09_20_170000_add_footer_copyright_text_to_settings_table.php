<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Footer'daki telif hakkı metni artık kodda sabit değil, admin
     * panelinden (Ayarlar > Footer Ayarları) düzenlenebilir.
     */
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->string('footer_copyright_text', 500)->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn('footer_copyright_text');
        });
    }
};
