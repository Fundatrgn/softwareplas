<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * "subtitle" kolonu VARCHAR(255) olarak tanimliydi, ama kullanicilar
     * dogal olarak bundan daha uzun, birden fazla cumlelik aciklama
     * metinleri yaziyor. Bu, "Data too long for column" SQL hatasina
     * yol aciyordu. Kolon artik pratik olarak sinirsiz uzunlukta metin
     * kabul eden TEXT tipine genisletildi.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE `slider` MODIFY `subtitle` TEXT NULL");
    }

    public function down(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE `slider` MODIFY `subtitle` VARCHAR(255) NULL");
    }
};
