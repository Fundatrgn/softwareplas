@extends('dashboard.layout.template')
@section('content')
    @php
        $mevcutUrl = $data->url ?? '';
        $mevcutSayfaMi = $mevcutUrl === '' || array_key_exists($mevcutUrl, $sayfaSecenekleri);
    @endphp
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Sayfa Sonu Bağlantısı</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/footer-menu">Sayfa Sonu</a></li>
                            <li class="breadcrumb-item active">{{ isset($data) ? 'Düzenle' : 'Yeni Bağlantı' }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form method="POST" action="/admin/footer-menu/add" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                <div class="col-md-8">
                                    <label class="form-label">Bağlantı Metni *</label>
                                    <input type="text" class="form-control" name="title" required
                                        placeholder="Örn: Hakkımızda" value="{{ old('title', $data->title ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sıra</label>
                                    <input type="number" class="form-control" name="order" min="0" value="{{ old('order', $data->order ?? 0) }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Nereye Gitsin?</label>
                                    <div class="d-flex gap-3 mb-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="url_tipi" id="url_tipi_sayfa" value="sayfa" {{ $mevcutSayfaMi ? 'checked' : '' }}>
                                            <label class="form-check-label" for="url_tipi_sayfa">Sitedeki bir sayfa</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="url_tipi" id="url_tipi_ozel" value="ozel" {{ $mevcutSayfaMi ? '' : 'checked' }}>
                                            <label class="form-check-label" for="url_tipi_ozel">Özel bağlantı (URL)</label>
                                        </div>
                                    </div>
                                    <select class="form-select mb-2" name="sayfa" id="sayfa-secim">
                                        <option value="">Seçiniz...</option>
                                        @foreach($sayfaSecenekleri as $url => $label)
                                            <option value="{{ $url }}" {{ ($mevcutSayfaMi && $mevcutUrl === $url) ? 'selected' : '' }}>{{ $label }}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" class="form-control" name="ozel_url" id="ozel-url-input"
                                        placeholder="https://... veya /ozel-sayfa" value="{{ $mevcutSayfaMi ? '' : $mevcutUrl }}">
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                    <a href="/admin/footer-menu" class="btn btn-outline-secondary px-4">Vazgeç</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        var radios = document.querySelectorAll('input[name="url_tipi"]');
        var sayfaSecim = document.getElementById('sayfa-secim');
        var ozelInput = document.getElementById('ozel-url-input');

        function guncelle() {
            var secilenTip = document.querySelector('input[name="url_tipi"]:checked').value;
            sayfaSecim.style.display = secilenTip === 'sayfa' ? 'block' : 'none';
            ozelInput.style.display = secilenTip === 'ozel' ? 'block' : 'none';
        }

        radios.forEach(function (r) { r.addEventListener('change', guncelle); });
        guncelle();
    })();
    </script>
@endsection
