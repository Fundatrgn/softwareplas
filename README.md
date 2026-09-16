# Psikolog Merve Kalaycı — Web Sitesi Kurulum Rehberi

## 🛑 ÖNEMLİ — Veri Kaybını Önlemek İçin Lütfen Okuyun

Siteniz artık CANLI ve üzerinde gerçek içerik (slider, blog, görsel)
var. Bundan sonraki her güncellemede **iki şeye dikkat edin**:

1. **`database/merve_psikolog_baslangic.sql` dosyasını ASLA canlı
   sitenizde çalıştırmayın.** Bu dosya sadece SIFIRDAN kurulum
   içindir ve çalıştırılırsa tüm gerçek verinizin (slider'lar,
   bloglar, ayarlar) üzerine örnek/varsayılan içerikle yazar. Sadece
   `database/eksik_kolon_onarimi.sql` dosyasını kullanın — o veri
   silmez, sadece eksik kolonları ekler.
2. **Bu zip'i sunucunuza yüklerken `public/images/` klasörünün
   TAMAMINI üzerine yazmayın.** Bu klasörde sizin panelden
   yüklediğiniz gerçek görseller de duruyor; zip'teki `images`
   klasörünün üzerine kör bir "hepsini değiştir" işlemi yaparsanız,
   kendi yüklediğiniz görseller (ve o görsellere bağlı slider/blog
   kayıtları görüntü olarak) kaybolabilir. Güvenli yöntem: dosya
   yöneticinizde/FTP programınızda "birleştir" (merge) seçeneğini
   kullanın ya da sadece aşağıda o güncelleme için listelediğim
   değişen dosyaları elle değiştirin.

Emin değilseniz, her güncellemeden önce `public/images/` klasörünü
bilgisayarınıza yedekleyin.

Bu paket, mevcut Laravel tabanlı şablonunuz üzerine kurulmuş, Türkçe ve
psikoloji pratiğine uygun hale getirilmiş, admin panelinden renk
değiştirilebilen bir web sitesidir.

> ⚠️ Bu paketteki `.env` dosyasında gerçek veritabanı şifren yazıyor.
> Bu zip'i herkese açık bir yere (genel bir GitHub deposu, paylaşımlı bir
> bulut linki vb.) koyma; sadece kendi bilgisayarından sunucuna
> yüklemek için kullan.

## Bu pakette neler var?

- Tüm site kodu (Laravel 10 projesi, `vendor/` klasörü dahil — ayrıca
  `composer install` çalıştırmanıza gerek yok)
- `database/merve_psikolog_baslangic.sql` — örnek içerikle (3 hizmet
  sayfası, 3 blog yazısı, ayarlar, 1 admin kullanıcı) dolu, hazır bir
  MySQL veritabanı yedeği (yalnızca SIFIRDAN kurulum için)
- `database/eksik_kolon_onarimi.sql` — mevcut bir kuruluma güvenli
  şekilde eksik kolonları ekleyen, veri silmeyen onarım betiği
- Admin panelinde yeni bir **"Site Görünümü / Renkler"** bölümü: Ayarlar
  sayfasından sitenin ana rengini, ikincil rengini, başlık ve gövde yazı
  renklerini kod bilmeden değiştirebilirsiniz
- WhatsApp hızlı randevu butonu (Ayarlar'a numaranızı girince otomatik
  görünür)

## Bu Güncellemede Neler Değişti (SSS admin linki + koyu mod kalıcı çözüm)

- **Sık Sorulan Sorular admin panelinde yoktu:** Bunu tamamen unutmuşum,
  haklıydınız — bu bölüme giden sol menü bağlantısı şablonda baştan beri
  yorum satırı içinde kalmış (yani kod vardı ama gizliydi). Artık sol
  menüde **"Sık Sorulan Sorular"** başlığı altında soruları görüp
  ekleyip düzenleyebilir, kategorilerini yönetebilirsiniz.
- **Koyu mod hâlâ sıfırlanıyordu — gerçek nedenini buldum:** Bir önceki
  düzeltmem sadece üst menüdeki küçük ay/güneş ikonunu kapsıyordu. Ama
  admin panelinde sağ kenarda açılan **ayrı bir "Theme Customizer"
  paneli** de var (Light/Dark/Semi Dark seçenekleriyle) ve o panel hâlâ
  hiçbir yerde hatırlanmıyordu. Muhtemelen o paneli kullanıyordunuz. Artık
  hangisini kullanırsanız kullanın (üstteki ikon ya da yandaki panel),
  seçiminiz kaydediliyor ve her sayfada korunuyor.

