@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Genel Bakış</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item active">Genel Bakış</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto d-flex gap-2">
                    <a href="/admin/raporlar" class="btn btn-outline-secondary">Detaylı Rapor</a>
                    <a href="/admin/randevular/ekle" class="btn btn-primary">+ Yeni Randevu</a>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Bugünkü Randevular</div>
                        <h3 class="mb-0">{{ $ozet['bugun'] }}</h3>
                    </div></div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Bu Hafta</div>
                        <h3 class="mb-0">{{ $ozet['bu_hafta'] }}</h3>
                    </div></div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Onay Bekleyen</div>
                        <h3 class="mb-0 text-warning">{{ $ozet['bekleyen_onay'] }}</h3>
                    </div></div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Toplam Danışan</div>
                        <h3 class="mb-0">{{ $ozet['toplam_danisan'] }}</h3>
                    </div></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Bugünün Randevu Programı — {{ \Illuminate\Support\Carbon::today()->translatedFormat('d F Y, l') }}</h6>
                            @if($bugunkuRandevular->isEmpty())
                                <p class="text-muted mb-0">Bugün için planlanmış randevu yok.</p>
                            @else
                                <table class="table table-sm">
                                    <thead><tr><th>Saat</th><th>Danışan</th><th>Görüşme Türü</th><th>Durum</th></tr></thead>
                                    <tbody>
                                        @foreach($bugunkuRandevular as $a)
                                            <tr>
                                                <td>{{ $a->starts_at->format('H:i') }}</td>
                                                <td><a href="/admin/randevular/{{ $a->id }}">{{ $a->patient_name_snapshot ?? $a->patient?->name }}</a></td>
                                                <td>{{ $a->service?->title ?? '—' }}</td>
                                                <td><span class="badge bg-primary">{{ $a->statusLabel() }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Dikkat Gerektiren Danışanlar</h6>
                            <p class="text-muted small">{{ \App\Http\Controllers\dashboard\ReportController::NO_SHOW_WARNING_THRESHOLD }}+ kez "gelmedi" kaydı olanlar.</p>
                            @if($noShowUyarilari->isEmpty())
                                <p class="text-muted mb-0">Şu an uyarı gerektiren danışan yok.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($noShowUyarilari as $p)
                                        <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                            <a href="/admin/danisanlar/{{ $p->id }}">{{ $p->name }}</a>
                                            <span class="badge bg-danger">{{ $p->gelmedi_sayisi }} kez gelmedi</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Bu Ay Tamamlanan Seanslar</h6>
                            <h2 class="text-success mb-0">{{ $ozet['bu_ay_tamamlanan'] }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
