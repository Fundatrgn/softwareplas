<?php

use App\Http\Controllers\dashboard\BlogCategoryController;
use App\Http\Controllers\dashboard\BlogController;
use App\Http\Controllers\dashboard\CkeditorController;
use App\Http\Controllers\dashboard\ContactController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\FooterMenuController;
use App\Http\Controllers\dashboard\HizmetlerCategories;
use App\Http\Controllers\dashboard\HizmetlerController;
use App\Http\Controllers\dashboard\LoginController;
use App\Http\Controllers\dashboard\ModuleController;
use App\Http\Controllers\dashboard\SettingController;
use App\Http\Controllers\dashboard\SliderController;
use App\Http\Controllers\dashboard\SssCategoryController;
use App\Http\Controllers\dashboard\SssController;
use App\Http\Controllers\dashboard\UsersController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SiteController;
use App\Support\AdminModules;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Halka açık site
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteController::class, 'home']);

// "Yunuscan ZEYBEK kimdir" aramaları için kalıcı (kanonik) Hakkımda adresi.
Route::get('/yunuscan-zeybek-kimdir', [SiteController::class, 'about']);
Route::redirect('/hakkimda', '/yunuscan-zeybek-kimdir', 301);
Route::redirect('/hakkimizda', '/yunuscan-zeybek-kimdir', 301);

Route::get('/hizmetler', [SiteController::class, 'services']);
Route::get('/hizmetler/{slug}', [SiteController::class, 'service']);

Route::get('/projeler', [SiteController::class, 'projects']);
Route::get('/projeler/{slug}', [SiteController::class, 'project']);

Route::get('/blog', [SiteController::class, 'blog']);
Route::get('/blog/kategori/{slug}', [SiteController::class, 'blogCategory']);
Route::get('/blog/{slug}', [SiteController::class, 'blogPost']);

Route::get('/sss', [SiteController::class, 'faq']);
Route::get('/iletisim', [SiteController::class, 'contact']);
Route::post('/iletisim', [ContactController::class, 'store'])->middleware('throttle:5,1');
Route::get('/kvkk', [SiteController::class, 'kvkk']);

Route::get('/sitemap.xml', [SeoController::class, 'sitemap']);
Route::get('/robots.txt', [SeoController::class, 'robots']);

/*
|--------------------------------------------------------------------------
| Yönetim paneli
|--------------------------------------------------------------------------
*/

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('throttle:10,1');

// İçerik bölümleri: Yönetici ve Editör rollerine açık.
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');

    // Anasayfa giriş alanı (hero)
    Route::get('/slider', [SliderController::class, 'index']);
    Route::get('/slider/add', [SliderController::class, 'add']);
    Route::get('/slider/add/{id}', [SliderController::class, 'edit']);
    Route::post('/slider/add', [SliderController::class, 'store']);
    Route::get('/slider/del/{id}', [SliderController::class, 'del']);

    // Blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/add', [BlogController::class, 'add']);
    Route::get('/blog/add/{id}', [BlogController::class, 'edit']);
    Route::post('/blog/add', [BlogController::class, 'store']);
    Route::get('/blog/del/{id}', [BlogController::class, 'del']);
    Route::get('/blog/kategori', [BlogCategoryController::class, 'index']);
    Route::get('/blog/kategori/add', [BlogCategoryController::class, 'add']);
    Route::get('/blog/kategori/add/{id}', [BlogCategoryController::class, 'edit']);
    Route::post('/blog/kategori/add', [BlogCategoryController::class, 'store']);
    Route::get('/blog/kategori/del/{id}', [BlogCategoryController::class, 'del']);

    // SSS
    Route::get('/sss', [SssController::class, 'index']);
    Route::get('/sss/add', [SssController::class, 'add']);
    Route::get('/sss/add/{id}', [SssController::class, 'edit']);
    Route::post('/sss/add', [SssController::class, 'store']);
    Route::get('/sss/del/{id}', [SssController::class, 'del']);
    Route::get('/sss/kategori', [SssCategoryController::class, 'index']);
    Route::get('/sss/kategori/add', [SssCategoryController::class, 'add']);
    Route::get('/sss/kategori/add/{id}', [SssCategoryController::class, 'edit']);
    Route::post('/sss/kategori/add', [SssCategoryController::class, 'store']);
    Route::get('/sss/kategori/del/{id}', [SssCategoryController::class, 'del']);

    // Hizmetler
    Route::get('/hizmetler', [HizmetlerController::class, 'index']);
    Route::get('/hizmetler/add', [HizmetlerController::class, 'add']);
    Route::get('/hizmetler/add/{id}', [HizmetlerController::class, 'edit']);
    Route::post('/hizmetler/add', [HizmetlerController::class, 'store']);
    Route::get('/hizmetler/del/{id}', [HizmetlerController::class, 'del']);
    Route::get('/hizmetler/kategori', [HizmetlerCategories::class, 'index']);
    Route::get('/hizmetler/kategori/add', [HizmetlerCategories::class, 'add']);
    Route::get('/hizmetler/kategori/add/{id}', [HizmetlerCategories::class, 'edit']);
    Route::post('/hizmetler/kategori/add', [HizmetlerCategories::class, 'store']);
    Route::get('/hizmetler/kategori/del/{id}', [HizmetlerCategories::class, 'del']);

    // Ortak içerik modülleri: projeler, markalar, yorumlar, kariyer,
    // hakkımda blokları, çalışma süreci (bkz. App\Support\AdminModules).
    $modules = array_keys(AdminModules::all());
    Route::get('/{module}', [ModuleController::class, 'index'])->whereIn('module', $modules);
    Route::get('/{module}/add', [ModuleController::class, 'add'])->whereIn('module', $modules);
    Route::get('/{module}/add/{id}', [ModuleController::class, 'edit'])->whereIn('module', $modules)->whereNumber('id');
    Route::post('/{module}/add', [ModuleController::class, 'store'])->whereIn('module', $modules);
    Route::get('/{module}/del/{id}', [ModuleController::class, 'del'])->whereIn('module', $modules)->whereNumber('id');
});

// Site yönetimi: sadece "Yönetici" rolü.
Route::prefix('/admin')->middleware(['auth', 'role:yonetici'])->group(function () {
    Route::get('/ayarlar', [SettingController::class, 'index']);
    Route::post('/ayarlar/add', [SettingController::class, 'store']);

    Route::get('/footer-menu', [FooterMenuController::class, 'index']);
    Route::get('/footer-menu/add', [FooterMenuController::class, 'add']);
    Route::get('/footer-menu/add/{id}', [FooterMenuController::class, 'edit']);
    Route::post('/footer-menu/add', [FooterMenuController::class, 'store']);
    Route::get('/footer-menu/del/{id}', [FooterMenuController::class, 'del']);
    Route::post('/footer-menu/baslik', [FooterMenuController::class, 'updateBaslik']);

    Route::get('/kullanicilar', [UsersController::class, 'index']);
    Route::get('/kullanicilar/add', [UsersController::class, 'add']);
    Route::get('/kullanicilar/add/{id}', [UsersController::class, 'edit']);
    Route::post('/kullanicilar/add', [UsersController::class, 'store']);
    Route::get('/kullanicilar/del/{id}', [UsersController::class, 'del']);

    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/contact/add/{id}', [ContactController::class, 'edit']);
    Route::get('/contact/del/{id}', [ContactController::class, 'del']);
});
