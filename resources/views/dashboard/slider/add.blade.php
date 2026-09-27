@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Slider Ekle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Slider</li>
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
                            <form class="row g-3 needs-validation" action="/admin/slider/add" method="POST" validate
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                @php $displayType = old('display_type', $data->display_type ?? 'normal'); @endphp
                                <div class="col-md-12">
                                    <label class="form-label">Kullanım Tipi</label>
                                    <div class="d-flex gap-3">
                                        <div class="form-check">
                                            <input class="form-check-input slider-display-type-input" type="radio" name="display_type" id="display_type_normal" value="normal" {{ $displayType == 'normal' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="display_type_normal">Normal (Metin + Görsel)</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input slider-display-type-input" type="radio" name="display_type" id="display_type_tam" value="tam" {{ $displayType == 'tam' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="display_type_tam">Tam Boyut (Boydan Boya Görsel)</label>
                                        </div>
                                    </div>
                                    <div class="form-text">"Tam Boyut" seçilirse görsel tüm slayt alanını kaplar; başlık/açıklama/buton isteğe bağlı olarak görselin üzerinde görünür.</div>
                                </div>

                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Başlık</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="title"
                                        placeholder="Başlık" required value="{{ $data->title ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Alt Başlık (Açıklama)</label>
                                    <textarea class="form-control" name="subtitle" placeholder="Kısa, sakinleştirici bir açıklama cümlesi">{{ $data->subtitle ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation3" class="form-label">Buton Yazısı</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="btn_text"
                                        placeholder="Randevu Al" value="{{ $data->btn_text ?? '' }}">
                                    <div class="form-text">Boş bırakılırsa buton görünmez. Buton "İletişim" sayfasına yönlendirir.</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Sıra</label>
                                    <input type="number" class="form-control" id="bsValidation10" name="sira"
                                        placeholder="sira" required value="{{ $data->sira ?? '' }}">
                                </div>

                                <div class="col-md-12 slider-normal-only">
                                    <label class="form-label">Yazı Konumu</label>
                                    <div class="d-flex gap-3">
                                        @php $secilen = old('text_position', $data->text_position ?? 'orta'); @endphp
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="text_position" id="text_position_sol" value="sol" {{ $secilen == 'sol' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="text_position_sol">Sol</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="text_position" id="text_position_orta" value="orta" {{ $secilen == 'orta' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="text_position_orta">Orta</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="text_position" id="text_position_sag" value="sag" {{ $secilen == 'sag' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="text_position_sag">Sağ</label>
                                        </div>
                                    </div>
                                    <div class="form-text">Görsele göre başlık/açıklama/buton metninin sola, ortaya ya da sağa yaslanmasını seçin. Metin hangi tarafa yaslanırsa görsel otomatik olarak karşı tarafta kalır.</div>
                                </div>
                                @isset($data)
                                    @if ($data->image)
                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Mevcut Görsel (Masaüstü)</label>
                                            <br>
                                            <img src="{{ asset('images/' . $data->image) }}" class="img-fluid" alt="" style="max-height:220px;">
                                        </div>
                                    @endif
                                    @if ($data->image_mobile)
                                        <div class="col-md-12 slider-tam-only">
                                            <label class="form-label">Mevcut Görsel (Mobil)</label>
                                            <br>
                                            <img src="{{ asset('images/' . $data->image_mobile) }}" class="img-fluid" alt="" style="max-height:220px;">
                                        </div>
                                    @endif
                                @endisset

                                <div class="col-md-12">
                                    <label for="bsValidation4" class="form-label slider-normal-only d-none">Görsel</label>
                                    <label for="bsValidation4" class="form-label slider-tam-only d-none">Masaüstü Görseli</label>
                                    <input type="file" class="form-control" id="bsValidation4" name="image">
                                    <div class="form-text slider-normal-only">Tercihen 5MB'ın altında bir görsel seçin (telefon kamerasından direkt yüklenen büyük fotoğraflar sorun çıkarabilir).</div>
                                    <div class="form-text slider-tam-only d-none">Tam boyut modunda önerilen ölçü: en az <strong>1920×900px</strong>, yatay/geniş format. Dosya tercihen 5MB altında olsun.</div>
                                </div>
                                <div class="col-md-12 slider-tam-only d-none">
                                    <label for="bsValidation4mobile" class="form-label">Mobil Görseli</label>
                                    <input type="file" class="form-control" id="bsValidation4mobile" name="image_mobile">
                                    <div class="form-text">Boş bırakılırsa mobilde masaüstü görseli kullanılır. Önerilen ölçü: en az <strong>750×1000px</strong>, dikey/kare format. Dosya tercihen 5MB altında olsun.</div>
                                </div>
                                <div class="col-md-12">
                                    <div class="d-md-flex d-grid align-items-center gap-3">
                                        <button type="submit" class="btn btn-primary px-4">Ekle</button>
                                    </div>
                                </div>

                            </form>
                            <script>
                            (function () {
                                var radios = document.querySelectorAll('.slider-display-type-input');
                                var normalOnly = document.querySelectorAll('.slider-normal-only');
                                var tamOnly = document.querySelectorAll('.slider-tam-only');
                                function refresh() {
                                    var tamSecili = document.getElementById('display_type_tam').checked;
                                    normalOnly.forEach(function (el) { el.classList.toggle('d-none', tamSecili); });
                                    tamOnly.forEach(function (el) { el.classList.toggle('d-none', !tamSecili); });
                                }
                                radios.forEach(function (r) { r.addEventListener('change', refresh); });
                                refresh();
                            })();
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
@endsection
