@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Kurumsal Sayfa</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/sayfalar">Kurumsal Sayfalar</a></li>
                            <li class="breadcrumb-item active">{{ isset($data) ? 'Düzenle' : 'Yeni Sayfa' }}</li>
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
                            <form method="POST" action="/admin/sayfalar/add" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                <div class="col-md-8">
                                    <label class="form-label">Sayfa Başlığı *</label>
                                    <input type="text" class="form-control" name="title" required
                                        placeholder="Örn: Vizyonumuz" value="{{ old('title', $data->title ?? '') }}">
                                    @isset($data)
                                        <div class="form-text">Adres: /kurumsal/{{ $data->slug }}</div>
                                    @endisset
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Menüdeki Sırası</label>
                                    <input type="number" class="form-control" name="order" min="0" value="{{ old('order', $data->order ?? 0) }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">İçerik</label>
                                    <textarea class="form-control" id="editor" name="content" placeholder="Sayfa içeriği">{{ old('content', $data->content ?? '') }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                    <a href="/admin/sayfalar" class="btn btn-outline-secondary px-4">Vazgeç</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
