@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Tüm Randevular</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/randevular">Randevu Takvimi</a></li>
                            <li class="breadcrumb-item active">Tüm Randevular</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto">
                    <a href="/admin/randevular/ekle" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon> Yeni Randevu</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="GET" action="/admin/randevular/liste" class="row g-2 mb-3">
                        <div class="col-md-4">
                            <input type="text" name="q" class="form-control" placeholder="İsim veya telefon ara..." value="{{ $filtreler['q'] ?? '' }}">
                        </div>
                        <div class="col-md-3">
                            <select name="durum" class="form-select">
                                <option value="">Tüm Durumlar</option>
                                @foreach(\App\Models\Appointment::STATUSES as $key => $label)
                                    <option value="{{ $key }}" {{ ($filtreler['durum'] ?? '') === $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <input type="date" name="tarih" class="form-control" value="{{ $filtreler['tarih'] ?? '' }}">
                        </div>
                        <div class="col-md-2 d-grid">
                            <button type="submit" class="btn btn-outline-primary">Filtrele</button>
                        </div>
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Tarih / Saat</th>
                                    <th>Danışan</th>
                                    <th>Telefon</th>
                                    <th>Hizmet</th>
                                    <th>Psikolog</th>
                                    <th>Durum</th>
                                    <th class="text-end">İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($appointments as $a)
                                    <tr>
                                        <td>{{ $a->starts_at->translatedFormat('d.m.Y H:i') }}</td>
                                        <td>{{ $a->patient_name_snapshot ?? $a->patient?->name ?? '—' }}</td>
                                        <td>{{ $a->patient_phone_snapshot ?? $a->patient?->phone ?? '—' }}</td>
                                        <td>{{ $a->service?->title ?? '—' }}</td>
                                        <td>{{ $a->psychologist?->name ?? '—' }}</td>
                                        <td><span class="badge bg-primary">{{ $a->statusLabel() }}</span></td>
                                        <td class="text-end">
                                            <a href="/admin/randevular/{{ $a->id }}" class="btn btn-sm btn-outline-secondary" title="Görüntüle"><ion-icon name="eye-outline"></ion-icon></a>
                                            <a href="/admin/randevular/{{ $a->id }}/duzenle" class="btn btn-sm btn-outline-primary" title="Düzenle"><ion-icon name="create-outline"></ion-icon></a>
                                            <form method="POST" action="/admin/randevular/{{ $a->id }}/sil" class="d-inline" onsubmit="return confirm('Bu randevuyu kalıcı olarak silmek istediğinize emin misiniz?');">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Sil"><ion-icon name="trash-outline"></ion-icon></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Kayıt bulunamadı.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $appointments->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
