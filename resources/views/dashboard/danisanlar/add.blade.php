@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ isset($data) ? 'Danışanı Düzenle' : 'Yeni Danışan' }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/danisanlar">Danışanlar</a></li>
                            <li class="breadcrumb-item active">{{ isset($data) ? 'Düzenle' : 'Yeni' }}</li>
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

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/admin/danisanlar/add">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data->id ?? '' }}">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Ad Soyad *</label>
                                <input type="text" class="form-control" name="name" required value="{{ old('name', $data->name ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefon *</label>
                                <input type="text" class="form-control" name="phone" required value="{{ old('phone', $data->phone ?? '') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-posta</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $data->email ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Doğum Tarihi</label>
                                <input type="date" class="form-control" name="birth_date" value="{{ old('birth_date', $data->birth_date?->toDateString() ?? '') }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Cinsiyet</label>
                                <select class="form-select" name="gender">
                                    <option value="">Belirtilmedi</option>
                                    <option value="kadin" {{ (old('gender', $data->gender ?? '') == 'kadin') ? 'selected' : '' }}>Kadın</option>
                                    <option value="erkek" {{ (old('gender', $data->gender ?? '') == 'erkek') ? 'selected' : '' }}>Erkek</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Genel Not</label>
                                <textarea class="form-control" name="notes" rows="4">{{ old('notes', $data->notes ?? '') }}</textarea>
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
