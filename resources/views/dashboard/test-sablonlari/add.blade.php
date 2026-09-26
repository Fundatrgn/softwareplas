@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Test Şablonu</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/test-sablonlari">Test Şablonları</a></li>
                            <li class="breadcrumb-item active">{{ isset($data) ? 'Düzenle' : 'Yeni Test' }}</li>
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
                <div class="col-xl-8 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form method="POST" action="/admin/test-sablonlari/add" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                <div class="col-md-12">
                                    <label class="form-label">Test Adı *</label>
                                    <input type="text" class="form-control" name="name" required
                                        placeholder="Örn: Aile İçi İletişim Anketi" value="{{ old('name', $data->name ?? '') }}">
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label">Açıklama</label>
                                    <textarea class="form-control" name="description" rows="2" placeholder="Danışana testin başında gösterilecek kısa açıklama">{{ old('description', $data->description ?? '') }}</textarea>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Kaydet ve Sorulara Geç</button>
                                    <a href="/admin/test-sablonlari" class="btn btn-outline-secondary px-4">Vazgeç</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
