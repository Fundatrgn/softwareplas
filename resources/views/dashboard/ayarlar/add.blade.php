@extends('dashboard.layout.template')
@section('content')
    @php
        $v = fn ($field, $default = '') => old($field, $data->{$field} ?? $default);
        $stats = old('stats', $data->stats ?? []);
        for ($i = count($stats); $i < 4; $i++) {
            $stats[] = ['label' => '', 'value' => '', 'suffix' => ''];
        }
        $images = [
            'image' => ['Logo (üst menü)', 'Koyu zemin üzerinde görünür; beyaz/açık renkli logo önerilir. Boşsa isminiz yazı olarak gösterilir.'],
            'logo_footer' => ['Logo (sayfa sonu)', 'Boşsa üstteki logo kullanılır.'],
            'favicon' => ['Favicon (tarayıcı sekmesi ikonu)', 'Kare, 64x64 veya 512x512 PNG/SVG önerilir.'],
            'profile_image' => ['Profil Fotoğrafı', 'Hakkımda sayfası ve Google\'daki kişi bilgisinde kullanılır. Dikey (portre) fotoğraf önerilir.'],
            'og_image' => ['Paylaşım Görseli (WhatsApp / sosyal medya önizlemesi)', '1200x630 boyutuna otomatik kırpılır.'],
        ];
    @endphp
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Site Ayarları</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Site Ayarları</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-10 mx-auto">
                    @if ($errors->any())
                        <div class="alert alert-danger">{{ $errors->first() }}</div>
                    @endif
                    <form action="/admin/ayarlar/add" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="card">
                            <div class="card-body p-4 row g-3">
                                <h5 class="mb-0">Kimlik & Google (SEO)</h5>
                                <p class="text-muted mb-0">"Yunuscan ZEYBEK kimdir" gibi aramalarda sitenizin doğru görünmesi için bu alanlar kullanılır.</p>
                                <div class="col-md-6">
                                    <label class="form-label">Site Başlığı <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="site_title" required value="{{ $v('site_title') }}">
                                    <div class="form-text">Tarayıcı sekmesinde ve Google sonuçlarında görünür.</div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Ad Soyad</label>
                                    <input type="text" class="form-control" name="author" value="{{ $v('author') }}">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Unvan / Meslek</label>
                                    <input type="text" class="form-control" name="job_title" value="{{ $v('job_title') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Site Açıklaması (meta description)</label>
                                    <textarea class="form-control" name="description" rows="2" maxlength="300">{{ $v('description') }}</textarea>
                                    <div class="form-text">Google sonuçlarında başlığın altında görünen 1-2 cümle (ideal: 150-160 karakter).</div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Anahtar Kelimeler (virgülle ayırın)</label>
                                    <input type="text" class="form-control" name="keywords" value="{{ $v('keywords') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Diğer Profil Bağlantıları (her satıra bir adres)</label>
                                    <textarea class="form-control" name="same_as" rows="3" placeholder="https://...">{{ $v('same_as') }}</textarea>
                                    <div class="form-text">Sosyal medya hesaplarınız otomatik eklenir. Buraya sizi anlatan diğer sayfaları (haber, yazar sayfası, şirket sayfası vb.) ekleyin; Google bu bağlantılarla sizi daha kolay tanır.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Google Search Console Doğrulama Kodu</label>
                                    <input type="text" class="form-control" name="google_verification" value="{{ $v('google_verification') }}" placeholder="google-site-verification içeriği">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Google Analytics Ölçüm Kimliği</label>
                                    <input type="text" class="form-control" name="analytics_id" value="{{ $v('analytics_id') }}" placeholder="G-XXXXXXXXXX">
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-4 row g-3">
                                <h5 class="mb-0">Görseller & Renk</h5>
                                @foreach ($images as $field => [$label, $help])
                                    <div class="col-md-6">
                                        <label class="form-label">{{ $label }}</label>
                                        <input type="file" class="form-control" name="{{ $field }}" accept="image/*">
                                        <div class="form-text">{{ $help }}</div>
                                        @if ($data->{$field})
                                            <div class="mt-2 d-flex align-items-center gap-3 p-2 rounded" style="background:#18181b">
                                                <img src="{{ asset('images/' . $data->{$field}) }}" alt="" style="max-height:70px;max-width:180px">
                                                <div class="form-check text-white">
                                                    <input class="form-check-input" type="checkbox" name="{{ $field }}_remove" value="1" id="rm-{{ $field }}">
                                                    <label class="form-check-label" for="rm-{{ $field }}">Kaldır</label>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                                <div class="col-md-6">
                                    <label class="form-label">Ana Marka Rengi</label>
                                    <div class="d-flex gap-2 align-items-center">
                                        <input type="color" class="form-control form-control-color" name="accent_color" value="{{ $v('accent_color', '#FD3A25') }}">
                                        <span class="text-muted small">Butonlar, vurgular ve ikonlarda kullanılır. Şablonun orijinal rengi: #FD3A25</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-4 row g-3">
                                <h5 class="mb-0">İletişim</h5>
                                <div class="col-md-6">
                                    <label class="form-label">E-posta</label>
                                    <input type="email" class="form-control" name="email" value="{{ $v('email') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telefon</label>
                                    <input type="text" class="form-control" name="phone" value="{{ $v('phone') }}">
                                    <div class="form-text">Boş bırakılırsa sitede telefon gösterilmez.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">WhatsApp Numarası</label>
                                    <input type="text" class="form-control" name="whatsapp_number" value="{{ $v('whatsapp_number') }}" placeholder="905xxxxxxxxx">
                                    <div class="form-text">Doluysa sitenin köşesinde WhatsApp butonu görünür.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Konum (kısa)</label>
                                    <input type="text" class="form-control" name="location_text" value="{{ $v('location_text') }}" placeholder="Manisa, Türkiye">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Durum Yazısı</label>
                                    <input type="text" class="form-control" name="availability_text" value="{{ $v('availability_text') }}" placeholder="Yeni projeler için müsaitim">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Açık Adres (isteğe bağlı)</label>
                                    <input type="text" class="form-control" name="address" value="{{ $v('address') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Google Harita Yerleştirme Adresi (isteğe bağlı)</label>
                                    <input type="text" class="form-control" name="map_embed" value="{{ $v('map_embed') }}" placeholder="https://www.google.com/maps/embed?pb=...">
                                    <div class="form-text">Google Haritalar &gt; Paylaş &gt; Harita yerleştir &gt; koddaki src="..." adresini yapıştırın. Boşsa İletişim sayfasında harita gösterilmez.</div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-4 row g-3">
                                <h5 class="mb-0">Sosyal Medya</h5>
                                @foreach (['instagram' => 'Instagram', 'facebook' => 'Facebook', 'linkedin' => 'LinkedIn', 'twitter' => 'X / Twitter', 'youtube' => 'YouTube', 'github' => 'GitHub'] as $field => $label)
                                    <div class="col-md-6">
                                        <label class="form-label">{{ $label }}</label>
                                        <input type="url" class="form-control" name="{{ $field }}" value="{{ $v($field) }}" placeholder="https://">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-4 row g-3">
                                <h5 class="mb-0">Anasayfa: Alıntı Kutusu & İstatistikler</h5>
                                <div class="col-md-12">
                                    <label class="form-label">Alıntı / Motto</label>
                                    <textarea class="form-control" name="quote_text" rows="2">{{ $v('quote_text') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alıntı Sahibi</label>
                                    <input type="text" class="form-control" name="quote_author" value="{{ $v('quote_author') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Alıntı Sahibi Unvanı</label>
                                    <input type="text" class="form-control" name="quote_role" value="{{ $v('quote_role') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label mb-1">İstatistikler</label>
                                    <div class="form-text mb-2">Etiket ve sayı dolu olan satırlar sitede gösterilir (ör. "Tamamlanan Proje" / 25 / +).</div>
                                    @foreach ($stats as $i => $row)
                                        <div class="row g-2 mb-2">
                                            <div class="col-6"><input type="text" class="form-control" name="stats[{{ $i }}][label]" value="{{ $row['label'] ?? '' }}" placeholder="Etiket"></div>
                                            <div class="col-3"><input type="text" class="form-control" name="stats[{{ $i }}][value]" value="{{ $row['value'] ?? '' }}" placeholder="Sayı"></div>
                                            <div class="col-3"><input type="text" class="form-control" name="stats[{{ $i }}][suffix]" value="{{ $row['suffix'] ?? '' }}" placeholder="Ek (+, %, K)"></div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body p-4 row g-3">
                                <h5 class="mb-0">Sayfa Sonu & KVKK</h5>
                                <div class="col-md-6">
                                    <label class="form-label">Sayfa Sonu Başlığı</label>
                                    <input type="text" class="form-control" name="footer_title" value="{{ $v('footer_title') }}" placeholder="Sosyal medyada bağlantıda kalalım">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Telif Yazısı</label>
                                    <input type="text" class="form-control" name="footer_copyright_text" value="{{ $v('footer_copyright_text') }}" placeholder="Yunuscan ZEYBEK - Tüm Hakları Saklıdır">
                                    <div class="form-text">Başına "© {{ date('Y') }}" otomatik eklenir.</div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">KVKK Aydınlatma Metni</label>
                                    <textarea class="form-control js-editor" id="editor" name="kvkk_text">{{ $v('kvkk_text') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-5 mb-4">Ayarları Kaydet</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
