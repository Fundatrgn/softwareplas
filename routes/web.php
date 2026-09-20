<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\dashboard\AppointmentController as DashboardAppointmentController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\dashboard\BlogCategoryController;
use App\Http\Controllers\dashboard\BlogController;
use App\Http\Controllers\dashboard\CkeditorController;
use App\Http\Controllers\dashboard\ContactController;
use App\Http\Controllers\dashboard\EmailSettingController;
use App\Http\Controllers\dashboard\FooterMenuController;
use App\Http\Controllers\dashboard\PatientController;
use App\Http\Controllers\dashboard\ReportController;
use App\Http\Controllers\dashboard\HakkimizdaController;
use App\Http\Controllers\dashboard\HizmetlerCategories;
use App\Http\Controllers\dashboard\HizmetlerController;
use App\Http\Controllers\dashboard\HizmetlerDetayController;
use App\Http\Controllers\dashboard\LoginController;
use App\Http\Controllers\dashboard\ReferansCategoryController;
use App\Http\Controllers\dashboard\ReferansController;
use App\Http\Controllers\dashboard\SettingController as DashboardSettingController;
use App\Http\Controllers\dashboard\SssCategoryController;
use App\Http\Controllers\dashboard\SssController;
use App\Http\Controllers\dashboard\TarihceController;
use App\Http\Controllers\dashboard\TeamController;
use App\Http\Controllers\dashboard\UsersController;
use App\Http\Controllers\dashboard\SliderController;
use App\Http\Controllers\general\AppointmentController as GeneralAppointmentController;
use App\Http\Controllers\general\BlogController as GeneralBlogController;
use App\Http\Controllers\general\HakkimizdaController as GeneralHakkimizdaController;
use App\Http\Controllers\general\HizmetlerController as GeneralHizmetlerController;
use App\Http\Controllers\general\ReferansController as GeneralReferansController;
use App\Http\Controllers\general\SSSController as GeneralSSSController;
use App\Http\Controllers\general\TeamController as GeneralTeamController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReferansController as ControllersReferansController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[HomeController::class,'index']);

Route::get('/hakkimizda', [GeneralHakkimizdaController::class, 'index']);
Route::get('/ekibimiz', [GeneralTeamController::class, 'index']);
Route::get('/ekibimiz/{id}/{slug}', [GeneralTeamController::class, 'detay']);

Route::get('/blog', [GeneralBlogController::class, 'index']);
Route::get('/blog/{category_id}/{slug}', [GeneralBlogController::class, 'category']);
Route::get('/blog/search', [GeneralBlogController::class, 'search']);
Route::get('/blog/detay/{id}/{slug}', [GeneralBlogController::class, 'detay']);

Route::get('/sss', [GeneralSSSController::class, 'index']);
Route::get('/sss/{category_id}/{slug}', [GeneralSSSController::class, 'category']);

Route::get('/hizmetler', [GeneralHizmetlerController::class, 'index']);
Route::get('/hizmetler/{category_id}/{slug}', [GeneralHizmetlerController::class, 'category']);
Route::get('/hizmetler/detay/{id}/{slug}', [GeneralHizmetlerController::class, 'detay']);

// Not: /referanslarimiz rotaları kaldırıldı. Bir psikoloğun danışan/proje
// "referansı" göstermesi hem gizlilik ilkesine aykırı hem de bu tabloların
// (referans_categories, referans_logo) migration'da hiç tanımlı olmaması
// nedeniyle zaten 500 hatasıyla çöküyordu.

Route::get('/iletisim', function () {
    return view('general.contact');
});
Route::get('/randevu', [GeneralAppointmentController::class, 'index']);
Route::get('/randevu/musaitlik', [GeneralAppointmentController::class, 'monthAvailability']);
Route::get('/randevu/saatler', [GeneralAppointmentController::class, 'dayAvailability']);
Route::post('/randevu', [GeneralAppointmentController::class, 'store']);
Route::get('/randevu/iptal/{id}', [GeneralAppointmentController::class, 'cancel'])
    ->whereNumber('id')
    ->middleware('signed')
    ->name('randevu.iptal');
Route::post('/iletisim', [ContactController::class,'store']);
Route::post('ckeditor/image_upload', [CkeditorController::class, 'upload'])->name('upload');



