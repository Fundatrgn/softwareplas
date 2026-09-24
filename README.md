# Yunuscan ZEYBEK — Kişisel Web Platformu

"Yunuscan ZEYBEK kimdir?" diye arayanların sizi, yaptığınız işleri,
hizmetlerinizi ve yazılarınızı tek yerde bulacağı kişisel web sitesi ve
yönetim paneli.

- **Ön yüz:** Satın aldığınız **Aigocy** HTML şablonu, Laravel Blade'e
  dönüştürüldü ve tamamen Türkçeleştirildi.
- **Yönetim paneli:** Psikolog Merve Kalaycı sitesi için yaptığımız
  panelin aynısı (aynı tema, aynı kullanım mantığı). Merve Hanım'ın
  deposunda **hiçbir dosya değiştirilmedi**; panel buraya kopyalanıp
  size göre uyarlandı.
- Ürün satışı / sepet / ödeme yok. Randevu–CRM–danışan bölümleri bu
  projeden çıkarıldı.

---

## Sayfalar

| Adres | İçerik |
|---|---|
| `/` | Anasayfa: giriş alanı, kısa tanıtım, markalar, hizmetler, öne çıkan projeler, çalışma süreci, istatistikler, blog, SSS, iletişim |
| `/yunuscan-zeybek-kimdir` | **Hakkımda** — "Yunuscan ZEYBEK Kimdir?" (SEO için ana sayfa). `/hakkimda` buraya yönlenir |
| `/hizmetler`, `/hizmetler/{hizmet}` | Hizmetler ve hizmet detayları |
| `/projeler`, `/projeler/{proje}` | Yaptığım işler ve proje detayları |
| `/blog`, `/blog/{yazi}`, `/blog/kategori/{kategori}`, `/blog?q=arama` | Blog |
| `/sss`, `/iletisim`, `/kvkk` | SSS, iletişim formu, KVKK metni |
| `/sitemap.xml`, `/robots.txt` | Google için otomatik site haritası |
| `/login` → `/admin` | Yönetim paneli |

## Yönetim Paneli Bölümleri

- **Anasayfa Giriş (Hero):** Anasayfanın en üstündeki başlık, açıklama ve butonlar.
- **Hakkımda:** Hakkımda blokları (1. blok = "Kimdir?" ana metni, diğerleri "Değerlerim" kartları), Kariyer Yolculuğu, Çalışma Sürecim.
- **Projeler:** Yaptığınız işler (kapak + 2 galeri görseli, "öne çıkan" seçeneği).
- **Hizmetler:** Uzmanlık alanları, etiketler, detay sayfası içeriği.
- **Çalıştığım Markalar:** Kayan logo şeridi (logo yoksa isim yazı olarak görünür).
- **Referans Yorumları:** Boş bırakıldı — sadece gerçek, izinli yorumlar ekleyin. Hiç yorum yoksa bölüm gizlenir.
- **Blog** ve **Sık Sorulan Sorular** (kategorileriyle).
- **Gelen Mesajlar:** İletişim formundan gelenler.
- **Site Ayarları:** Logo, favicon, profil fotoğrafı, paylaşım görseli, marka rengi, iletişim, sosyal medya, istatistikler, alıntı, Google doğrulama/Analytics, KVKK metni.
- **Sayfa Sonu Bağlantıları** ve **Kullanıcılar** (Yönetici / Editör rolleri).

## "Yunuscan ZEYBEK kimdir?" aramaları için yapılanlar (SEO)

- Kalıcı adres: `/yunuscan-zeybek-kimdir`, sayfa başlığı "Yunuscan ZEYBEK Kimdir?".
- Her sayfada Google'ın kişiyi tanıması için **schema.org Person** verisi
  (ad, unvan, profil fotoğrafı, konum, e-posta, uzmanlık alanları ve
  `sameAs` ile Instagram/Facebook ve diğer profilleriniz). Hakkımda
  sayfasında ayrıca `ProfilePage`, blogda `BlogPosting`, SSS'de `FAQPage`.
- Open Graph / X paylaşım etiketleri, kanonik adresler, otomatik `sitemap.xml`.
- "Yunuscan ZEYBEK Kimdir?" başlıklı ilk blog yazısı ve SSS sorusu.

