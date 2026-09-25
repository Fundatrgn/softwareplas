<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Brand;
use App\Models\FooterLink;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Services;
use App\Models\ServicesCategory;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Sss;
use App\Models\SssCategory;
use App\Models\Timeline;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 * Sıfırdan kurulum için başlangıç içeriği.
 *
 * Metinler; Google aramaları, Facebook/Instagram profil özetleri ve
 * bilinen projelerden (Cangas / CAF Grup kurumsal içerikleri, Manşet 45,
 * 360° Medya Planlama ve Satın Alma Ajansı, Psikolog Merve Kalaycı web
 * sitesi) yola çıkılarak hazırlanmış TASLAK metinlerdir. Yayına almadan
 * önce admin panelinden kontrol edip kendi ifadelerinizle güncelleyin.
 * Referans yorumları bilerek boş bırakıldı: sadece gerçek ve izinli
 * yorumlar eklenmelidir.
 */
class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $name = 'Yunuscan ZEYBEK';

        // 1) Yönetici hesabı — ilk girişten sonra şifreyi mutlaka değiştirin.
        User::create([
            'name' => $name,
            'email' => env('ADMIN_EMAIL') ?: 'co@canzeybek.com.tr',
            'password' => bcrypt($adminPassword = env('ADMIN_PASSWORD') ?: Str::random(16)),
            'role' => User::ROLE_YONETICI,
        ]);

        $this->command?->warn('Yönetici şifresi: ' . $adminPassword . ' (ilk girişten sonra değiştirin)');

        // 2) Site ayarları
        Setting::create([
            'site_title' => 'Yunuscan ZEYBEK Kimdir? | Web, Dijital Medya ve Kurumsal İletişim',
            'description' => 'Yunuscan ZEYBEK kimdir? Manisa merkezli; web yazılımı, dijital yayıncılık, medya planlama ve kurumsal iletişim alanlarında çalışan Yunuscan ZEYBEK\'in resmi web sitesi.',
            'keywords' => 'Yunuscan Zeybek, Yunuscan ZEYBEK kimdir, Can Zeybek, Manisa web tasarım, Laravel, dijital medya, medya planlama, kurumsal iletişim, Manşet 45',
            'author' => $name,
            'job_title' => 'Web Yazılım & Dijital Medya Uzmanı',
            'same_as' => implode("\n", [
                'https://cloud.cangas.com.tr/author/caf/',
            ]),
            'email' => 'co@canzeybek.com.tr',
            'location_text' => 'Manisa, Türkiye',
            'availability_text' => 'Yeni projeler ve iş birlikleri için müsaitim',
            'instagram' => 'https://www.instagram.com/yunuscanzeybek/',
            'facebook' => 'https://www.facebook.com/gameoverrta/',
            'accent_color' => '#FD3A25',
            'quote_text' => 'İyi bir dijital iş, arkasındaki emeği göstermeden ziyaretçisine kendini kolayca anlatandır.',
            'quote_author' => $name,
            'quote_role' => 'Web & Dijital Medya',
            'stats' => [
                ['label' => 'Tamamlanan Proje', 'value' => '4', 'suffix' => '+'],
                ['label' => 'Uzmanlık Alanı', 'value' => '6', 'suffix' => ''],
                ['label' => 'Yıllık Kurumsal İçerik Deneyimi', 'value' => '4', 'suffix' => '+'],
            ],
            'footer_title' => 'Sosyal medyada bağlantıda kalalım',
            'footer_copyright_text' => $name . ' - Tüm Hakları Saklıdır',
            'kvkk_text' => '<p><strong>Kişisel Verilerin Korunması Hakkında Aydınlatma Metni</strong></p>'
                . '<p>Bu internet sitesindeki iletişim formu aracılığıyla paylaştığınız ad-soyad, e-posta, telefon ve mesaj içeriğinden ibaret kişisel verileriniz; 6698 sayılı Kişisel Verilerin Korunması Kanunu ("KVKK") kapsamında, veri sorumlusu sıfatıyla ' . $name . ' tarafından yalnızca talebinizin değerlendirilmesi ve sizinle iletişime geçilmesi amacıyla işlenmektedir.</p>'
                . '<p>Kişisel verileriniz, yasal zorunluluklar dışında üçüncü kişilerle paylaşılmaz ve gerekli teknik/idari tedbirlerle korunur. KVKK\'nın 11. maddesi kapsamındaki haklarınızı kullanmak için sitedeki iletişim bilgileri üzerinden başvurabilirsiniz.</p>'
                . '<p><em>(Bu metin örnek olarak hazırlanmıştır; yayına almadan önce bir hukuk danışmanına gözden geçirtmeniz önerilir.)</em></p>',
        ]);

        // 3) Anasayfa giriş alanı
        Slider::create([
            'sira' => 1,
            'badge' => 'Web • Dijital Medya • Kurumsal İletişim',
            'title' => $name,
            'title2' => 'Dijitalde Değer Üretir',
            'subtitle' => 'Manisa merkezli olarak web yazılımı, dijital yayıncılık, medya planlama ve kurumsal içerik alanlarında; markaların ve kişilerin dijital dünyada güçlü, güvenilir ve sürdürülebilir biçimde görünmesi için çalışıyorum.',
            'btn_text' => 'Projelerimi İncele',
            'btn_url' => '/projeler',
            'btn2_text' => 'Beni Tanıyın',
            'btn2_url' => '/yunuscan-zeybek-kimdir',
        ]);

        // 4) Hakkımda blokları (1. blok = "Yunuscan ZEYBEK Kimdir?" ana metni)
        About::create([
            'position' => 1,
            'subtitle' => 'Merhaba, ben Yunuscan',
            'title' => 'Yunuscan ZEYBEK Kimdir?',
            'content' => '<p><strong>Yunuscan ZEYBEK</strong>, Manisa merkezli çalışan; web yazılımı, dijital yayıncılık, medya planlama ve kurumsal iletişim alanlarında projeler üreten bir dijital medya ve web uzmanıdır.</p>'
                . '<p>2022\'den bu yana <strong>Cangas (CAF Grup)</strong> kurumsal web sitesinde basın, medya ve kurumsal duyuru içeriklerini hazırlayıp yayınlamaktadır. Manisa odaklı haber portalı <strong>Manşet 45</strong> ve <strong>360° Medya Planlama ve Satın Alma Ajansı</strong> çatısı altında dijital yayıncılık ve medya projelerinde yer almaktadır.</p>'
                . '<p>Web yazılımı tarafında Laravel tabanlı, yönetim panelli kurumsal siteler geliştirmektedir; <strong>Psikolog Merve Kalaycı</strong> için hazırladığı randevu ve danışan yönetim sistemli web sitesi bu çalışmalardan biridir.</p>'
                . '<p>Temel yaklaşımı; her projeyi kalıcı, yönetilebilir ve ölçülebilir kılmak, müşterisinin teknik bilgiye ihtiyaç duymadan kendi içeriğini yönetebilmesini sağlamaktır.</p>',
        ]);
        About::create([
            'position' => 2,
            'subtitle' => 'Kalıcılık',
            'title' => 'Sürdürülebilir İşler',
            'content' => '<p>Bir web sitesi ya da yayın, teslim edildiği gün bitmez. Kurduğum her yapıyı; sonradan kolayca güncellenebilen, yönetim paneliyle desteklenen ve uzun yıllar kullanılabilecek şekilde tasarlarım.</p>',
        ]);
        About::create([
            'position' => 3,
            'subtitle' => 'Şeffaflık',
            'title' => 'Açık İletişim',
            'content' => '<p>Sürecin her adımında ne yapıldığını, neden yapıldığını ve bir sonraki adımı açıkça paylaşırım. Beklentileri baştan netleştirmek, iyi sonuçların ilk şartıdır.</p>',
        ]);
        About::create([
            'position' => 4,
            'subtitle' => 'Yerellik',
            'title' => 'Manisa\'dan Dijitale',
            'content' => '<p>Yerel haberciliğin, KOBİ\'lerin ve bölge markalarının dijitalde daha görünür olması için çalışıyorum. Yerel dinamikleri bilen biriyle çalışmak, projeyi hızlandırır.</p>',
        ]);
        About::create([
            'position' => 5,
            'subtitle' => 'Ölçülebilirlik',
            'title' => 'Sonuç Odaklılık',
            'content' => '<p>Güzel görünen işlerden çok, işe yarayan işleri önemserim. Arama motoru görünürlüğü, hız ve kullanıcı deneyimi her projede ölçtüğüm temel kriterlerdir.</p>',
        ]);

        // 5) Kariyer yolculuğu
        $timeline = [
            ['Kurumsal İçerik ve Basın-Medya Yönetimi', 'Cangas (CAF Grup)', '2022 – Günümüz', 'Otogaz dönüşüm sistemleri üreticisi Cangas\'ın kurumsal web sitesinde haber, duyuru ve basın içeriklerinin hazırlanması ve yayınlanması.'],
            ['Dijital Yayıncılık', 'Manşet 45', 'Günümüz', 'Manisa odaklı haber portalı Manşet 45\'in dijital yayın ve web altyapı süreçleri.'],
            ['Medya Planlama ve Satın Alma', '360° Medya Planlama ve Satın Alma Ajansı', 'Günümüz', 'Markalar için medya planlama, dijital yayın ve iletişim projeleri.'],
            ['Web Yazılım ve CRM Projesi', 'Psikolog Merve Kalaycı', '2026', 'Randevu takvimi, danışan yönetimi ve yönetim paneli içeren Laravel tabanlı kurumsal web sitesi.'],
        ];
        foreach ($timeline as $i => [$title, $company, $year, $description]) {
            Timeline::create(compact('title', 'company', 'year', 'description') + ['order' => $i + 1]);
        }

        // 6) Hizmetler
        $category = ServicesCategory::create(['title' => 'Dijital Hizmetler', 'slug' => 'dijital-hizmetler']);
        $services = [
            [
                'Web Tasarım & Yazılım',
                'Laravel tabanlı, yönetim panelli, hızlı ve SEO uyumlu kurumsal web siteleri ile özel yazılım çözümleri.',
                'Laravel, Yönetim Paneli, SEO Uyumlu, Mobil Uyumlu',
                '<p>İhtiyacınıza göre sıfırdan tasarlanan ya da hazır bir tasarım üzerine kurulan, <strong>kendi yönetim paneliyle</strong> gelen web siteleri geliştiriyorum. Siteniz teslim edildikten sonra metin, görsel, blog yazısı ve proje gibi tüm içerikleri teknik bilgiye ihtiyaç duymadan güncelleyebilirsiniz.</p><h3>Neler sunuyorum?</h3><ul><li>Kurumsal ve kişisel web siteleri</li><li>Randevu, rezervasyon ve CRM gibi iş süreçlerine özel modüller</li><li>Arama motoru uyumlu (SEO) altyapı, site haritası ve yapılandırılmış veri</li><li>Mobil uyumlu, hızlı açılan sayfalar</li><li>Yayın sonrası bakım ve destek</li></ul>',
            ],
            [
                'Dijital Yayıncılık & Haber Portalı',
                'Yerel ve sektörel haber siteleri için yayın altyapısı, içerik akışı ve dijital büyüme.',
                'Haber Portalı, İçerik Akışı, Yerel Medya',
                '<p>Haber portalları için hızlı içerik girişi yapılabilen, kategori ve manşet yönetimi olan yayın altyapıları kuruyor; yayın süreçlerinin düzenli işlemesine destek oluyorum.</p><p>Manisa odaklı <strong>Manşet 45</strong> gibi yerel yayın projelerinde edindiğim deneyimle; haber akışı, arama motoru görünürlüğü ve sosyal medya dağıtımını birlikte planlıyorum.</p>',
            ],
            [
                'Kurumsal İletişim & İçerik Yönetimi',
                'Kurumsal web siteleri için haber, duyuru, basın bülteni ve blog içeriklerinin hazırlanması ve yayınlanması.',
                'Basın Bülteni, Kurumsal Blog, Duyuru',
                '<p>Markaların kurumsal sitelerinde düzenli ve tutarlı bir sesle görünmesi için basın bülteni, haber, etkinlik duyurusu ve blog içerikleri hazırlıyor, yayın takvimini yönetiyorum.</p><p>2022\'den bu yana <strong>Cangas (CAF Grup)</strong> kurumsal sitesinde basın ve medya içeriklerini yürütüyorum.</p>',
            ],
            [
                'Medya Planlama & Satın Alma',
                'Bütçeye uygun, hedef kitleye doğru kanallardan ulaşan dijital ve geleneksel medya planları.',
                'Medya Planı, Reklam, Hedefleme',
                '<p>Kampanyanızın hedefine ve bütçesine göre hangi kanalda, ne zaman ve hangi mesajla yer alacağınızı planlıyor; yayın sonrasında sonuçları raporluyorum.</p><p>Bu alandaki çalışmalarımı <strong>360° Medya Planlama ve Satın Alma Ajansı</strong> çatısı altında yürütüyorum.</p>',
            ],
            [
                'Sosyal Medya Yönetimi',
                'Marka sesine uygun paylaşım planı, içerik üretimi ve topluluk yönetimi.',
                'Instagram, Facebook, İçerik Planı',
                '<p>Sosyal medya hesaplarınız için aylık paylaşım planı hazırlıyor, görsel ve metin içeriklerini markanızın diliyle üretiyor, etkileşimleri takip ediyorum.</p>',
            ],
            [
                'SEO & Dijital Görünürlük',
                'Google\'da doğru aramalarda üst sıralarda görünmek için teknik SEO, içerik ve profil optimizasyonu.',
                'Teknik SEO, Google Search Console, Kişisel Marka',
                '<p>Sitenizin teknik altyapısını (hız, site haritası, yapılandırılmış veri) arama motorlarına uygun hale getiriyor; hedef aramalar için içerik stratejisi oluşturuyorum.</p><p>Kişiler için de "<em>Ad Soyad kimdir?</em>" gibi aramalarda doğru bilgilerin öne çıkması amacıyla kişisel marka ve profil optimizasyonu yapıyorum.</p>',
            ],
        ];
        foreach ($services as $i => [$title, $summary, $tags, $content]) {
            Services::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'category_id' => $category->id,
                'summary' => $summary,
                'tags' => $tags,
                'content' => $content,
                'order' => $i + 1,
            ]);
        }

        // 7) Projeler
        $projects = [
            [
                'Psikolog Merve Kalaycı Web Sitesi & Randevu Sistemi', 'Web Yazılım', 'Psikolog Merve Kalaycı', '2026', null,
                'Randevu takvimi, danışan yönetimi ve rol bazlı yönetim paneli içeren, Laravel tabanlı kurumsal web sitesi.',
                'Web tasarım, Laravel, Randevu / CRM, Yönetim paneli, SEO',
                '<p>Manisa\'da ve online olarak hizmet veren Psikolog Merve Kalaycı için, danışanların site üzerinden uygun gün ve saati görerek randevu talep edebildiği kurumsal bir web sitesi geliştirildi.</p><h3>Öne çıkan özellikler</h3><ul><li>Gerçek zamanlı müsaitlik takvimi ve randevu talebi</li><li>Danışan kartları, seans notları ve PDF raporu</li><li>E-posta / SMS bildirim altyapısı ve hatırlatmalar</li><li>Yönetici ve psikolog rolleriyle ayrılmış yönetim paneli</li><li>Blog, SSS ve hizmet sayfalarının panelden yönetimi</li></ul>',
            ],
            [
                'Manşet 45 Haber Portalı', 'Dijital Yayıncılık', 'Manşet 45', null, null,
                'Manisa odaklı güncel haber portalı için dijital yayın ve web altyapı çalışmaları.',
                'Haber portalı, Yayın altyapısı, Yerel medya',
                '<p>Manşet 45, Manisa ve çevresinden son dakika gelişmeleri, teknoloji, kültür ve yaşam haberlerini okuyucularıyla buluşturan yerel bir haber portalıdır. Portalın dijital yayın süreçlerinde ve web altyapısında görev alındı.</p>',
            ],
            [
                'Cangas Kurumsal İçerik & Basın-Medya', 'Kurumsal İletişim', 'Cangas (CAF Grup)', '2022 – Günümüz', 'https://cloud.cangas.com.tr/author/caf/',
                'Otogaz dönüşüm sistemleri üreticisi Cangas\'ın kurumsal sitesinde haber, duyuru ve basın içerikleri.',
                'Basın bülteni, Kurumsal blog, İçerik yönetimi',
                '<p>CAF Grup bünyesinde LPG dönüşüm kitleri ve tankları üreten Cangas\'ın kurumsal web sitesinde; fuar katılımları, sektör haberleri, kurumsal ziyaretler ve sosyal sorumluluk çalışmalarına dair içerikler 2022\'den bu yana düzenli olarak hazırlanıp yayınlanmaktadır.</p>',
            ],
            [
                '360° Medya Planlama ve Satın Alma Ajansı', 'Medya Planlama', '360° Medya', null, null,
                'Markalar için medya planlama, satın alma ve dijital yayın projeleri.',
                'Medya planlama, Dijital yayın, Web projeleri',
                '<p>360° Medya Planlama ve Satın Alma Ajansı çatısı altında markaların hedef kitlelerine doğru kanallardan ulaşması için medya planları hazırlanmakta; dijital yayın ve web projeleri geliştirilmektedir.</p>',
            ],
        ];
        foreach ($projects as $i => [$title, $cat, $client, $year, $url, $summary, $deliverables, $content]) {
            Project::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'category' => $cat,
                'client' => $client,
                'year' => $year,
                'url' => $url,
                'summary' => $summary,
                'deliverables' => $deliverables,
                'content' => $content,
                'is_featured' => true,
                'order' => $i + 1,
            ]);
        }

        // 8) Çalıştığım markalar (logolar panelden yüklenebilir)
        foreach (['Cangas', 'CAF Grup', 'Manşet 45', '360° Medya', 'Psikolog Merve Kalaycı'] as $i => $brand) {
            Brand::create(['name' => $brand, 'order' => $i + 1]);
        }

        // 9) Çalışma süreci
        $steps = [
            ['Keşif & Analiz', 'İhtiyacı, hedef kitleyi ve başarı ölçütlerini birlikte netleştiriyoruz; yol haritası ve kapsam belirleniyor.', '1-3 GÜN', 'icon-search-solid'],
            ['Tasarım & Planlama', 'Sayfa yapısı, içerik planı ve görsel dil hazırlanıyor; onayınızla bir sonraki adıma geçiliyor.', '1 HAFTA', 'icon-bezier-curve-solid'],
            ['Geliştirme & Yayın', 'Yazılım, içerik girişi, SEO ayarları ve testler tamamlanıp proje yayına alınıyor.', '1-3 HAFTA', 'icon-code-solid'],
            ['Destek & Büyüme', 'Yayın sonrası ölçümleme, iyileştirme ve düzenli içerik desteğiyle proje büyümeye devam ediyor.', 'SÜREKLİ', 'icon-chart-line-solid'],
        ];
        foreach ($steps as $i => [$title, $content, $duration, $icon]) {
            ProcessStep::create(compact('title', 'content', 'duration', 'icon') + ['order' => $i + 1]);
        }

        // 10) Blog
        $cats = [];
        foreach (['Kişisel', 'Web Yazılım', 'Dijital Medya'] as $title) {
            $cats[$title] = BlogCategory::create(['title' => $title, 'slug' => Str::slug($title)]);
        }
        $posts = [
            [
                'Kişisel', 'Yunuscan ZEYBEK Kimdir? Kısa Bir Tanışma',
                'Yunuscan ZEYBEK kimdir, ne iş yapar, hangi projelerde yer aldı? Kendi kaleminden kısa bir tanışma yazısı.',
                'Yunuscan Zeybek, kimdir, biyografi, Manisa',
                '<p>Merhaba, ben <strong>Yunuscan ZEYBEK</strong>. Manisa\'da yaşıyor ve çalışıyorum. Uzun süredir web yazılımı, dijital yayıncılık ve kurumsal iletişim alanlarında projeler üretiyorum.</p><h2>Neler yapıyorum?</h2><p>Bir yandan kurumsal web siteleri ve yönetim panelleri geliştirirken, diğer yandan markaların dijital dünyadaki sesini oluşturan içerikleri hazırlıyorum. 2022\'den bu yana Cangas (CAF Grup) kurumsal sitesinde basın ve medya içeriklerini yürütüyorum; Manisa odaklı haber portalı Manşet 45 ve 360° Medya Planlama ve Satın Alma Ajansı çatısı altında dijital yayın ve medya projelerinde yer alıyorum.</p><h2>Bu site neden var?</h2><p>"Yunuscan ZEYBEK kimdir?" diye merak edenlerin beni, yaptığım işleri ve düşüncelerimi tek bir yerde bulabilmesi için bu platformu hazırladım. Projelerimi, hizmetlerimi ve yazılarımı burada düzenli olarak paylaşacağım.</p><p>Bir proje, iş birliği ya da sadece tanışmak için <a href="/iletisim">iletişim sayfasından</a> bana ulaşabilirsiniz.</p>',
            ],
            [
                'Web Yazılım', 'Kurumsal Web Sitelerinde Yönetim Paneli Neden Önemli?',
                'Sitenizi her güncelleme için bir yazılımcıya bağımlı olmadan yönetebilmenin işletmenize kazandırdıkları.',
                'yönetim paneli, kurumsal web sitesi, Laravel',
                '<p>Bir web sitesinin değeri, güncel kaldığı sürece devam eder. Ancak pek çok işletme, basit bir metin ya da görsel değişikliği için bile yazılımcısına ulaşmak zorunda kalıyor.</p><h2>Yönetim paneli ne sağlar?</h2><ul><li><strong>Bağımsızlık:</strong> Metin, görsel, blog ve proje içeriklerini kendiniz güncellersiniz.</li><li><strong>Hız:</strong> Kampanya ya da duyuruları dakikalar içinde yayına alırsınız.</li><li><strong>Maliyet:</strong> Küçük değişiklikler için ek hizmet bedeli ödemezsiniz.</li><li><strong>SEO:</strong> Düzenli içerik eklemek, arama motorlarında görünürlüğü artırır.</li></ul><p>Geliştirdiğim tüm sitelerde, ihtiyaca göre şekillendirilmiş bir yönetim paneli standart olarak yer alıyor.</p>',
            ],
            [
                'Dijital Medya', 'Yerel Haber Yayıncılığında Dijital Dönüşüm',
                'Yerel haber sitelerinin dijitalde okura daha hızlı ve güvenilir biçimde ulaşması için dikkat edilmesi gerekenler.',
                'yerel medya, haber portalı, dijital yayıncılık',
                '<p>Yerel haberciliğin gücü, okuruna yakın olmasından gelir. Dijital dönüşüm ise bu yakınlığı hıza ve erişilebilirliğe çevirmenin yoludur.</p><h2>Öne çıkan başlıklar</h2><ul><li><strong>Hızlı yayın altyapısı:</strong> Haberin sahadan sisteme dakikalar içinde girilebilmesi.</li><li><strong>Arama motoru uyumu:</strong> Doğru başlık, açıklama ve yapılandırılmış veri ile haberin bulunabilir olması.</li><li><strong>Mobil deneyim:</strong> Okurların büyük çoğunluğunun haberi telefondan okuduğunu unutmamak.</li><li><strong>Sosyal medya dağıtımı:</strong> Haberin doğru saatte doğru kanalda paylaşılması.</li></ul><p>Manisa odaklı yayın projelerinde bu başlıkları birlikte ele alarak çalışıyorum.</p>',
            ],
        ];
        foreach ($posts as $i => [$cat, $title, $summary, $tags, $content]) {
            Blog::create([
                'category_id' => $cats[$cat]->id,
                'title' => $title,
                'slug' => Str::slug($title),
                'summary' => $summary,
                'tags' => $tags,
                'content' => $content,
                'created_at' => now()->subDays(10 - $i * 4),
                'updated_at' => now()->subDays(10 - $i * 4),
            ]);
        }

        // 11) Sık sorulan sorular
        $faqCategory = SssCategory::create(['title' => 'Genel', 'slug' => 'genel']);
        $faqs = [
            ['Yunuscan ZEYBEK kimdir?', '<p>Yunuscan ZEYBEK, Manisa merkezli çalışan; web yazılımı, dijital yayıncılık, medya planlama ve kurumsal iletişim alanlarında projeler üreten bir dijital medya ve web uzmanıdır. Detaylar için <a href="/yunuscan-zeybek-kimdir">Hakkımda</a> sayfasına göz atabilirsiniz.</p>'],
            ['Hangi hizmetleri veriyorsunuz?', '<p>Web tasarım ve yazılım, dijital yayıncılık, kurumsal iletişim ve içerik yönetimi, medya planlama, sosyal medya yönetimi ile SEO ve dijital görünürlük alanlarında hizmet veriyorum.</p>'],
            ['Sadece Manisa\'daki projelerle mi çalışıyorsunuz?', '<p>Hayır. Manisa merkezliyim ancak web ve dijital medya projelerinin büyük kısmını uzaktan yürütebildiğim için Türkiye\'nin her yerinden projelerle çalışıyorum.</p>'],
            ['Bir web sitesi projesi ne kadar sürer?', '<p>Kapsama göre değişmekle birlikte, yönetim panelli standart bir kurumsal site genellikle 2-4 hafta içinde yayına alınır. İlk görüşmede size özel bir zaman planı paylaşıyorum.</p>'],
            ['Size nasıl ulaşabilirim?', '<p>İletişim sayfasındaki formu doldurabilir ya da e-posta ve sosyal medya hesaplarım üzerinden bana yazabilirsiniz.</p>'],
        ];
        foreach ($faqs as [$title, $content]) {
            Sss::create(['title' => $title, 'content' => $content, 'category_id' => $faqCategory->id]);
        }

        // 12) Sayfa sonu ek bağlantılar
        FooterLink::create(['title' => 'SSS', 'url' => '/sss', 'order' => 1]);
        FooterLink::create(['title' => 'KVKK', 'url' => '/kvkk', 'order' => 2]);
    }
}
