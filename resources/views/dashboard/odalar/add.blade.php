@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Terapi Odası</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/odalar">Terapi Odaları</a></li>
                            <li class="breadcrumb-item active">{{ isset($data) ? 'Düzenle' : 'Yeni Oda' }}</li>
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
                <div class="col-xl-6 mx-auto">
                    <div class="card">
                        <div class="card-body p-4">
                            <form method="POST" action="/admin/odalar/add" class="row g-3">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data->id ?? '' }}">

                                <div class="col-md-12">
                                    <label class="form-label">Oda Adı *</label>
                                    <input type="text" class="form-control" name="name" required
                                        placeholder="Örn: Terapi Odası 1" value="{{ old('name', $data->name ?? '') }}">
                                </div>

                                <div class="col-md-12">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" role="switch" name="is_active" value="1" id="is_active"
                                            {{ old('is_active', $data->is_active ?? true) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Aktif (randevu onaylarken seçilebilir)</label>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                                    <a href="/admin/odalar" class="btn btn-outline-secondary px-4">Vazgeç</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
