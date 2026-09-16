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
                                    <label for="bsValidation10" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="bsValidation10" name="address"
                                        placeholder="Address" required value="{{ $data->address ?? '' }}">
                                </div>
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

                                <div class="col-md-12">
                                    <label for="bsValidation5" class="form-label">Açıklama</label>
                                    <textarea type="text" class="form-control" id="editor" name="description" placeholder="Açıklama">{{ $data->description ?? '' }}</textarea>
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
