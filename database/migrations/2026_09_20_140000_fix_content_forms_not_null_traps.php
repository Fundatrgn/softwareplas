<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Blog ("Blog Ekle") ve Hizmetler ("Hizmetler Ekle" / "Hizmet Detayı Ekle")
     * formlarında "Kategori" ve "Görsel" alanları hiçbir zaman zorunlu
     * (required) değildi, ama karşılık gelen veritabanı kolonları
     * NOT NULL idi. Sonuç: kategori seçmeden ya da görsel yüklemeden
     * (özellikle henüz hiç kategori oluşturulmamış yeni bir kurulumda)
     * kayıt eklemeye çalışıldığında "NOT NULL constraint failed" /
     * "Field doesn't have a default value" SQL hatasıyla 500 dönüyordu
     * (bkz. blog_posts.category_id, services.category_id,
     * services.image, services_details.image).
     *
     * Bu, database/migrations/2026_09_13_160000_make_sss_category_nullable.php
     * ile aynı sınıftan bir sorun; aynı çözüm burada da uygulanıyor.
     * ->change() doctrine/dbal gerektirdiği ve bazı ortamlarda kurulu
     * olmadığı için (bkz. o migration'ın notu), doğrudan SQL kullanılıyor.
     */
    public function up(): void
    {
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        DB::statement("ALTER TABLE `blog_posts` MODIFY `category_id` INT NULL");
        DB::statement("ALTER TABLE `blog_posts` MODIFY `image` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `blog_posts` MODIFY `tags` VARCHAR(255) NULL");

        DB::statement("ALTER TABLE `services` MODIFY `category_id` VARCHAR(255) NULL");
        DB::statement("ALTER TABLE `services` MODIFY `image` VARCHAR(255) NULL");

        DB::statement("ALTER TABLE `services_details` MODIFY `image` VARCHAR(255) NULL");
    }

    public function down(): void
    {
        // Güvenli geri alma: eski NOT NULL kısıtlamasını zorlamıyoruz.
    }
};