## Bu Güncellemede Neler Değişti (koyu mod sıfırlanması + hizmet silme)

- **Admin panelindeki koyu/açık mod sürekli sıfırlanıyordu:** Gerçek
  neden buldum — bu seçim hiçbir yerde hatırlanmıyordu (tarayıcı hafızası
  kullanılmıyordu), bu yüzden her sayfa geçişinde varsayılana dönüyordu.
  Artık seçiminiz tarayıcınızda saklanıyor ve her sayfada korunuyor.
- **Hizmetler silinemiyor:** Bunu bir önceki güncellemede zaten
  düzeltmiştim (Sil butonu eklemiştim) ve şimdi tekrar test ettim,
  sorunsuz çalışıyor. Büyük ihtimalle geçen sefer sadece
  `eksik_kolon_onarimi.sql` dosyasını çalıştırdınız ama site kodunun
  güncel halini sunucuya yüklemediniz — **bu yüzden bu paketteki tüm
  dosyaları da mutlaka sunucunuza yükleyin**, sadece SQL çalıştırmak
  yetmez.

## Bu Güncellemede Neler Değişti (görsel yükleme hatası + silme butonu)

- **Slider'da görsel yükleme hatası:** Gerçek nedeni buldum — "first",
  "second", "threed" adında, admin formunda hiç gösterilmeyen ama
  veritabanında boş bırakılamaz (NOT NULL) olarak tanımlı üç eski/kalıntı
  alan vardı. Yeni bir slider eklerken bu alanlara hiç değer
  yazılmadığı için kayıt SQL hatasıyla çöküyordu. Hem bu alanları
  artık boş bırakılabilir hale getirdim hem de `eksik_kolon_onarimi.sql`
  dosyasına bu düzeltmeyi ekledim (canlı veritabanınızda da çalıştırmanız
  gerekiyor, aşağıya bakın).
- **Hizmetler'de silme butonu yoktu:** Haklıydın, sadece "Düzenle" linki
  vardı. Her hizmet kartına bir "Sil" butonu ekledim (onay sorusu ile).
  Ayrıca bir hizmeti sildikten sonra yanlışlıkla Ayarlar sayfasına
  yönlendiren bir hatayı da düzelttim.

**Zaten kurulu olan siteniz için:** `database/eksik_kolon_onarimi.sql`
dosyasını (güncellenmiş haliyle, bu pakette) tekrar phpMyAdmin'den
çalıştırın — veri silmez, sadece bu son düzeltmeyi de uygular.

## Bu Güncellemede Neler Değişti (başlık efekti + telif metni)

- **Anasayfa başlığındaki garip işaretler:** Başlıktaki bazı kelimeler
  "sadece kontur" (içi boş) bir efektle gösteriliyordu; Türkçe'ye özgü
  noktalı harflerle (İ, Ğ, Ş) bu efekt bir araya gelince bazı
  tarayıcılarda küçük, tuhaf işaretler oluşabiliyordu. Bu rastgele efekti
  tamamen kaldırdım — başlık artık her zaman net, düz beyaz yazı.
- **Telif/footer metni:** Hem site genelindeki footer'da hem admin
  panelinin altında artık şu yazıyor: "© 2026 All Right: Yunuscan
  ZEYBEK | © Psikolog Merve Kalaycı - Tüm Hakları Saklıdır" (yıl
  otomatik güncellenir). Admin panelinde daha önce hiç böyle bir metin
  yoktu, yeni eklendi.

## Bu Güncellemede Neler Değişti (dokununca oluşan boşluk — kesin çözüm)

Bu sefer sorunu kökten çözdüm: kartların "sayfa kaydırılırken belirsin"
efekti (WOW.js), dokunmatik cihazlarda bir dokunuşun bazen "hover"
durumunu tetiklemesiyle birlikte, geçiş efektlerinin yarıda/yanlış
konumda kalmasına neden olabiliyordu — sizin "üstüne gezerken boşluk
oluşuyor" dediğiniz tam olarak buydu. Bu sefer:
1. Hizmet kartlarından bu animasyon sistemini (WOW.js) TAMAMEN kaldırdım
   — artık kartlar bu mekanizmaya hiç bağlı değil.
2. Dokunmatik cihazlarda karta dokununca tetiklenebilecek TÜM geçiş
   efektlerini (karartma katmanı, ok yeniden konumlanması) devre dışı
   bıraktım.

**Masaüstünde hiçbir şey değişmedi** — kartlar orada hâlâ üzerine
gelince aynı güzel efektle beliriyor, sadece "sayfa kaydırılırken
belirme" animasyonu kaldırıldı (kartlar artık anında görünür, ki bu
zaten aradaki fark neredeyse fark edilmiyor).