Route::get('login', [LoginController::class,'index'])->name('login');
Route::post('/login',[LoginController::class,'login']);
Route::prefix('/admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('/logout',[LoginController::class,'logout']);

    // Randevular (CRM)
    Route::get('/randevular', [DashboardAppointmentController::class, 'index']);
    Route::get('/randevular/liste', [DashboardAppointmentController::class, 'liste']);
    Route::get('/randevular/ay', [DashboardAppointmentController::class, 'month']);
    Route::get('/randevular/gun', [DashboardAppointmentController::class, 'day']);
    Route::get('/randevular/ekle', [DashboardAppointmentController::class, 'create']);
    Route::post('/randevular', [DashboardAppointmentController::class, 'store']);
    Route::get('/randevular/{id}', [DashboardAppointmentController::class, 'show'])->whereNumber('id');
    Route::get('/randevular/{id}/duzenle', [DashboardAppointmentController::class, 'edit'])->whereNumber('id');
    Route::post('/randevular/{id}/guncelle', [DashboardAppointmentController::class, 'update'])->whereNumber('id');
    Route::post('/randevular/{id}/sil', [DashboardAppointmentController::class, 'destroy'])->whereNumber('id');
    Route::post('/randevular/{id}/durum', [DashboardAppointmentController::class, 'updateStatus'])->whereNumber('id');
    Route::post('/randevular/{id}/tasi', [DashboardAppointmentController::class, 'reschedule'])->whereNumber('id');
    // Randevular

    // Danışanlar (CRM)
    Route::get('/danisanlar', [PatientController::class, 'index']);
    Route::get('/danisanlar/ara', [DashboardAppointmentController::class, 'searchPatients']);
    Route::get('/danisanlar/add', [PatientController::class, 'add']);
    Route::post('/danisanlar/add', [PatientController::class, 'store']);
    Route::get('/danisanlar/add/{id}', [PatientController::class, 'edit'])->whereNumber('id');
    Route::get('/danisanlar/{id}', [PatientController::class, 'show'])->whereNumber('id');
    Route::get('/danisanlar/{id}/pdf', [PatientController::class, 'pdfReport'])->whereNumber('id');
    // Danışanlar

    // Raporlar (CRM)
    Route::get('/raporlar', [ReportController::class, 'index']);
    // Raporlar
});

