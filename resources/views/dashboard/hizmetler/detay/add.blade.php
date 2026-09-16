@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Hizmet Detay Ekle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Hizmet Detay</li>
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
                            <form class="row g-3 needs-validation" action="/admin/hizmetler/detay/add" method="POST" validate
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                <input type="hidden" name="service_id" value="{{ $service_id ?? '' }}">
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Başlık</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="title"
                                        placeholder="Başlık" required value="{{ $data->title ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Üst Başlık (opsiyonel)</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="subtitle"
                                        placeholder="Örn: TERAPİ SÜRECİ" value="{{ $data->subtitle ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Anahtar Kelimeler</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="keywords"
                                        placeholder="anahtar1,anahtar2,anahtar3" required value="{{ $data->keywords ?? '' }}">
                                </div>
                                @isset($data)
                                    @if ($data->image)
                                        <div class="col-md-12">
                                            <label for="bsValidation4" class="form-label">Mevcut Görsel</label>
                                          <br>
                                            <img src="{{ asset('images/' . $data->image) }}" class="img-fluid" alt="">
                                        </div>
                                    @endif
                                @endisset

                                <div class="col-md-12">
                                    <label for="bsValidation4" class="form-label">Görsel</label>
                                    <input type="file" class="form-control" id="bsValidation4" name="image">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation5" class="form-label">Sıra</label>
                                    <input type="number" class="form-control" id="bsValidation5" name="position"
                                        placeholder="Sıra" required value="{{ $data->position ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation5" class="form-label">Açıklama</label>
                                    <textarea type="text" class="form-control" id="editor" name="content" placeholder="Açıklama">{{ $data->content ?? '' }}</textarea>
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
