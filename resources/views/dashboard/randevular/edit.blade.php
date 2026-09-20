@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Randevuyu Düzenle</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/randevular/liste">Tüm Randevular</a></li>
                            <li class="breadcrumb-item active">#{{ $appointment->id }}</li>
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
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="/admin/randevular/{{ $appointment->id }}/guncelle">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Ad Soyad *</label>
                                <input type="text" class="form-control" name="name" required
                                    value="{{ old('name', $appointment->patient_name_snapshot ?? $appointment->patient?->name) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefon *</label>
                                <input type="text" class="form-control" name="phone" required
                                    value="{{ old('phone', $appointment->patient_phone_snapshot ?? $appointment->patient?->phone) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-posta</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $appointment->patient_email_snapshot ?? $appointment->patient?->email) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Görüşme Türü</label>
                                <select class="form-select" name="service_id">
                                    <option value="">Seçiniz...</option>
                                    @foreach($hizmetler as $hizmet)
                                        <option value="{{ $hizmet->id }}" {{ old('service_id', $appointment->service_id) == $hizmet->id ? 'selected' : '' }}>{{ $hizmet->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Tarih *</label>
                                <input type="date" class="form-control" name="tarih" required value="{{ old('tarih', $appointment->starts_at->toDateString()) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Saat *</label>
                                <input type="time" class="form-control" name="saat" required value="{{ old('saat', $appointment->starts_at->format('H:i')) }}" step="300">
                                <div class="form-text">İstediğiniz saati serbestçe girebilirsiniz; sabit bir saat listesiyle sınırlı değildir.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Süre (dakika) *</label>
                                <input type="number" class="form-control" name="sure" required min="10" max="240" step="5" value="{{ old('sure', $appointment->duration_minutes) }}">
                            </div>

                            @if(count($psikologlar))
                            <div class="col-md-6">
                                <label class="form-label">Psikolog / Personel</label>
                                <select class="form-select" name="user_id">
                                    <option value="">Belirtilmedi</option>
                                    @foreach($psikologlar as $p)
                                        <option value="{{ $p->id }}" {{ old('user_id', $appointment->user_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="col-md-12">
                                <label class="form-label">Not (opsiyonel)</label>
                                <textarea class="form-control" name="not" rows="3">{{ old('not', $appointment->request_note) }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary px-4">Değişiklikleri Kaydet</button>
                                <a href="/admin/randevular/{{ $appointment->id }}" class="btn btn-outline-secondary px-4">Vazgeç</a>
                                <form method="POST" action="/admin/randevular/{{ $appointment->id }}/sil" class="d-inline" onsubmit="return confirm('Bu randevuyu kalıcı olarak silmek istediğinize emin misiniz?');">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger px-4">Randevuyu Sil</button>
                                </form>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
