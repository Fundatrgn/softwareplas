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
                            <form class="row g-3" action="/admin/hizmetler/add" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                                <div class="col-md-8">
                                    <label class="form-label">Hizmet Adı <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="title" required value="{{ old('title', $data->title ?? '') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Sıra</label>
                                    <input type="number" class="form-control" name="order" value="{{ old('order', $data->order ?? 1) }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Kategori</label>
                                    <select name="category_id" class="form-control">
                                        <option value="">Seçiniz</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" @selected(isset($data) && $category->id == $data->category_id)>{{ $category->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Kısa Açıklama</label>
                                    <textarea class="form-control" name="summary" rows="3">{{ old('summary', $data->summary ?? '') }}</textarea>
                                    <div class="form-text">Anasayfa ve Hizmetler listesinde görünen 1-2 cümlelik özet.</div>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Etiketler (virgülle ayırın)</label>
                                    <input type="text" class="form-control" name="tags" placeholder="Laravel, Yönetim Paneli, SEO" value="{{ old('tags', $data->tags ?? '') }}">
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label">Detay İçeriği</label>
                                    <textarea class="form-control js-editor" id="editor" name="content">{{ old('content', $data->content ?? '') }}</textarea>
                                </div>
                                @if (! empty($data?->image))
                                    <div class="col-md-12">
                                        <label class="form-label">Mevcut Görsel</label><br>
                                        <img src="{{ asset('images/' . $data->image) }}" class="img-fluid rounded" style="max-height:140px" alt="">
                                    </div>
                                @endif
                                <div class="col-md-12">
                                    <label class="form-label">Görsel</label>
                                    <input type="file" class="form-control" name="image" accept="image/*">
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
