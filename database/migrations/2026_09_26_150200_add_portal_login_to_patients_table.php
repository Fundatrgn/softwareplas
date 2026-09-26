<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Danışan Portalı girişi: randevusu onaylanan danışana otomatik
     * üretilip e-postayla gönderilen kullanıcı adı/şifre. Danışan kendi
     * şifresini asla sıfırlayamaz — bu bilerek admin panelinden
     * (PatientController) yönetilen tek yönlü bir alandır.
     */
    public function up(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->string('username')->nullable()->unique()->after('email');
            $table->string('password')->nullable()->after('username');
            $table->timestamp('portal_credentials_sent_at')->nullable()->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn(['username', 'password', 'portal_credentials_sent_at']);
        });
    }
};
