@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Genel Ayarlar</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Genel Ayarlar </li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form class="row g-3 needs-validation" action="/admin/ayarlar/add" method="POST" validate
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                @isset($data)
                                    @if ($data->image)
                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Mevcut Logo</label>
                                            <br>
                                            <img src="{{ asset('images/' . $data->image) }}" class="img-fluid" alt="">
                                        </div>
                                    @endif
                                @endisset
                               
                                <div class="col-md-6">
                                    <label for="bsValidation4" class="form-label">Logo</label>
                                    <input type="file" class="form-control" id="bsValidation4" name="image">
                                </div>
                                @isset($data)
                                @if ($data->favicon)
                                    <div class="col-md-12">
                                        <label for="bsValidation4" class="form-label">Mevcut Favicon</label>
                                        <br>
                                        <img src="{{ asset('images/' . $data->favicon) }}" class="img-fluid" alt="">
                                    </div>
                                @endif
                            @endisset

                                <div class="col-md-6">
                                    <label for="bsValidation4" class="form-label">Favicon</label>
                                    <input type="file" class="form-control" id="bsValidation4" name="favicon">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation3" class="form-label">Site Başlığı</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="site_title"
                                        placeholder="Başlık" required value="{{ $data->site_title ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation3" class="form-label">Yazar</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="author"
                                        placeholder="Başlık" required value="{{ $data->author ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation3" class="form-label">Site Anahtar Kelimeler</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="keywords"
                                        placeholder="key1,key2,key3" required value="{{ $data->keywords ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Telefon</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="phone"
                                        placeholder="Telefon" required value="{{ $data->phone ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">email</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="email"
                                        placeholder="email" required value="{{ $data->email ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Adres</label>
                                    <input type="text" class="form-control" id="site-address-input" name="address"
                                        placeholder="Örn: Turgutlu, Manisa" required value="{{ $data->address ?? '' }}">
                                    <div class="form-text">Buraya yazdığınız adres, sitenizdeki İletişim ve Randevu sayfalarındaki haritayı da otomatik günceller. Yazdıkça aşağıdaki önizlemeden kontrol edebilirsiniz.</div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Harita Önizleme</label>
                                    <iframe id="site-address-map-preview" style="width:100%; height:250px; border:1px solid #ddd; border-radius:6px;"
                                        src="https://www.google.com/maps?q={{ urlencode($data->address ?? 'Manisa, Türkiye') }}&output=embed"></iframe>
                                </div>
                                <script>
                                (function() {
                                    var input = document.getElementById('site-address-input');
                                    var preview = document.getElementById('site-address-map-preview');
                                    var timer;
                                    if (input && preview) {
                                        input.addEventListener('input', function() {
                                            clearTimeout(timer);
                                            timer = setTimeout(function() {
                                                preview.src = 'https://www.google.com/maps?q=' + encodeURIComponent(input.value || 'Manisa, Türkiye') + '&output=embed';
                                            }, 600);
                                        });
                                    }
                                })();
                                </script>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Linkedin</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="linkedin"
                                        placeholder="Linkedin" required value="{{ $data->linkedin ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">İnstagram</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="instagram"
                                        placeholder="İnstagram" required value="{{ $data->instagram ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Youtube</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="youtube"
                                        placeholder="Youtube" required value="{{ $data->youtube ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Twitter</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="twitter"
                                        placeholder="Twitter" required value="{{ $data->twitter ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Facebook</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="facebook"
                                        placeholder="Facebook" required value="{{ $data->facebook ?? '' }}">
                                </div>

                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">WhatsApp Randevu Numarası</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="whatsapp_number"
                                        placeholder="90 5XX XXX XX XX" value="{{ $data->whatsapp_number ?? '' }}">
                                    <div class="form-text">Başında ülke kodu olacak şekilde, boşluksuz girin (örn: 905551112233). Sitedeki yeşil "Hızlı Randevu" butonu bu numaraya WhatsApp üzerinden yönlendirir.</div>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <hr>
                                    <h5 class="mb-1">Site Görünümü / Renkler</h5>
                                    <p class="text-muted mb-3">Aşağıdaki renkleri değiştirdiğinde sitedeki tüm ilgili butonlar, başlıklar ve yazılar otomatik olarak güncellenir. Herhangi bir kod bilgisi gerekmez.</p>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Hızlı Tema Seç</label>
                                    <div class="form-text mb-2">Bir temaya tıkla, aşağıdaki tüm renkler otomatik doldurulur — sonra "Kaydet"e bas.</div>
                                    <div class="d-flex flex-wrap gap-2" id="tema-presets">
                                        <button type="button" class="btn btn-sm" data-tema="turuncu"
                                            style="background:#1B1F1C; border:2px solid #D9784B; color:#D9784B; font-weight:600;">🟠 Turuncu (varsayılan)</button>
                                        <button type="button" class="btn btn-sm" data-tema="yesil"
                                            style="background:#1B1F1C; border:2px solid #6FA37F; color:#6FA37F; font-weight:600;">🟢 Yeşil</button>
                                        <button type="button" class="btn btn-sm" data-tema="mavi"
                                            style="background:#1B1F1C; border:2px solid #4F8FB0; color:#4F8FB0; font-weight:600;">🔵 Mavi</button>
                                        <button type="button" class="btn btn-sm" data-tema="mor"
                                            style="background:#1B1F1C; border:2px solid #A585C9; color:#A585C9; font-weight:600;">🟣 Mor</button>
                                        <button type="button" class="btn btn-sm" data-tema="acik"
                                            style="background:#F7F6F2; border:2px solid #D9784B; color:#8a5a3a; font-weight:600;">⚪ Açık Zemin</button>
                                    </div>
                                </div>

                                <script>
                                (function() {
                                    var temalar = {
                                        turuncu: { accent_color: '#D9784B', secondary_color: '#7FA36F', background_color: '#1B1F1C', heading_color: '#FFFFFF', body_text_color: '#E7E3D8' },
                                        yesil:   { accent_color: '#6FA37F', secondary_color: '#C9A46A', background_color: '#171C19', heading_color: '#FFFFFF', body_text_color: '#E3E7E1' },
                                        mavi:    { accent_color: '#4F8FB0', secondary_color: '#8FA888', background_color: '#161C22', heading_color: '#FFFFFF', body_text_color: '#DCE4E7' },
                                        mor:     { accent_color: '#A585C9', secondary_color: '#D9784B', background_color: '#1C1922', heading_color: '#FFFFFF', body_text_color: '#E5E1EA' },
                                        acik:    { accent_color: '#D9784B', secondary_color: '#7FA36F', background_color: '#F7F6F2', heading_color: '#1F2D30', body_text_color: '#4B5B57' }
                                    };
                                    document.querySelectorAll('#tema-presets button').forEach(function(btn) {
                                        btn.addEventListener('click', function() {
                                            var t = temalar[btn.getAttribute('data-tema')];
                                            if (!t) return;
                                            Object.keys(t).forEach(function(key) {
                                                var input = document.getElementById(key);
                                                if (input) input.value = t[key];
                                            });
                                        });
                                    });
                                })();
                                </script>

                                <div class="col-md-4 col-6">
                                    <label for="accent_color" class="form-label">Ana Marka Rengi</label>
                                    <input type="color" class="form-control form-control-color w-100" id="accent_color"
                                        name="accent_color" value="{{ $data->accent_color ?? '#D9784B' }}" title="Ana marka rengi">
                                    <div class="form-text">Butonlar, linkler, ikonlar</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label for="secondary_color" class="form-label">İkincil Renk</label>
                                    <input type="color" class="form-control form-control-color w-100" id="secondary_color"
                                        name="secondary_color" value="{{ $data->secondary_color ?? '#7FA36F' }}" title="İkincil renk">
                                    <div class="form-text">Vurgu detayları, ikon arka planları</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label for="background_color" class="form-label">Sayfa Arka Plan Rengi</label>
                                    <input type="color" class="form-control form-control-color w-100" id="background_color"
                                        name="background_color" value="{{ $data->background_color ?? '#1B1F1C' }}" title="Arka plan rengi">
                                    <div class="form-text">Bölüm arka planları</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label for="heading_color" class="form-label">Başlık Yazı Rengi</label>
                                    <input type="color" class="form-control form-control-color w-100" id="heading_color"
                                        name="heading_color" value="{{ $data->heading_color ?? '#FFFFFF' }}" title="Başlık rengi">
                                    <div class="form-text">Tüm başlıklar (H1-H6)</div>
                                </div>
                                <div class="col-md-4 col-6">
                                    <label for="body_text_color" class="form-label">Gövde Yazı Rengi</label>
                                    <input type="color" class="form-control form-control-color w-100" id="body_text_color"
                                        name="body_text_color" value="{{ $data->body_text_color ?? '#E7E3D8' }}" title="Metin rengi">
                                    <div class="form-text">Paragraf ve açıklama metinleri</div>
                                </div>

                                <div class="col-md-12">
                                    <label for="bsValidation5" class="form-label">Açıklama</label>
                                    <textarea type="text" class="form-control" id="editor" name="description" placeholder="Açıklama">{{ $data->description ?? '' }}</textarea>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <hr>
                                    <h5 class="mb-1">Menü Panelindeki Kısa Tanıtım</h5>
                                    <p class="text-muted mb-3">Masaüstünde sağ üstteki menü (☰) ikonuna tıklayınca açılan panelde "Hakkımda" başlığı altında gösterilen kısa metin. Arama motoru açıklamasından (yukarıdaki "Açıklama" alanı) bağımsızdır.</p>
                                    <textarea class="form-control" name="sidebar_bio" rows="3" placeholder="Kısa tanıtım metni">{{ $data->sidebar_bio ?? '' }}</textarea>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <hr>
                                    <h5 class="mb-1">KVKK Aydınlatma Metni</h5>
                                    <p class="text-muted mb-3">Randevu ve iletişim formlarındaki onay kutusuna tıklandığında açılan pencerede bu metin gösterilir. İstediğiniz gibi düzenleyebilirsiniz.</p>
                                    <textarea class="form-control" name="kvkk_text" rows="10" placeholder="KVKK Aydınlatma Metni">{{ $data->kvkk_text ?? '' }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Ekle</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
