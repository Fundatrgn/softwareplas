<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Yunuscan ZEYBEK kişisel web platformunun tüm içerik tabloları.
 *
 * Merve Kalaycı projesindeki gibi "önce SQL dökümü, sonra üzerine
 * kolon ekleyen migration'lar" yerine, sıfırdan kurulumda tek adımda
 * eksiksiz şemayı oluşturan tek bir migration kullanılıyor. Admin
 * formlarında boş bırakılabilecek her alan nullable tanımlandı; böylece
 * "NOT NULL" kaynaklı 500 hataları baştan önlenmiş oluyor.
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            // Kimlik & SEO
            $table->string('site_title')->default('Yunuscan ZEYBEK');
            $table->text('description')->nullable();
            $table->text('keywords')->nullable();
            $table->string('author')->nullable();
            $table->string('job_title')->nullable();
            $table->text('same_as')->nullable();
            $table->string('google_verification')->nullable();
            $table->string('analytics_id')->nullable();
            // Görseller
            $table->string('image')->nullable();
            $table->string('logo_footer')->nullable();
            $table->string('favicon')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('og_image')->nullable();
            // İletişim
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('location_text')->nullable();
            $table->string('availability_text')->nullable();
            $table->text('map_embed')->nullable();
            $table->string('whatsapp_number')->nullable();
            // Sosyal medya
            $table->string('instagram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('twitter')->nullable();
            $table->string('youtube')->nullable();
            $table->string('github')->nullable();
            // Görünüm
            $table->string('accent_color')->default('#FD3A25');
            // Anasayfa alıntı kutusu
            $table->text('quote_text')->nullable();
            $table->string('quote_author')->nullable();
            $table->string('quote_role')->nullable();
            // İstatistikler (etiket / sayı / ek)
            $table->json('stats')->nullable();
            // Sayfa sonu
            $table->string('footer_title')->nullable();
            $table->string('footer_copyright_text', 500)->nullable();
            $table->string('footer_menu_title')->nullable();
            $table->longText('kvkk_text')->nullable();
            $table->timestamps();
        });

        Schema::create('slider', function (Blueprint $table) {
            $table->id();
            $table->integer('sira')->default(1);
            $table->string('badge')->nullable();
            $table->string('title');
            $table->string('title2')->nullable();
            $table->text('subtitle')->nullable();
            $table->string('btn_text')->nullable();
            $table->string('btn_url')->nullable();
            $table->string('btn2_text')->nullable();
            $table->string('btn2_url')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('about', function (Blueprint $table) {
            $table->id();
            $table->string('subtitle')->nullable();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('position')->default(0);
            $table->timestamps();
        });

        Schema::create('timeline', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company')->nullable();
            $table->text('description')->nullable();
            $table->string('year')->nullable();
            $table->string('logo')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('services_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('tags')->nullable();
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->nullable();
            $table->string('client')->nullable();
            $table->string('year')->nullable();
            $table->string('url')->nullable();
            $table->text('summary')->nullable();
            $table->string('deliverables')->nullable();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('image_2')->nullable();
            $table->string('image_3')->nullable();
            $table->boolean('is_featured')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('brands', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('url')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('testimonials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role')->nullable();
            $table->text('content');
            $table->string('image')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('process_steps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->string('duration')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('blog_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('blog_posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->longText('content')->nullable();
            $table->string('tags')->nullable();
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->timestamps();
        });

        Schema::create('sss_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('sss', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();
        });

        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('type')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        Schema::create('footer_links', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('url');
            $table->unsignedInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        foreach ([
            'footer_links', 'contact', 'sss', 'sss_categories', 'blog_posts', 'blog_categories',
            'process_steps', 'testimonials', 'brands', 'projects', 'services', 'services_categories',
            'timeline', 'about', 'slider', 'settings',
        ] as $table) {
            Schema::dropIfExists($table);
        }
    }
};
