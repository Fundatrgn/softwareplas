<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Hakkimizda;
use App\Models\Services;
use App\Models\ServicesCategory;
use App\Models\ServicesDetail;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Bu seeder, Marya Aile ve Psikoegitim Danismanligi icin hazirlanan site iskeletine
     * baslangic icerigi yukler. Buradaki tum metinler ORNEK/YER TUTUCUdur;
     * gercek yayina almadan once admin panelinden (Ayarlar, Hizmetler,
     * Blog, Slider bolumleri) gozden gecirilip guncellenmelidir.
     */
    public function run(): void
    {
        // 1) Admin girisi
        User::create([
            'name' => 'Marya Yönetici',
            'email' => 'merve@example.com',
            'password' => bcrypt('Degistir123!'),
            'created_by' => 1,
        ]);

        // 2) Genel Ayarlar
        Setting::create([
            'image' => 'marya-logo-yatay.png',
            'logo_white' => 'marya-logo-yatay-beyaz.png',
            'favicon' => 'marya-favicon.png',
            'site_title' => 'Marya Aile ve Psikoeğitim Danışmanlığı | Manisa & Online',
            'description' => 'Manisa merkezli, aile danışmanlığı, çift terapisi ve online terapi hizmeti sunan Marya Aile ve Psikoeğitim Danışmanlığı\'nın resmi web sitesi.',
            'keywords' => 'aile danışmanlığı, psikoeğitim, manisa psikolog, çift terapisi, online terapi',
            'author' => 'Marya',
            'linkedin' => '',
            'instagram' => 'https://www.instagram.com/maryadanismanlik/',
            'youtube' => '',
            'twitter' => '',
            'facebook' => '',
            'phone' => '0 (5XX) XXX XX XX',
            'email' => 'info@example.com',
            'address' => 'Manisa, Türkiye',
            'accent_color' => '#223B52',
            'secondary_color' => '#A8C39B',
            'heading_color' => '#18212B',
            'body_text_color' => '#45566B',
            'background_color' => '#F7F3EA',
            'whatsapp_number' => null,
            'sidebar_bio' => 'Manisa\'da ve online olarak bireysel ve çift terapisi hizmeti veriyorum. Randevu almak için benimle iletişime geçebilirsiniz.',
            'kvkk_text' => "<p><strong>Kişisel Verilerin Korunması Hakkında Aydınlatma Metni</strong></p>" .
                "<p>Bu internet sitesi üzerinden (randevu ve iletişim formları aracılığıyla) tarafımla paylaştığınız ad-soyad, telefon, e-posta ve mesaj içeriğinden ibaret kişisel verileriniz; 6698 sayılı Kişisel Verilerin Korunması Kanunu (\"KVKK\") kapsamında, veri sorumlusu sıfatıyla tarafımca, yalnızca randevu talebinizin değerlendirilmesi, sizinle iletişime geçilmesi ve talep ettiğiniz bilgilendirmenin yapılması amacıyla işlenmektedir.</p>" .
                "<p>Kişisel verileriniz, yasal zorunluluklar dışında üçüncü kişilerle paylaşılmaz, açık rızanız veya kanunda öngörülen haller dışında başka bir amaçla kullanılmaz ve gerekli teknik/idari tedbirlerle korunur.</p>" .
                "<p>KVKK'nın 11. maddesi kapsamında; kişisel verilerinizin işlenip işlenmediğini öğrenme, işlenmişse buna ilişkin bilgi talep etme, işlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme, yurt içinde/yurt dışında aktarıldığı üçüncü kişileri bilme, eksik/yanlış işlenmişse düzeltilmesini isteme, silinmesini/yok edilmesini isteme ve bu işlemlerin ilgili üçüncü kişilere bildirilmesini isteme haklarına sahipsiniz.</p>" .
                "<p>Bu haklarınızı kullanmak için sitede yer alan iletişim bilgileri üzerinden tarafıma ulaşabilirsiniz.</p>" .
                "<p><em>(Bu metin örnek olarak hazırlanmıştır; yayına almadan önce bir hukuk danışmanına gözden geçirtmenizi öneririz. Bu alanı admin panelinden dilediğiniz gibi düzenleyebilirsiniz.)</em></p>",
        ]);

        // 3) Anasayfa Slider
        Slider::create([
            'title' => 'Kendinize Zaman Ayırın',
            'subtitle' => 'Bireysel, çift ve online terapiyle yanınızdayım. Değişim için ilk adımı birlikte atalım.',
            'first' => '',
            'second' => '',
            'threed' => '',
            'btn_text' => 'Randevu Al',
            'image' => 'hero-slider.svg',
            'sira' => 1,
        ]);

        // 4) Hizmetler (Bireysel / Cift / Online Terapi)
        $services = [
            [
                'category' => 'Bireysel Terapi',
                'image' => 'service-bireysel.svg',
                'subtitle' => 'BİREYSEL TERAPİ',
                'lead' => 'Kaygı, stres, tükenmişlik, özgüven, yas ya da yaşamın herhangi bir döneminde zorlandığınız konularda; yargılanmadan, kendi hızınızda ilerleyebileceğiniz bir alan sunuyorum.',
                'content' => "<p>Bireysel terapi, kendinizi ve yaşadıklarınızı daha yakından tanımak, zorlandığınız alanlarda destek almak için ayırdığınız bir zamandır. Seanslarda kaygı, stres, tükenmişlik, özgüven, ilişki güçlükleri, yas ve kayıp gibi pek çok konuda birlikte çalışabiliriz.</p><p>Görüşmelerde güncel bilimsel yaklaşımlardan yararlanır, sürecin her adımında sizi bilgilendiririm. Paylaştığınız her bilgi gizlilik ilkesi çerçevesinde korunur.</p><p>Seans sıklığı ve süreci, ihtiyaçlarınıza göre birlikte belirlenir; bu sayfadaki bilgiler genel bir çerçeve sunmak amacıyla hazırlanmıştır.</p>",
            ],
            [
                'category' => 'Çift Terapisi',
                'image' => 'service-cift.svg',
                'subtitle' => 'ÇİFT TERAPİSİ',
                'lead' => 'İletişim güçlükleri, güven sorunları ya da hayatın farklı dönemlerinde ilişkinizi yeniden güçlendirmek isteyen çiftler için tarafsız bir üçüncü göz.',
                'content' => "<p>Çift terapisi, ilişkinizdeki iletişim kalıplarını fark etmenizi, birbirinizi daha iyi anlamanızı ve birlikte çözüm üretmenizi hedefleyen bir süreçtir. Görüşmelere çiftler birlikte katılır; bazı durumlarda bireysel görüşmelerle desteklenebilir.</p><p>Sürecin amacı taraflardan birini \"haklı\" çıkarmak değil, ilişkideki dinamikleri birlikte görünür kılmaktır. Her iki tarafın da kendini güvende ve duyulmuş hissettiği bir ortam önceliğimdir.</p>",
            ],
            [
                'category' => 'Online Terapi',
                'image' => 'service-online.svg',
                'subtitle' => 'ONLİNE TERAPİ',
                'lead' => 'Manisa dışında ya da yoğun bir programda olsanız da, güvenli görüntülü görüşme ile aynı içerik ve gizlilikte destek alabilirsiniz.',
                'content' => "<p>Online terapi, yüz yüze görüşmeye zaman ya da mesafe nedeniyle gelemeyen danışanlar için görüntülü görüşme üzerinden yürütülen bir terapi biçimidir. Yapılan araştırmalar, uygun koşullar sağlandığında online terapinin yüz yüze terapiyle benzer etkinlikte olabildiğini göstermektedir.</p><p>Görüşme öncesinde sizinle güvenli bağlantı bilgileri paylaşılır; sürecin gizliliği yüz yüze görüşmelerdeki ile aynı titizlikte korunur.</p>",
            ],
        ];

        foreach ($services as $i => $s) {
            $category = ServicesCategory::create([
                'title' => $s['category'],
                'slug' => Str::slug($s['category']),
            ]);

            $service = Services::create([
                'title' => $s['category'],
                'image' => $s['image'],
                'slug' => Str::slug($s['category']),
                'category_id' => $category->id,
                'order' => $i + 1,
            ]);

            ServicesDetail::create([
                'service_id' => $service->id,
                'title' => $s['category'],
                'subtitle' => $s['subtitle'],
                'image' => $s['image'],
                'keywords' => $s['category'] . ', ' . $s['subtitle'],
                'position' => $i + 1,
                'content' => '<p><strong>' . $s['lead'] . '</strong></p>' . $s['content'],
            ]);
        }

        // 5) Blog (psikoegitim / bilgilendirici yazilar)
        $blogCategory = BlogCategory::create([
            'title' => 'Psikoeğitim',
            'slug' => 'psikoegitim',
        ]);

        $posts = [
            [
                'title' => 'Kaygıyla Baş Etmenin Yolları',
                'image' => 'blog-kaygi.svg',
                'tags' => 'kaygı, stres yönetimi, psikoeğitim',
                'summary' => 'Günlük hayatta karşılaştığımız kaygı hissiyle sağlıklı bir şekilde baş etmenin genel yollarına dair bilgilendirici bir yazı.',
                'content' => "<p>Kaygı, hayatın normal ve zaman zaman koruyucu bir parçasıdır; ancak sıklaştığında ya da günlük yaşamı zorlaştırdığında üzerinde durmaya değer bir konu haline gelir.</p><p><strong>Nefes çalışmaları:</strong> Yavaş ve derin nefes almak, bedenin stres tepkisini yatıştırmaya yardımcı olabilir.</p><p><strong>Düşünceleri fark etmek:</strong> Kaygılı anlarda zihinden geçenleri yargılamadan not etmek, onlarla aramıza bir mesafe koymamızı sağlayabilir.</p><p><strong>Rutin ve uyku:</strong> Düzenli uyku ve günlük rutin, kaygı yönetiminde önemli bir zemin oluşturur.</p><p>Kaygı uzun süredir hayatınızı zorlaştırıyorsa, bir uzmandan destek almak atabileceğiniz değerli bir adımdır. Bu yazı genel bilgilendirme amaçlıdır; kişisel durumunuz için bir görüşme planlamaktan çekinmeyin.</p>",
            ],
            [
                'title' => 'Online Terapi Nedir, Nasıl İşler?',
                'image' => 'blog-online-terapi.svg',
                'tags' => 'online terapi, sıkça sorulanlar',
                'summary' => 'Görüntülü görüşme yoluyla yürütülen online terapinin ne olduğu ve süreçte nelere dikkat edilmesi gerektiği hakkında merak edilenler.',
                'content' => "<p>Online terapi, danışan ve terapistin güvenli bir görüntülü görüşme platformu üzerinden bir araya geldiği bir çalışma biçimidir.</p><p><strong>Nasıl başlar?</strong> Randevu sonrası size özel bir bağlantı paylaşılır; seans, tıpkı yüz yüze görüşmede olduğu gibi belirlenen saatte gerçekleşir.</p><p><strong>Gizlilik nasıl korunur?</strong> Görüşmenin sizin için sessiz ve kesintisiz bir ortamda yapılması, gizliliğin korunması açısından önemlidir.</p><p><strong>Kimler için uygundur?</strong> Seyahat, yoğun iş temposu ya da farklı bir şehirde/ülkede yaşama gibi nedenlerle yüz yüze görüşemeyen pek çok kişi online terapiden fayda görebilir.</p>",
            ],
            [
                'title' => 'İlk Terapi Seansında Neler Olur?',
                'image' => 'blog-ilk-seans.svg',
                'tags' => 'ilk seans, terapiye başlarken',
                'summary' => 'Terapiye ilk kez başlayacak olanlar için ilk seansta genel olarak neler konuşulduğuna dair bilgilendirici bir rehber.',
                'content' => "<p>Terapiye başlamak, pek çok kişi için heyecan verici olduğu kadar biraz da endişe uyandırıcı olabilir. İlk seans, genellikle birbirimizi tanımaya ve sizi buraya getiren konuyu anlamaya ayrılır.</p><p>Bu görüşmede geçmişiniz, şu anki yaşam koşullarınız ve terapiden beklentileriniz hakkında sorular sorarım; ancak anlatmak istemediğiniz hiçbir şeyi paylaşmak zorunda değilsiniz.</p><p>Amaç, ilk seansın sonunda birlikte çalışmanın sizin için doğru hissedip hissetmediğine karar verebilmenizdir.</p>",
            ],
        ];

        foreach ($posts as $p) {
            Blog::create([
                'category_id' => $blogCategory->id,
                'title' => $p['title'],
                'summary' => $p['summary'],
                'content' => $p['content'],
                'tags' => $p['tags'],
                'slug' => Str::slug($p['title']),
                'image' => $p['image'],
            ]);
        }

        // 6) Hakkimda
        Hakkimizda::create([
            'subtitle' => 'MERHABA',
            'title' => 'Marya Ailesine Hoş Geldiniz',
            'content' => '<p>Marya Aile ve Psikoeğitim Danışmanlığı olarak, alanında uzman ekibimizle Manisa\'da ve online olarak aile danışmanlığı, çift danışmanlığı ve bireysel danışmanlık hizmeti veriyoruz. Danışanlarımızla çalışırken güncel bilimsel yaklaşımlardan yararlanır, her sürecin o kişiye/aileye özgü olduğuna inanırız.</p><p><em>(Bu metin örnektir — ekibinizin eğitim geçmişi, unvanları ve deneyimiyle güncellemenizi öneririz.)</em></p>',
            'image' => 'about-1.svg',
            'position' => '1',
        ]);

        Hakkimizda::create([
            'subtitle' => 'YAKLAŞIMIM',
            'title' => 'Güvenli, Yargısız Bir Alan',
            'content' => '<p>Terapiye gelen her kişinin kendine has bir hikâyesi olduğuna inanıyorum. Seanslarda sizi dinlemeyi, birlikte anlamlandırmayı ve kendi çözümlerinizi bulmanıza eşlik etmeyi önceliğim olarak görüyorum. Paylaştığınız her şey gizlilik ilkesi çerçevesinde korunur.</p>',
            'image' => 'about-1.svg',
            'position' => '2',
        ]);
        // 7) Sık Sorulan Sorular
        $sssCategory = \App\Models\SssCategory::create([
            'title' => 'Genel Sorular',
            'slug' => 'genel-sorular',
        ]);

        $sorular = [
            [
                'title' => 'Seanslar ne kadar sürüyor?',
                'content' => '<p>Bireysel ve çift seansları genellikle 45-50 dakika sürer. Randevu sırasında size uygun süre ve sıklık birlikte planlanır.</p>',
            ],
            [
                'title' => 'Görüştüklerimiz gizli kalır mı?',
                'content' => '<p>Evet. Paylaştığınız bilgiler, yasal zorunluluk durumları dışında gizlilik ilkesi çerçevesinde korunur ve üçüncü kişilerle paylaşılmaz.</p>',
            ],
            [
                'title' => 'Online terapi yüz yüze terapi kadar etkili mi?',
                'content' => '<p>Alanyazındaki çalışmalar, uygun koşullar sağlandığında online terapinin yüz yüze terapiyle benzer etkinlikte olabildiğini göstermektedir. Sizin için en uygun yöntemi birlikte değerlendirebiliriz.</p>',
            ],
            [
                'title' => 'Randevu almak için ne yapmalıyım?',
                'content' => '<p>Sitedeki "Randevu Al" sayfasından size uygun gün ve saati seçerek talep oluşturabilir, ya da doğrudan WhatsApp üzerinden yazabilirsiniz.</p>',
            ],
        ];

        foreach ($sorular as $s) {
            \App\Models\Sss::create([
                'title' => $s['title'],
                'content' => $s['content'],
                'category_id' => $sssCategory->id,
            ]);
        }
    }
}
