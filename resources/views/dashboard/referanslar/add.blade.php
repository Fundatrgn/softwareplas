@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Referans Ekle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Referans</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form class="row g-3 needs-validation" action="/admin/referanslar/add" method="POST" validate
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Başlık</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="title"
                                        placeholder="Başlık" required value="{{ $data->title ?? '' }}">
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Kategori</label>
                                    <select name="kategori" id="" class="form-control">
                                        <option value="">Seçiniz</option>
                                        @foreach ($categories as $category)
                                        
                                            @if (isset($data) &&$category->id == $data->kategori )
                                                <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Konum</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="konum"
                                        placeholder="Konum" required value="{{ $data->konum ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Yazılım</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="yazilim"
                                        placeholder="Kullanılan Yazılım" required value="{{ $data->yazilim ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Müşteri</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="musteri"
                                        placeholder="Müşteri" required value="{{ $data->musteri ?? '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="bsValidation10" class="form-label">Sıra</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="order"
                                        placeholder="Sıra" required value="{{ $data->order ?? '' }}">
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