// Aşağıdaki içerik yönetimi bölümleri sadece "Yönetici" rolüne açık;
// "Psikolog" rolündeki kullanıcılar sadece yukarıdaki randevu/CRM
// bölümüne erişebilir (bkz. App\Http\Middleware\EnsureRole).
Route::prefix('/admin')->middleware(['auth', 'role:yonetici'])->group(function () {
    // hakkımızda
    Route::get('/hakkimizda', [HakkimizdaController::class, 'index']);
    Route::get('/hakkimizda/add', [HakkimizdaController::class, 'add']);
    Route::get('/hakkimizda/add/{id}', [HakkimizdaController::class, 'edit']);
    Route::post('/hakkimizda/add', [HakkimizdaController::class, 'store']);
    Route::get('/hakkimizda/del/{id}', [HakkimizdaController::class, 'del']);
    // hakkımızda
    // Ekibimiz
    Route::get('/ekibimiz', [TeamController::class, 'index']);
    Route::get('/ekibimiz/add', [TeamController::class, 'add']);
    Route::get('/ekibimiz/add/{id}', [TeamController::class, 'edit']);
    Route::post('/ekibimiz/add', [TeamController::class, 'store']);
    Route::get('/ekibimiz/del/{id}', [TeamController::class, 'del']);
    // Ekibimiz
    // Ekibimiz
    Route::get('/slider', [SliderController::class, 'index']);
    Route::get('/slider/add', [SliderController::class, 'add']);
    Route::get('/slider/add/{id}', [SliderController::class, 'edit']);
    Route::post('/slider/add', [SliderController::class, 'store']);
    Route::get('/slider/del/{id}', [SliderController::class, 'del']);
    Route::post('/slider/hiz', [SliderController::class, 'updateSpeed']);

    // Footer Menü (Hizmetlerimiz'in yanındaki üçüncü bağlantı listesi)
    Route::get('/footer-menu', [FooterMenuController::class, 'index']);
    Route::get('/footer-menu/add', [FooterMenuController::class, 'add']);
    Route::get('/footer-menu/add/{id}', [FooterMenuController::class, 'edit']);
    Route::post('/footer-menu/add', [FooterMenuController::class, 'store']);
    Route::get('/footer-menu/del/{id}', [FooterMenuController::class, 'del']);
    Route::post('/footer-menu/baslik', [FooterMenuController::class, 'updateBaslik']);
    // Referanslar (Portfolyo) özelliği bu site için tamamen kaldırıldı.
    // tarihce
    Route::get('/tarihce', [TarihceController::class, 'index']);
    Route::get('/tarihce/add', [TarihceController::class, 'add']);
    Route::get('/tarihce/add/{id}', [TarihceController::class, 'edit']);
    Route::post('/tarihce/add', [TarihceController::class, 'store']);
    Route::get('/tarihce/del/{id}', [TarihceController::class, 'del']);
    // tarihce
    // Blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blog/add', [BlogController::class, 'add']);
    Route::get('/blog/add/{id}', [BlogController::class, 'edit']);
    Route::post('/blog/add', [BlogController::class, 'store']);
    Route::get('/blog/del/{id}', [BlogController::class, 'del']);
    // Blog
    // Blog Kategori
    Route::get('/blog/kategori', [BlogCategoryController::class, 'index']);
    Route::get('/blog/kategori/add', [BlogCategoryController::class, 'add']);
    Route::get('/blog/kategori/add/{id}', [BlogCategoryController::class, 'edit']);
    Route::post('/blog/kategori/add', [BlogCategoryController::class, 'store']);
    Route::get('/blog/kategori/del/{id}', [BlogCategoryController::class, 'del']);
    // Blog Kategori
    // SSS
    Route::get('/sss', [SssController::class, 'index']);
    Route::get('/sss/add', [SssController::class, 'add']);
    Route::get('/sss/add/{id}', [SssController::class, 'edit']);
    Route::post('/sss/add', [SssController::class, 'store']);
    Route::get('/sss/del/{id}', [SssController::class, 'del']);
    // SSS
    // SSS Kategori
    Route::get('/sss/kategori', [SssCategoryController::class, 'index']);
    Route::get('/sss/kategori/add', [SssCategoryController::class, 'add']);
    Route::get('/sss/kategori/add/{id}', [SssCategoryController::class, 'edit']);
    Route::post('/sss/kategori/add', [SssCategoryController::class, 'store']);
    Route::get('/sss/kategori/del/{id}', [SssCategoryController::class, 'del']);
    // SSS Kategori

    // Kullanicilar
    Route::get('/kullanicilar', [UsersController::class, 'index']);
    Route::get('/kullanicilar/add', [UsersController::class, 'add']);
    Route::get('/kullanicilar/add/{id}', [UsersController::class, 'edit']);
    Route::post('/kullanicilar/add', [UsersController::class, 'store']);
    Route::get('/kullanicilar/del/{id}', [UsersController::class, 'del']);
    // Kullanicilar

    // ayarlar
    Route::get('/ayarlar', [DashboardSettingController::class, 'index']);
    Route::get('/ayarlar/add', [DashboardSettingController::class, 'add']);
    Route::get('/ayarlar/add/{id}', [DashboardSettingController::class, 'edit']);
    Route::post('/ayarlar/add', [DashboardSettingController::class, 'store']);
    Route::get('/ayarlar/del/{id}', [DashboardSettingController::class, 'del']);
    // ayarlar

    // E-posta Ayarları (randevu onay/hatırlatma e-postaları)
    Route::get('/email-ayarlar', [EmailSettingController::class, 'index']);
    Route::post('/email-ayarlar', [EmailSettingController::class, 'store']);
    Route::get('/email-ayarlar/onizleme', [EmailSettingController::class, 'preview']);
    // ayarlar
    Route::get('/contact', [ContactController::class, 'index']);
    Route::get('/contact/add', [ContactController::class, 'add']);
    Route::get('/contact/add/{id}', [ContactController::class, 'edit']);
    Route::post('/contact/add', [ContactController::class, 'store']);
    Route::get('/contact/del/{id}', [ContactController::class, 'del']);
    // ayarlar
    // ayarlar
    Route::get('/hizmetler', [HizmetlerController::class, 'index']);
    Route::get('/hizmetler/add', [HizmetlerController::class, 'add']);
    Route::get('/hizmetler/add/{id}', [HizmetlerController::class, 'edit']);
    Route::post('/hizmetler/add', [HizmetlerController::class, 'store']);
    Route::get('/hizmetler/del/{id}', [HizmetlerController::class, 'del']);
    // ayarlar
    // ayarlar
    Route::get('/hizmetler/detay/{id}', [HizmetlerDetayController::class, 'index']);
    Route::get('/hizmetler/detay/add/{id}', [HizmetlerDetayController::class, 'add']);
    Route::get('/hizmetler/detay/add/{service_id}/{id}', [HizmetlerDetayController::class, 'edit']);
    Route::post('/hizmetler/detay/add', [HizmetlerDetayController::class, 'store']);
    Route::get('/hizmetler/detay/del/{id}', [HizmetlerDetayController::class, 'del']);
    // ayarlar
    Route::get('/hizmetler/kategori', [HizmetlerCategories::class, 'index']);
    Route::get('/hizmetler/kategori/add', [HizmetlerCategories::class, 'add']);
    Route::get('/hizmetler/kategori/add/{id}', [HizmetlerCategories::class, 'edit']);
    Route::post('/hizmetler/kategori/add', [HizmetlerCategories::class, 'store']);
    Route::get('/hizmetler/kategori/del/{id}', [HizmetlerCategories::class, 'del']);
});
