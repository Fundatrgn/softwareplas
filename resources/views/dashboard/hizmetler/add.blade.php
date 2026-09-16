@extends('dashboard.layout.template')
@section('content')
    <!-- start page content wrapper-->
    <div class="page-content-wrapper">
        <!-- start page content-->
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Hizmet Ekle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Hizmet</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <div class="btn-group">
                        <a href="/admin/hizmetler/detay/{{ $data->id ?? '' }}" class="btn btn-outline-primary">Sayfa
                            Düzenini Güncelle</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <form class="row g-3 needs-validation" action="/admin/hizmetler/add" method="POST" validate
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                <div class="col-md-12">
                                    <label for="bsValidation3" class="form-label">Başlık</label>
                                    <input type="text" class="form-control" id="bsValidation3" name="title"
                                        placeholder="Başlık" required value="{{ $data->title ?? '' }}">
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
                                    <label for="bsValidation3" class="form-label">Kategori</label>
                                    <select name="category_id" id="" class="form-control">
                                        <option value="">Seçiniz</option>
                                        @foreach ($categories as $category)
                                            @isset($data)
                                                @if ($data->category_id == $category->id)
                                                    <option value="{{ $category->id }}" selected>{{ $category->title }}</option>
                                                @else
                                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                                @endif
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                                            @endisset
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label for="bsValidation5" class="form-label">Sıra</label>
                                    <input type="number" class="form-control" id="bsValidation5" name="order"
                                        placeholder="Sıra" required value="{{ $data->order ?? '' }}">
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
