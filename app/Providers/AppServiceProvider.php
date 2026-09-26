<?php

namespace App\Providers;

use App\Models\FooterLink;
use App\Models\Page;
use App\Models\Services;
use App\Models\ServicesCategory;
use App\Models\Setting;
use App\Models\Statics;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // view()->share('statics', Statics::get());
        // view()->share('statics_header', Statics::find(1));
        // view()->share('statics_contact', Statics::find(2));
        // view()->share('statics_hizmet', Statics::find(3));
        // view()->share('statics_referans', Statics::find(4));
        // view()->share('statics_tarihce', Statics::find(5));
        // view()->share('statics_video', Statics::find(6));
        // view()->share('statics_takim', Statics::find(7));
        // view()->share('statics_blog', Statics::find(8));
        // view()->share('statics_slogan', Statics::find(9));
        // view()->share('statics_ozelTeklif', Statics::find(10));
        // view()->share('statics_iletisim', Statics::find(11));
        // Tablolar henüz oluşmamışsa (ör. ilk kurulum / artisan migrate sırasında)
        // sorgu atmayı atla; aksi halde "php artisan migrate" komutu bile hata verir.
        if (Schema::hasTable('settings')) {
            view()->share('settings', Setting::first());
        }
        if (Schema::hasTable('services_categories')) {
            view()->share('services_categories', ServicesCategory::get());
        }
        if (Schema::hasTable('services')) {
            view()->share('services', Services::orderBy('order', 'ASC')->get());
        }
        if (Schema::hasTable('footer_links')) {
            view()->share('footer_links', FooterLink::orderBy('order')->orderBy('id')->get());
        }
        if (Schema::hasTable('pages')) {
            view()->share('custom_pages', Page::orderBy('order')->orderBy('id')->get());
        }
    }
}
