@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Oda Doluluk Durumu</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/odalar">Terapi Odaları</a></li>
                            <li class="breadcrumb-item active">Doluluk Durumu</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <form method="GET" action="/admin/odalar/durum" class="d-flex gap-2 align-items-end">
                        <div>
                            <label class="form-label">Tarih</label>
                            <input type="date" class="form-control" name="tarih" value="{{ $tarih }}" onchange="this.form.submit()">
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Göster</button>
                    </form>
                </div>
            </div>

            <p class="text-muted small">Bu sayfa, seçili günde <strong>onaylanmış</strong> veya <strong>tamamlanmış</strong> randevulara göre hangi terapi odasının hangi saatte dolu olduğunu gösterir. Karışıklık olmaması için yeni bir randevu onaylarken burayı kontrol edebilirsiniz.</p>

            <div class="row">
                @forelse($rooms as $room)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header bg-primary text-white">{{ $room->name }}</div>
                            <div class="card-body">
                                @php $odaRandevulari = $appointments->get($room->id, collect()); @endphp
                                @forelse($odaRandevulari as $a)
                                    <div class="mb-2 pb-2 border-bottom">
                                        <strong>{{ $a->starts_at->format('H:i') }} - {{ $a->ends_at->format('H:i') }}</strong>
                                        <br>
                                        <span class="text-muted small">{{ $a->patient_name_snapshot ?? $a->patient?->name }}</span>
                                    </div>
                                @empty
                                    <p class="text-muted small mb-0">Bu gün için bu odada randevu yok.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <p class="text-center text-muted py-3">Henüz aktif oda tanımlanmadı. Önce "Terapi Odaları" sayfasından oda ekleyin.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