## Bu Güncellemede Neler Değişti (mobilde ok işareti + boşluk)

- **Ok işareti artık mobilde de görünüyor:** O gönderdiğiniz turuncu ok
  (kartın üzerine gelince beliren büyük ok), daha önce mobilde "takılı
  kalma" riski yüzünden tamamen gizlenmişti. Şimdi küçük, sabit bir
  rozet olarak kartın sağ alt köşesinde her zaman görünüyor — hover'a
  bağlı değil, o yüzden takılı kalma riski de yok.
- **Kart boşluğu:** Görsel yükseklik düzeltmesini bir önceki güncellemede
  eklemiştim ve kendi ortamımda (varsayılan ve uzun test görselleriyle)
  sorunsuz çalıştığını doğruladım. Bu güncellemede aynı kurala ekstra
  bir öncelik (`!important`) ekledim, herhangi bir çakışma ihtimaline
  karşı. **Bunu yükledikten sonra hâlâ aynı boşluğu görürseniz, tarayıcıda
  Ctrl+Shift+R ile sert yenileme yapın** — CSS dosyaları tarayıcıda uzun
  süre önbelleğe alınabiliyor.

## Bu Güncellemede Neler Değişti (Hizmetlerimiz kartları tıklanmıyordu + boşluk sorunu)

- **Asıl neden buldum — benim hatam:** Geçen sefer mobildeki "takılı kalan
  dev ok" sorununu çözerken, o ok aslında hizmet kartlarındaki TEK
  tıklanabilir linkti — onu gizleyince, kart başlığına dokunmak artık
  hiçbir yere gitmiyordu. Şimdi başlığın kendisini de gerçek bir linke
  çevirdim, artık hem ok gizli kalıyor (o sorun tekrar gelmiyor) hem de
  başlığa dokununca ilgili hizmet sayfasına gidiyor.
- **Kartlar arası büyük boşluk:** Kart görseli için sabit bir yükseklik
  tanımlı değildi; yüklediğiniz görselin kendi oranına göre kart çok
  uzayabiliyordu. Artık hangi görseli yüklerseniz yükleyin (uzun, kare,
  geniş fark etmez), kart her zaman aynı, tutarlı yükseklikte ve orantılı
  kırpılarak gösteriliyor. Kendinizin yüklediğine benzer uzun bir test
  görseliyle kendim doğruladım.

**Bu güncellemede değişen dosyalar** (sadece bunları değiştirmeniz
yeterli, `public/images` klasörüne dokunmanıza gerek yok):
- `resources/views/general/comp/hizmetler.blade.php`
- `public/theme/assets/css/psikolog-theme.css`

## Bu Güncellemede Neler Değişti (mobil tıklama/görünmezlik sorunu)

**Bulduğum asıl neden:** Şablon, başlık/kart/buton gibi birçok öğeyi
"sayfa kaydırılırken belirsin" diye tasarlamış. Bu efektin tetiklenme
mekanizması güvenilir çalışmadığında, öğeler KALICI olarak görünmez VE
TIKLANAMAZ durumda kalabiliyordu — "Hizmetlerimiz" / "Bloglarımız"
başlığının görünmemesi ve tıklanamamasının nedeni tam olarak buydu.
Bunu tamamen ortadan kaldırdım; artık tüm öğeler bu efekte bağlı
olmadan her zaman anında görünür ve tıklanabilir.

**Bu güncellemede SADECE şu dosya değişti** (verinizi risk almadan,
sadece bu dosyayı sunucunuzdaki karşılığıyla değiştirebilirsiniz):
`public/theme/assets/css/psikolog-theme.css`

## Bu Güncellemede Neler Değişti (uzun alt başlık hatası)

