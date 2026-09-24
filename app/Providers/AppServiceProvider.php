<?php

namespace App\Providers;

use App\Models\FooterLink;
use App\Models\Services;
use App\Models\Setting;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Tablolar henüz oluşmamışsa (ilk kurulum / "php artisan migrate"
        // sırasında) sorgu atılmaz; aksi halde migrate komutu bile hata verir.
        View::composer('*', function ($view) {
            static $shared = null;

            if ($shared === null) {
                $shared = [
                    'settings' => null,
                    'footer_links' => collect(),
                    'menu_services' => collect(),
                ];
                try {
                    if (Schema::hasTable('settings')) {
                        $shared['settings'] = Setting::first();
                    }
                    if (Schema::hasTable('footer_links')) {
                        $shared['footer_links'] = FooterLink::orderBy('order')->orderBy('id')->get();
                    }
                    if (Schema::hasTable('services')) {
                        $shared['menu_services'] = Services::orderBy('order')->get(['id', 'title', 'slug']);
                    }
                } catch (\Throwable $e) {
                    // Veritabanı bağlantısı yoksa site yine de hata sayfasını gösterebilsin.
                }
            }

            foreach ($shared as $key => $value) {
                if (! array_key_exists($key, $view->getData())) {
                    $view->with($key, $value);
                }
            }
        });
    }
}
