<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * "first", "second", "threed" alanlari orijinal sablonda kullanilmayan,
     * admin formunda hic gosterilmeyen eski/kalinti kolonlardi. Ama
     * veritabaninda NOT NULL (varsayilan degersiz) olarak tanimliydilar.
     * Admin panelinden yeni bir slider eklendiginde kontrolcu bu alanlara
     * hic deger yazmadigi icin kayit "Field 'first' doesn't have a
     * default value" SQL hatasiyla cokuyordu.
     *
     * Not: Schema Blueprint'in ->change() metodu doctrine/dbal paketini
     * gerektiriyor (bu ortamda kurulu degil), bu yuzden dogrudan SQL
     * kullaniliyor.
     */
    public function up(): void
    {
        DB::statement("UPDATE `slider` SET `first` = '' WHERE `first` IS NULL");
        DB::statement("UPDATE `slider` SET `second` = '' WHERE `second` IS NULL");
        DB::statement("UPDATE `slider` SET `threed` = '' WHERE `threed` IS NULL");

        DB::statement("ALTER TABLE `slider` MODIFY `first` VARCHAR(255) NULL DEFAULT ''");
        DB::statement("ALTER TABLE `slider` MODIFY `second` VARCHAR(255) NULL DEFAULT ''");
        DB::statement("ALTER TABLE `slider` MODIFY `threed` VARCHAR(255) NULL DEFAULT ''");
    }

    public function down(): void
    {
        // Guvenli geri alma: eski NOT NULL kisitlamasini zorlamiyoruz.
    }
};