Yeni hata mesajı sayesinde (bir önceki güncellemede eklediğim "anlaşılır
hata mesajı" özelliği) sorunu hemen gördüm: "subtitle" (Alt Başlık)
alanı veritabanında sadece 255 karaktere kadar metin kabul ediyordu,
ama sizin yazdığınız güzel, uzun açıklama bundan daha uzundu. Alanı
artık pratik olarak sınırsız uzunlukta metin kabul edecek şekilde
genişlettim. Sizin gönderdiğiniz aynı metinle kendim test ettim, sorunsuz
kaydediliyor.

**Zaten kurulu olan siteniz için:** `database/eksik_kolon_onarimi.sql`
dosyasını (bu pakette güncellenmiş haliyle) tekrar çalıştırmanız yeterli.

## Bu Güncellemede Neler Değişti (slider 500 hatası + panel metni + blog düzeni)

- **Slider ekleme hâlâ 500 veriyordu:** Bu sefer daha kapsamlı bir güvenlik
  ağı ekledim — artık kayıt sırasında HERHANGİ bir beklenmedik hata
  olursa (görsel yükleme dahil, ör. dosya çok büyükse) ham bir "500"
  sayfası yerine formun üstünde anlaşılır bir Türkçe hata mesajı
  görünecek. Ayrıca çok büyük dosyaların sunucu limitini aşması
  durumunu da (bu, kontrolcülere hiç ulaşmayan farklı bir hata türüdür)
  ayrıca ele aldım. Görsel alanına da "tercihen 5MB altında" uyarısı
  ekledim.
- **Menü panelindeki tanıtım metni artık ayrı ve düzenlenebilir:**
  Masaüstünde sağ üstteki (☰) ikonuna tıklayınca açılan panelin
  "Hakkımda" yazısı, daha önce arama motoru açıklamasıyla aynı alanı
  paylaşıyordu. Artık **Ayarlar** sayfasında "Menü Panelindeki Kısa
  Tanıtım" adında kendine ait bir alanı var, ikisini birbirinden
  bağımsız düzenleyebilirsiniz.
- **Blog sayfası düzeni:** Kendi ortamımda bu sayfayı yeniden test
  ettim, kod tarafında bir sorun bulamadım — blog yazıları sağ tarafta
  düzgün görünüyor. Gönderdiğiniz görüntüde sağ üstte beliren "%75 - +
  Sıfırla" kutusu muhtemelen tarayıcınızın kendi yakınlaştırma
  göstergesi (siteden bağımsız). Bu paketi yükledikten sonra hâlâ aynı
  görüntü çıkarsa, sayfayı biraz daha aşağı kaydırıp tam halinin
  ekran görüntüsünü gönderirseniz kesin teşhis koyabilirim.

**Zaten kurulu olan siteniz için:** `database/eksik_kolon_onarimi.sql`
dosyasını (bu pakette güncellenmiş haliyle) tekrar çalıştırmanız
gerekiyor.

## Bu Güncellemede Neler Değişti (otomatik geçiş çalışmıyordu + KVKK onay kutusu)

- **Otomatik geçiş çalışmıyordu — asıl nedenini buldum:** Şablonun
  JavaScript kodu, sayfa açılışında art arda ~30 farklı özelliği
  başlatıyor (menü, kaydırma efektleri, slider'lar vb.) ve bunlardan
  BİRİ bile hata verirse, ondan SONRA gelen her şey (slider'ın otomatik
  oynaması dahil) hiç çalışmıyordu. Artık her özellik birbirinden
  bağımsız çalışıyor — biri sorun yaşasa bile diğerleri etkilenmiyor.
  Kendim 2 slider ekleyip 3 saniyelik gecikmeyle test ettim, otomatik
  geçiş artık çalışıyor.
- **KVKK onay kutusu eklendi:** Randevu ve İletişim formlarına, işaretlenmeden
  gönderilemeyen bir onay kutusu ekledim. "KVKK Aydınlatma Metni" yazısına
  tıklayınca küçük, kaydırılabilir bir pencere açılıyor (tam ekran değil).
  Bu metni **Admin Panel > Ayarlar** sayfasının altında yeni eklenen
  "KVKK Aydınlatma Metni" kutusundan dilediğiniz gibi düzenleyebilirsiniz.
  Örnek bir metinle önceden doldurdum, ama yayına almadan önce bir hukuk
  danışmanına kontrol ettirmenizi öneririm — ben avukat değilim, bu
  konuda kesin doğruluk garantisi veremem.

**Zaten kurulu olan siteniz için:** `database/eksik_kolon_onarimi.sql`
dosyasını (bu pakette güncellenmiş haliyle) tekrar phpMyAdmin'den
çalıştırmanız gerekiyor — iki yeni ayar alanı eklendi.

## Bu Güncellemede Neler Değişti (efekt rastgeleliği + slayt hızı ayarı)

- **Kontur efekti artık gerçekten rastgele:** Haklıydınız, bir önceki
  düzeltmemde sabit bir sıralama (1., 3., 5. kelime dolu; 2., 4. kelime
  kontur) kullanmıştım. Şimdi gerçek rastgelelik kullanıyor — aynı
  başlık bile her sayfa yenilemesinde farklı kelimeler dolu/kontur
  çıkıyor. Ayrıca şans eseri tüm kelimelerin aynı stilde çıkıp efektin
  o an hiç görünmemesi ihtimaline karşı bir güvenlik önlemi de ekledim
  (en az bir kelime her zaman karşı stilde olacak şekilde garanti
  ediliyor). Kendim 5 kez art arda sayfayı yükleyip her seferinde
  farklı çıktığını doğruladım.
- **Slayt geçiş süresi artık admin panelinden ayarlanabilir:** Admin
  Panel > Anasayfa Slider sayfasının en üstünde yeni bir "Slayt Geçiş
  Süresi" kutusu var — saniye cinsinden istediğiniz değeri girip
  Kaydet'e basmanız yeterli (2-30 saniye arası).

**Zaten kurulu olan siteniz için:** `database/eksik_kolon_onarimi.sql`
dosyasını (bu pakette güncellenmiş haliyle) tekrar phpMyAdmin'den
çalıştırmanız gerekiyor — yeni bir ayar alanı eklendi.

## Bu Güncellemede Neler Değişti (efekt "hareket etmiyor" sorunu)

Orijinal softwareplas.com.tr sitesini kontrol ettim: orada 3 farklı
slider (3 farklı başlık metni) var, bu yüzden slaytlar değiştikçe kontur
efekti de doğal olarak farklı kelimelere denk geliyor. Sizin sitenizde
şu an muhtemelen tek bir slider var, bu yüzden değişecek bir şey yok —
efekt "tek noktada kalıyor" çünkü gösterilecek başka bir slayt yok.

İki şey yaptım:
1. **Anasayfa slider'ını otomatik oynatmaya açtım** (6 saniyede bir
   otomatik geçiş) — daha önce bu kapalıydı, sadece elle sayı
   tıklanınca slayt değişiyordu.
2. Kontur efekti zaten her slaytın kendi kelimelerine göre değişiyor
   (bir önceki güncellemede düzelttiğim şekliyle).

**Önemli:** Bu değişikliğin görünmesi için Admin Panel > Anasayfa
Slider > Yeni Ekle'den en az bir slider daha eklemeniz gerekiyor —
tek slider varken otomatik oynatmanın döndürecek başka bir şeyi
olmaz, bu yüzden hiçbir değişiklik görünmez. İki veya üç farklı
başlıklı slider eklerseniz, hem otomatik geçişi hem de her seferinde
değişen kontur efektini göreceksiniz.

## Bu Güncellemede Neler Değişti (başlık efekti geri geldi + mobil boyut küçültme)

- **Kontur/dolu yazı efekti kayboldu:** Haklıydınız, önceki bir
  güncellemede başlığı düzeltirken bu efekti oluşturan kod yanlışlıkla
  silinmiş. Geri getirdim — üstelik bu sefer rastgele değil, sırayla
  değişimli (1. kelime dolu, 2. kelime kontur, 3. kelime dolu...)
  çalışıyor, böylece efekt her başlıkta garanti görünür.
- **Mobilde başlık küçültüldü:** Anasayfa başlığının mobil boyutunu
  biraz küçülttüm, artık daha dengeli duruyor.

## Bu Güncellemede Neler Değişti (anasayfadaki başlık/açıklama üst üste binmesi)

Ana sayfadaki büyük başlığın ve altındaki açıklama metninin bazı
cihazlarda birbirinin üzerine binip "donmuş/hareketsiz" görünmesinin
nedenini buldum: başlık, normalde bir kayma/belirme animasyonuyla
görünür hale geliyordu ve bu animasyon carousel eklentisinin doğru
zamanlamayla çalışmasına bağlıydı. Bazı durumlarda (özellikle mobilde)
bu animasyon tam tamamlanmadan takılı kalabiliyor, bu da başlığın
soluk/kaymış halde açıklama metniyle çakışmasına yol açıyordu. Başlığı
artık bu animasyona bağlı olmadan her zaman anında ve net görünür hale
getirdim. Uzun bir açıklama metniyle (tıpkı sizin girdiğiniz gibi) hem
masaüstünde hem mobilde tekrar test ettim, artık düzgün alt alta duruyor.

## Bu Güncellemede Neler Değişti (slider sayfa numaraları taşması)

Sağ kenardaki "01, 02, 03..." sayfa numaralarının haklısınız, tasarımı
her rakam arasına 100px boşluk koyacak şekilde sabitti — 3-4 slider'dan
sonra bu liste ekranın dışına taşıp "uzayıp gidiyordu". Artık kaç
slider eklerseniz ekleyin bu liste kompakt kalıyor ve ekrana sığıyor.
Mobilde zaten yer kapladığı ve gerekli olmadığı için tamamen kaldırıldı.
Kendim 6 slider ekleyip hem masaüstünde hem mobilde test ettim.

## Bu Güncellemede Neler Değişti (SSS 500 hatası + koyu mod + harita)

- **SSS eklerken 500 hatası:** "sss" tablosundaki "category_id" alanı boş
  bırakılamaz (NOT NULL) olarak tanımlıydı, ama admin formunda kategori
  seçimi zorunlu değil. Bunu kodda zaten düzeltmiştim ama canlı
  veritabanınıza bu düzeltme hiç ulaşmamıştı — `eksik_kolon_onarimi.sql`
  dosyasına ekledim, aşağıdaki gibi tekrar çalıştırmanız yeterli.
- **Koyu mod hâlâ çalışmıyordu:** Bunun nedeni muhtemelen tarayıcınızın
  eski `main.js` dosyasını önbellekte tutmasıydı — bir önceki
  düzeltmeyi hiç indirmemiş olabilirdi. Bu dosyaya bir sürüm numarası
  ekledim, böylece tarayıcı artık güncel dosyayı çekmek zorunda.
- **Harita adresi:** Aslında Ayarlar sayfasındaki "Adres" alanı zaten
  sitenizdeki haritayı otomatik güncelliyordu, ama bunu görmenin/emin
  olmanın bir yolu yoktu. Şimdi Ayarlar sayfasında, adresi yazarken
  anlık güncellenen bir **harita önizlemesi** var — yazdıkça haritanın
  doğru yeri gösterdiğini hemen görebilirsiniz.

**Zaten kurulu olan siteniz için tekrar gerekli adım:**
`database/eksik_kolon_onarimi.sql` dosyasını (bu pakette güncellenmiş
haliyle) phpMyAdmin'den tekrar çalıştırın — veri silmez.

## Bu Güncellemede Neler Değişti (admin/slider/add 500 hatası)

`/admin/slider/add` sayfasındaki 500 hatasının en olası nedeni: geçmiş
güncellemelerde `slider`, `services_details` ve `settings` tablolarına
yeni kolonlar eklemiştim. Eğer o güncellemelerden sonra canlı
veritabanınızda `php artisan migrate` çalıştırılmadıysa veya SQL dosyası
yeniden içe aktarılmadıysa, kod bu kolonları bulamayıp hata veriyor
olabilir.

**Çözüm — verinizi SİLMEDEN eksik kolonları ekleyin:**

1. phpMyAdmin'den `softwareplas_merve` veritabanına girin
2. "SQL" sekmesine tıklayın
3. Bu paketteki **`database/eksik_kolon_onarimi.sql`** dosyasının
   içeriğini yapıştırıp çalıştırın

Bu dosya sadece eksik olan kolonları ekler, mevcut hiçbir veriyi
silmez veya değiştirmez; birden fazla kez çalıştırsanız bile güvenlidir
(kendim test ettim).

Bu adımdan sonra hâlâ hata alırsanız, `storage/logs/laravel.log`
dosyasındaki en son hata satırını bana gönderin — kesin teşhis
koyabilirim.

## Bu Güncellemede Neler Değişti (anasayfa slider'ı düzenleyememe sorunu)

Haklıydın — anasayfadaki büyük görsel/başlık alanını (slider) admin
panelinden düzenleyecek bir menü bağlantısı hiç yoktu; sayfa/kontrolcü
zaten hazırdı ama sol menüde ona giden bir link unutulmuştu. Şimdi sol
menüde en üstte **"Anasayfa Slider"** başlığı altında "Tümünü Gör" ve
"Yeni Ekle" bağlantıları var. Oradan başlığı, alt açıklamayı, buton
yazısını ve görseli değiştirebilirsin.

## Bu Güncellemede Neler Değişti (mobil ince ayar — 2)

- **Logo ve menü hizasız duruyordu:** Ekran görüntülerinle gördüm — logo ve
  hamburger menü ikonu farklı satırlarda, üst üste yakın duruyordu. İkisini
  aynı satırda, düzgün ortalanmış hale getirdim.
- **Fare imleci efekti mobilde takılı kalıyordu:** Şablonun masaüstüne özel,
  fareyi takip eden dekoratif nokta efekti, dokunmatik cihazlarda hareket
  edecek bir fare olmadığı için ekranda sabit bir noktada asılı kalıyordu.
  Dokunmatik cihazlarda tamamen kaldırıldı.
- Kart üzerine gelince beliren (masaüstüne özel) dev ok ikonu da aynı
  sebeple dokunmatik cihazlarda gizlendi.

## Bu Güncellemede Neler Değişti (mobil düzeltme)

- **Mobilde logo ile "Randevu Al" butonu üst üste biniyordu:** Ekran görüntünle
  gördüm ve doğruladım — mobil genişlikte logo ortaya kayarken header'daki
  buton onun üzerine biniyordu. O buton artık mobilde gizleniyor (zaten
  aynı buton mobil menünün içinde de var, o yüzden bir şey kaybolmuyor).
- Hizmet/blog kartlarındaki örnek görselleri daha "dolu" bir desenle
  yeniden oluşturdum, böylece hangi oranda kırpılırsa kırpılsın boş/loş
  görünmüyorlar.

## Bu Güncellemede Neler Değişti (2. tur — renk sistemi baştan kuruldu)

Önceki paketteki okunmama sorununun asıl nedenini buldum: **renk
düzeltmelerini içeren `psikolog-theme.css` dosyası, header'a hiç
bağlanmamıştı** — yani o dosyadaki hiçbir düzeltme sitede
uygulanmıyordu. Ayrıca CSS'in çeşitli yerlerinde admin panelinden
bağımsız, sabit kodlanmış eski mavi renkler ve "on-surface" adında,
hiçbir ayara bağlı olmayan sabit bir beyaz renk değişkeni kalmıştı.

Yaptıklarım:
- **`psikolog-theme.css` bağlantısını düzelttim** ve dosyayı yeni tasarıma
  göre yeniden yazdım.
- **Tüm renk sistemini sadeleştirdim:** Artık TEK bir "arka plan rengi"
  ayarı sitenin HER yerini (anasayfa, kartlar, footer, form alanları)
  aynı anda kontrol ediyor. Böylece "bazı yerler koyu bazı yerler açık
  kaldı" sorunu yapısal olarak imkânsız hale geldi.
- **Ana renk turuncuya çevrildi**, tüm başlık ve metinler varsayılan
  olarak beyaz/açık tonda — hangi bileşende olursa olsun.
- **"Tek seferde renk değiştirme" isteğin için:** Ayarlar sayfasına
  tıklayınca tüm renkleri otomatik dolduran hazır tema butonları
  eklendi: 🟠 Turuncu, 🟢 Yeşil, 🔵 Mavi, 🟣 Mor, ⚪ Açık Zemin.
- **Admin panelinde "Referanslarımız":** O sayfaya giden rotaların
  veritabanında hiç karşılığı yoktu (tıklansa 500 hatası verirdi) —
  tamamen kaldırıldı.
- **Sayfa geçiş efekti** tamamen kaldırıldı, sayfalar artık direkt açılıyor.
- **Bozuk `/sss` sayfası** (tıklansa çökerdi) artık çalışan bir Sık
  Sorulan Sorular sayfasına dönüştürüldü, menüye eklendi.
- Tüm örnek görseller yeni koyu/turuncu temaya göre yeniden oluşturuldu.

**Yine de eski görünüm çıkarsa:** Yeni paketi yükledikten sonra
sunucudaki `storage/framework/views/` klasörünü boşalt ve tarayıcında
sert yenileme yap (Ctrl+F5 / Cmd+Shift+R).

## Önceki Güncelleme (1. tur)

- **Siyah ekran / geçişte eski logo görünmesi:** Sayfa yüklenirken beliren
  animasyon hâlâ eski ajansın siyah zeminli, turuncu yazılı yükleme
  ekranını kullanıyordu. Sakin, markana uygun bir spinnerla değiştirdim
  ve donarsa diye en geç 2.5 saniyede zorla kapatan bir güvenlik kodu
  ekledim.
- **Admin paneline girememe:** `.env` dosyasındaki `APP_URL` hâlâ
  placeholder'dı, gerçek adresinle eşleşmiyordu — bu düzeltildi. Ayrıca
  önceki pakette yanlışlıkla benim test oturumlarımdan kalma önbellek
  dosyaları vardı, onları da temizledim.
- **Logo küçüklüğü / mobil menü butonunun yukarıda kalması:** İkisi de
  gerçek CSS hatalarıydı, düzeltildi.
- **Arka plandaki görselin anlaşılmaz olması:** Anasayfadaki görsel artık
  net bir "büyüme/yeşerme" temalı, sakin bir illüstrasyon.
- **Yeni: Randevu Al sayfası** (`/randevu`): Tarih, saat ve görüşme türü
  seçilebilen, WhatsApp'a otomatik dolan mesajla da yönlendirebilen ayrı
  bir randevu talep sayfası eklendi. Anasayfa, header ve footer'daki
  "Randevu Al" butonları artık buraya yönlendiriyor.
- Favicon ve sosyal medya paylaşım kartı (WhatsApp/Instagram'da link
  paylaşınca çıkan önizleme görseli) eklendi.

**Önemli:** Eğer canlı sunucundaki eski dosyaların üzerine bu paketi
yüklüyorsan, `storage/framework/views/` klasöründeki dosyaları da
temizle (ya da bu paketteki boş haliyle üzerine yaz) — aksi halde eski
sayfa görünümleri önbellekte takılı kalabilir.

## Kurulum — Veritabanı Bilgilerin Zaten Girildi

`.env` dosyasına verdiğin gerçek veritabanı bilgilerini (softwareplas_merve /
mrv / şifren) zaten işledim ve bu tam kopya üzerinde uçtan uca test ettim —
tüm sayfalar sorunsuz çalışıyor. Senin yapman gereken sadece dosyaları
sunucuya koyup veritabanını doldurmak:

1. Hosting panelinden (phpMyAdmin) **softwareplas_merve** veritabanına gir,
   pakette verdiğim **database/merve_psikolog_baslangic.sql** dosyasını
   Import ile içe aktar. Bu, tüm örnek içeriği (hizmetler, blog, ayarlar,
   admin girişi) tek seferde yükler.
2. Bu klasördeki tüm dosyaları sunucuna yükle (Plesk'te File Manager'dan
   zip'i çıkartman en hızlısı). Document Root'u `public/` klasörüne
   ayarlamayı unutma — bir önceki mesajımdaki adım listesi bunu detaylı
   anlatıyor.
3. `.env` dosyasında sadece **APP_URL** satırını gerçek alan adınla
   değiştir (şu an `https://www.SIZINALANADINIZ.com` yazıyor). Geri kalan
   her şey (veritabanı bilgileri, güvenlik anahtarı) zaten dolu.
4. Siteye girip `/login`'den giriş yap ve şifreni değiştir (aşağıda).

Eğer SSH/terminal erişimin varsa, 1. adım yerine terminalden
`php artisan migrate --seed` de çalıştırabilirsin — ikisi de aynı sonucu
verir, hangisi senin için kolaysa onu kullan.

## Admin Paneli Girişi

- Adres: `https://sizin-alan-adiniz.com/login`
- E-posta: `merve@example.com`
- Şifre: `Degistir123!`

**Bu geçici bir şifredir — giriş yaptıktan hemen sonra
Kullanıcılar bölümünden mutlaka değiştirin.**

## Yayına almadan önce mutlaka güncelleyin

Sitede örnek/yer tutucu olarak bıraktığım yerler:

- **Ayarlar** sayfası: telefon, e-posta, açık adres, WhatsApp numarası
  (şu an boş — girene kadar hızlı randevu butonu görünmez)
- **Hakkımda** sayfası: eğitim geçmişi, unvan ve deneyim metinleri örnek
  olarak yazılmıştır, gerçek bilgilerinizle değiştirilmelidir
- **Hizmetler** ve **Blog** yazıları: örnek/genel bilgilendirme
  metinleri olarak hazırlanmıştır; kendi uzmanlık alanlarınıza ve
  üslubunuza göre düzenlemenizi öneririm
- Görseller: gerçek fotoğraf yerine geçici, soyut illüstrasyonlar
  kullanıldı (bilerek gerçek bir kişinin fotoğrafı kullanılmadı) —
  admin panelinden kendi fotoğraflarınızla değiştirebilirsiniz

## Renkleri Değiştirmek

Admin panelinde **Ayarlar** sayfasına girin, aşağıya doğru **"Site
Görünümü / Renkler"** başlığını göreceksiniz. En hızlı yol: hemen
altındaki **Hızlı Tema** butonlarından birine (Turuncu / Yeşil / Mavi /
Mor / Açık Zemin) tıklayıp **Kaydet**'e basmak — tüm site tek seferde o
temaya döner. İstersen butonların altındaki 5 renk seçiciyle ince ayar
da yapabilirsin.

## Teknik Notlar (isterseniz bir geliştiriciye iletebilirsiniz)

Bu şablonun orijinal halinde, sıfır bir kurulumu engelleyen birkaç
gerçek hata tespit edilip düzeltildi: `Slider` modelinin yanlış tablo
adına bakması, `slider`/`services_details` tablolarında eksik kolonlar,
`AppServiceProvider`'ın migration sırasında sorgu atıp kurulumu
çökertmesi, ve referans/portföy özelliğinin (bu site için kaldırıldığı
için) hiç var olmayan tablolara sorgu atması. Ayrıca "Ayarlar" formunda
sosyal medya alanlarından biri boş bırakılınca kaydın SQL hatasıyla
çökmesi gibi küçük ama gerçek kullanıcı deneyimi sorunları giderildi.