**Yayına aldıktan sonra yapmanız gerekenler:**
1. [Google Search Console](https://search.google.com/search-console)'a sitenizi ekleyin; doğrulama kodunu **Site Ayarları > Google Search Console Doğrulama Kodu** alanına yapıştırın; ardından `https://alanadiniz/sitemap.xml` adresini gönderin.
2. Instagram ve Facebook profil biyografinize sitenizin adresini ekleyin (Google'ın profilleri siteyle eşleştirmesi için önemli).
3. **Site Ayarları**'ndan profil fotoğrafınızı yükleyin, **Diğer Profil Bağlantıları** alanına sizi anlatan diğer sayfaları (LinkedIn, yazar sayfaları, haberler) ekleyin.

## İçerik hakkında önemli not

Başlangıç metinleri; Google aramaları, Facebook/Instagram profil özetleri
ve bilinen projelerden (Cangas / CAF Grup kurumsal içerikleri, Manşet 45,
360° Medya Planlama ve Satın Alma Ajansı, Psikolog Merve Kalaycı web
sitesi) derlenerek hazırlanmış **taslaklardır**. Instagram ve Facebook
sayfalarına doğrudan erişilemediği için bazı bilgiler (tarihler, unvan,
görevler) tahmine dayanıyor — yayından önce panelden kontrol edip kendi
ifadelerinizle güncelleyin.

Şablonla gelen fotoğraflar gerçek görsel değil, düz renkli yer
tutuculardı; bu yüzden siz görsel yükleyene kadar markaya uygun soyut
kapak görselleri (`public/site/images/yz/`) gösterilir. Panelden görsel
yükledikçe otomatik olarak onlar kullanılır.

---

## Kurulum (paylaşımlı hosting / cPanel)

Gereksinimler: PHP 8.1+ (pdo_mysql, mbstring, gd), MySQL 5.7+ / MariaDB 10.3+.

1. **Veritabanı:** cPanel'de boş bir veritabanı + kullanıcı oluşturun.
   phpMyAdmin'den `database/yunuscanzeybek_kurulum.sql` dosyasını içe
   aktarın (tablolar + başlangıç içeriği + yönetici hesabı).
   > Bu dosya **sadece ilk kurulum** içindir. Site yayına girdikten sonra
   > tekrar çalıştırmayın; tüm içeriğinizin üzerine yazar.
2. **Dosyalar:** Projeyi sunucuya yükleyin. Alan adının kök dizini
   `public/` klasörünü göstermeli (cPanel > Alan Adları > Belge Kökü).
   Gösteremiyorsanız proje kökündeki `.htaccess` istekleri `public/`
   klasörüne yönlendirir.
3. **Bağımlılıklar:** Sunucuda SSH varsa `composer install --no-dev --optimize-autoloader`.
   Yoksa bilgisayarınızda bu komutu çalıştırıp oluşan `vendor/` klasörünü de yükleyin.
4. **Ayar dosyası:** `.env.example` dosyasını `.env` adıyla kopyalayın;
   `APP_URL`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` alanlarını
   doldurun. `APP_KEY` için `php artisan key:generate` çalıştırın (SSH
   yoksa: bilgisayarınızda üretip `.env`'e yapıştırın).
5. **İzinler:** `storage/`, `bootstrap/cache/` ve `public/images/` yazılabilir olmalı (755/775).

SSH erişiminiz varsa SQL dosyası yerine şu da kullanılabilir:

```bash
cp .env.example .env && php artisan key:generate
php artisan migrate --seed   # ADMIN_EMAIL / ADMIN_PASSWORD .env'den okunur
```

### Yönetim paneline ilk giriş

- Adres: `https://alanadiniz/login`
- E-posta: `co@canzeybek.com.tr`
- Geçici şifre: `YZ-Panel-2026!`

**İlk girişten hemen sonra** Kullanıcılar > Düzenle'den şifrenizi değiştirin.

### Görseller hakkında

Panelden yüklenen tüm görseller `public/images/` klasörüne kaydedilir.
Güncelleme yüklerken bu klasörün üzerine yazmayın (yüklediğiniz
görseller silinir).

---

## Geliştirici notları

- Laravel 10, PHP 8.1+. Ön yüz: `resources/views/site/`, panel: `resources/views/dashboard/`.
- Şablon dosyaları: `public/site/` (orijinal `styles.css` değiştirilmedi; tüm özelleştirmeler `public/site/css/custom.css`).
- Marka rengi panelden `--brand` CSS değişkeniyle yönetilir.
- Basit liste/form bölümleri (Projeler, Markalar, Yorumlar, Kariyer, Hakkımda Blokları, Süreç) tek bir tanım dosyasından üretilir: `app/Support/AdminModules.php`. Yeni alan eklemek için migration'a kolonu, bu dosyaya alan satırını ekleyin.
- Veritabanı şeması: `database/migrations/2026_09_24_000000_create_site_tables.php`, başlangıç içeriği: `database/seeders/DatabaseSeeder.php`.
- Kurulum SQL'ini yeniden üretmek için: temiz bir veritabanında `php artisan migrate:fresh --seed`, ardından `mysqldump --skip-comments veritabani > database/yunuscanzeybek_kurulum.sql`.
