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
                            <form class="row g-3" action="/admin/slider/add" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                <div class="col-md-12">
                                    <div class="alert alert-info mb-0">Anasayfanın en üstündeki büyük giriş alanı. Sitede sadece <strong>sırası en küçük olan</strong> kayıt gösterilir; farklı dönemler için birden fazla kayıt hazırlayıp sırasını değiştirerek hangisinin yayında olacağını seçebilirsiniz.</div>
                                </div>
                                <div class="col-md-8">
                                    <label class="form-label">Üst Etiket (küçük rozet)</label>
                                    <input type="text" class="form-control" name="badge" placeholder="Web • Dijital Medya • İçerik" value="{{ old('badge', $data->badge ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sıra</label>
                                    <input type="number" class="form-control" name="sira" required value="{{ old('sira', $data->sira ?? 1) }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Başlık — 1. satır <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" required placeholder="Yunuscan ZEYBEK" value="{{ old('title', $data->title ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Başlık — 2. satır</label>
                                    <input type="text" class="form-control" name="title2" placeholder="Dijital Dünyada Değer Üretir" value="{{ old('title2', $data->title2 ?? '') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Açıklama</label>
                                    <textarea class="form-control" name="subtitle" rows="3">{{ old('subtitle', $data->subtitle ?? '') }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">1. Buton Yazısı</label>
                                    <input type="text" class="form-control" name="btn_text" placeholder="Projelerimi İncele" value="{{ old('btn_text', $data->btn_text ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">1. Buton Bağlantısı</label>
                                    <input type="text" class="form-control" name="btn_url" placeholder="/projeler" value="{{ old('btn_url', $data->btn_url ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">2. Buton Yazısı</label>
                                    <input type="text" class="form-control" name="btn2_text" placeholder="İletişime Geç" value="{{ old('btn2_text', $data->btn2_text ?? '') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">2. Buton Bağlantısı</label>
                                    <input type="text" class="form-control" name="btn2_url" placeholder="/iletisim" value="{{ old('btn2_url', $data->btn2_url ?? '') }}">
                                    <div class="form-text">Buton yazısı boş bırakılırsa buton görünmez.</div>
                                </div>
                                @if (! empty($data?->image))
                                    <div class="col-md-12">
                                        <label class="form-label">Mevcut Arka Plan Görseli</label><br>
                                        <img src="{{ asset('images/' . $data->image) }}" class="img-fluid rounded" style="max-height:160px" alt="">
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <label class="form-label">Arka Plan Görseli (isteğe bağlı)</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
                                    <div class="form-text">Boş bırakılırsa şablonun renkli degrade arka planı kullanılır.</div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
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
