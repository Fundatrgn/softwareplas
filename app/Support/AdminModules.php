<?php

namespace App\Support;

use App\Models\About;
use App\Models\Brand;
use App\Models\ProcessStep;
use App\Models\Project;
use App\Models\Testimonial;
use App\Models\Timeline;

/**
 * Admin panelindeki "basit liste + ekle/düzenle formu" şeklindeki içerik
 * bölümlerinin tanımları. Her bölüm için ayrı kontrolcü ve Blade dosyası
 * yazmak yerine alanlar burada tanımlanır; ModuleController ve
 * dashboard/module/*.blade.php görünümleri bu tanımdan formu ve listeyi
 * otomatik oluşturur. Yeni bir alan eklemek için: migration'a kolonu
 * ekleyin, sonra buradaki "fields" listesine bir satır ekleyin.
 *
 * Alan tipleri: text, url, number, textarea, editor (CKEditor),
 * image, checkbox.
 */
class AdminModules
{
    public static function all(): array
    {
        return [
            'hakkimda' => [
                'model' => About::class,
                'title' => 'Hakkımda Blokları',
                'singular' => 'Blok',
                'help' => '1. sıradaki blok "Hakkımda" sayfasındaki ana tanıtım metnidir (Yunuscan ZEYBEK Kimdir?). Diğer bloklar "Değerlerim / Yaklaşımım" kartları olarak gösterilir.',
                'order_by' => ['position', 'asc'],
                'columns' => ['position' => 'Sıra', 'subtitle' => 'Üst Başlık', 'title' => 'Başlık'],
                'fields' => [
                    ['name' => 'subtitle', 'label' => 'Üst Başlık (küçük etiket)', 'type' => 'text', 'col' => 6],
                    ['name' => 'position', 'label' => 'Sıra', 'type' => 'number', 'col' => 6, 'default' => 1],
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'required' => true],
                    ['name' => 'content', 'label' => 'İçerik', 'type' => 'editor'],
                    ['name' => 'image', 'label' => 'Görsel (isteğe bağlı)', 'type' => 'image'],
                ],
            ],
            'kariyer' => [
                'model' => Timeline::class,
                'title' => 'Kariyer Yolculuğu',
                'singular' => 'Kariyer Adımı',
                'help' => 'Hakkımda sayfasındaki "Kariyer Yolculuğu" listesi. Sıra alanı küçükten büyüğe dizilir.',
                'order_by' => ['order', 'asc'],
                'columns' => ['logo' => 'Logo', 'year' => 'Yıl', 'title' => 'Görev / Başlık', 'company' => 'Kurum'],
                'fields' => [
                    ['name' => 'title', 'label' => 'Görev / Başlık', 'type' => 'text', 'required' => true, 'col' => 6],
                    ['name' => 'company', 'label' => 'Kurum / Marka', 'type' => 'text', 'col' => 6],
                    ['name' => 'year', 'label' => 'Yıl (ör. 2022 – Günümüz)', 'type' => 'text', 'col' => 6],
                    ['name' => 'order', 'label' => 'Sıra', 'type' => 'number', 'col' => 6, 'default' => 1],
                    ['name' => 'description', 'label' => 'Kısa Açıklama', 'type' => 'textarea'],
                    ['name' => 'logo', 'label' => 'Logo (isteğe bağlı)', 'type' => 'image'],
                ],
            ],
            'projeler' => [
                'model' => Project::class,
                'title' => 'Projeler / Yaptığım İşler',
                'singular' => 'Proje',
                'help' => '"Öne çıkan" işaretli projeler anasayfada gösterilir. Teslim edilenler alanına virgülle ayırarak birden fazla etiket yazabilirsiniz.',
                'order_by' => ['order', 'asc'],
                'slug_from' => 'title',
                'columns' => ['image' => 'Görsel', 'title' => 'Proje', 'category' => 'Kategori', 'year' => 'Yıl', 'is_featured' => 'Öne Çıkan'],
                'fields' => [
                    ['name' => 'title', 'label' => 'Proje Adı', 'type' => 'text', 'required' => true, 'col' => 8],
                    ['name' => 'order', 'label' => 'Sıra', 'type' => 'number', 'col' => 4, 'default' => 1],
                    ['name' => 'category', 'label' => 'Kategori / Sektör', 'type' => 'text', 'col' => 4],
                    ['name' => 'client', 'label' => 'Müşteri / Kurum', 'type' => 'text', 'col' => 4],
                    ['name' => 'year', 'label' => 'Yıl', 'type' => 'text', 'col' => 4],
                    ['name' => 'url', 'label' => 'Proje Bağlantısı (varsa)', 'type' => 'url'],
                    ['name' => 'summary', 'label' => 'Kısa Açıklama (liste kartında görünür)', 'type' => 'textarea'],
                    ['name' => 'deliverables', 'label' => 'Teslim Edilenler (virgülle ayırın)', 'type' => 'text'],
                    ['name' => 'content', 'label' => 'Proje Detayı', 'type' => 'editor'],
                    ['name' => 'image', 'label' => 'Kapak Görseli', 'type' => 'image', 'crop' => [1320, 800]],
                    ['name' => 'image_2', 'label' => 'Galeri Görseli 1', 'type' => 'image', 'col' => 6],
                    ['name' => 'image_3', 'label' => 'Galeri Görseli 2', 'type' => 'image', 'col' => 6],
                    ['name' => 'is_featured', 'label' => 'Anasayfada öne çıkar', 'type' => 'checkbox', 'default' => 1],
                ],
            ],
            'markalar' => [
                'model' => Brand::class,
                'title' => 'Çalıştığım Markalar',
                'singular' => 'Marka',
                'help' => 'Anasayfa ve Hakkımda sayfasındaki kayan marka şeridi. Logo yüklemezseniz marka adı yazı olarak gösterilir.',
                'order_by' => ['order', 'asc'],
                'columns' => ['logo' => 'Logo', 'name' => 'Marka', 'url' => 'Bağlantı'],
                'fields' => [
                    ['name' => 'name', 'label' => 'Marka Adı', 'type' => 'text', 'required' => true, 'col' => 8],
                    ['name' => 'order', 'label' => 'Sıra', 'type' => 'number', 'col' => 4, 'default' => 1],
                    ['name' => 'url', 'label' => 'Web Sitesi (isteğe bağlı)', 'type' => 'url'],
                    ['name' => 'logo', 'label' => 'Logo (şeffaf PNG / SVG önerilir)', 'type' => 'image'],
                ],
            ],
            'yorumlar' => [
                'model' => Testimonial::class,
                'title' => 'Referans Yorumları',
                'singular' => 'Yorum',
                'help' => 'Birlikte çalıştığınız kişilerin sizin hakkınızdaki görüşleri. Hiç yorum yoksa bu bölüm sitede gizlenir. Lütfen sadece izin aldığınız gerçek yorumları ekleyin.',
                'order_by' => ['order', 'asc'],
                'columns' => ['image' => 'Fotoğraf', 'name' => 'Ad Soyad', 'role' => 'Unvan / Kurum'],
                'fields' => [
                    ['name' => 'name', 'label' => 'Ad Soyad', 'type' => 'text', 'required' => true, 'col' => 6],
                    ['name' => 'role', 'label' => 'Unvan / Kurum', 'type' => 'text', 'col' => 6],
                    ['name' => 'content', 'label' => 'Yorum', 'type' => 'textarea', 'required' => true],
                    ['name' => 'order', 'label' => 'Sıra', 'type' => 'number', 'col' => 6, 'default' => 1],
                    ['name' => 'image', 'label' => 'Fotoğraf (isteğe bağlı)', 'type' => 'image', 'col' => 6, 'crop' => [600, 700]],
                ],
            ],
            'surec' => [
                'model' => ProcessStep::class,
                'title' => 'Çalışma Sürecim',
                'singular' => 'Süreç Adımı',
                'help' => 'Anasayfa ve Hizmetler sayfasındaki "Nasıl Çalışıyorum" kaydırmalı kartları.',
                'order_by' => ['order', 'asc'],
                'columns' => ['order' => 'Sıra', 'title' => 'Başlık', 'duration' => 'Süre'],
                'fields' => [
                    ['name' => 'title', 'label' => 'Başlık', 'type' => 'text', 'required' => true, 'col' => 8],
                    ['name' => 'order', 'label' => 'Sıra', 'type' => 'number', 'col' => 4, 'default' => 1],
                    ['name' => 'duration', 'label' => 'Süre etiketi (ör. 1-2 HAFTA)', 'type' => 'text', 'col' => 6],
                    ['name' => 'icon', 'label' => 'İkon sınıfı (ör. icon-search-solid)', 'type' => 'text', 'col' => 6],
                    ['name' => 'content', 'label' => 'Açıklama', 'type' => 'textarea'],
                ],
            ],
        ];
    }

    public static function get(string $key): ?array
    {
        return static::all()[$key] ?? null;
    }
}
