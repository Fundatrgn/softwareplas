<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * "sss" tablosundaki "category_id" alani NOT NULL (bos birakilamaz)
     * olarak tanimliydi. Admin formunda "Kategori" secimi zorunlu
     * olmadigi icin (ozellikle henuz hic kategori olusturulmamissa),
     * yeni bir soru eklemeye calisildiginda kayit "category_id cannot
     * be null" SQL hatasiyla cokuyordu.
     *
     * Not: Schema Blueprint'in ->change() metodu doctrine/dbal
     * paketini gerektiriyor (bu ortamda kurulu degil), bu yuzden
     * dogrudan SQL kullaniliyor.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE `sss` MODIFY `category_id` INT NULL");
    }

    public function down(): void
    {
        // Guvenli geri alma: eski NOT NULL kisitlamasini zorlamiyoruz.
    }
};
