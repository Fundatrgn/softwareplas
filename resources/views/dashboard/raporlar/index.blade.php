@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Raporlar</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active">Raporlar</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Bu Ay Randevu</div>
                        <h3 class="mb-0">{{ $buAyRandevuSayisi }}</h3>
                    </div></div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Bu Ay Tamamlanan</div>
                        <h3 class="mb-0 text-success">{{ $buAyTamamlanan }}</h3>
                    </div></div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Bu Ay Gelmedi</div>
                        <h3 class="mb-0 text-warning">{{ $buAyGelmedi }}</h3>
                    </div></div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="card"><div class="card-body">
                        <div class="text-muted small">Bu Ay İptal</div>
                        <h3 class="mb-0 text-danger">{{ $buAyIptal }}</h3>
                    </div></div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Genel Randevu Durumu Dağılımı ({{ $toplamRandevu }} randevu — tüm zamanlar)</h6>
                            <table class="table table-sm">
                                <thead><tr><th>Durum</th><th>Adet</th><th>Oran</th></tr></thead>
                                <tbody>
                                    @foreach($durumDagilimi as $d)
                                        <tr>
                                            <td>{{ $d['label'] }}</td>
                                            <td>{{ $d['adet'] }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-2">
                                                    <div class="progress flex-grow-1" style="height:16px">
                                                        <div class="progress-bar" style="width:{{ $d['yuzde'] }}%"></div>
                                                    </div>
                                                    <span class="small text-muted" style="min-width:42px">{{ $d['yuzde'] }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <p class="text-muted small mb-0">Toplam danışan: <strong>{{ $toplamDanisan }}</strong> · Bu ay yeni danışan: <strong>{{ $buAyYeniDanisan }}</strong></p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Son 6 Ay Trend</h6>
                            <table class="table table-sm">
                                <thead><tr><th>Ay</th><th>Toplam</th><th>Tamamlanan</th><th>Gelmedi</th><th>İptal</th></tr></thead>
                                <tbody>
                                    @foreach($aylikTrend as $ay)
                                        <tr>
                                            <td>{{ $ay['label'] }}</td>
                                            <td>{{ $ay['toplam'] }}</td>
                                            <td>{{ $ay['tamamlanan'] }}</td>
                                            <td>{{ $ay['gelmedi'] }}</td>
                                            <td>{{ $ay['iptal'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>En Çok Gelmeyen (No-Show) Danışanlar</h6>
                            <p class="text-muted small">{{ $esik }} veya daha fazla "gelmedi" kaydı olan danışanlar burada uyarı rozetiyle görünür; danışan detay sayfasında da aynı uyarı gösterilir.</p>
                            @if($noShowListesi->isEmpty())
                                <p class="text-muted mb-0">Henüz "gelmedi" kaydı yok.</p>
                            @else
                                <table class="table table-sm">
                                    <thead><tr><th>Danışan</th><th>Toplam Randevu</th><th>Gelmedi</th><th></th></tr></thead>
                                    <tbody>
                                        @foreach($noShowListesi as $p)
                                            <tr>
                                                <td><a href="/admin/danisanlar/{{ $p->id }}">{{ $p->name }}</a></td>
                                                <td>{{ $p->toplam_randevu }}</td>
                                                <td>{{ $p->gelmedi_sayisi }}</td>
                                                <td>
                                                    @if($p->gelmedi_sayisi >= $esik)
                                                        <span class="badge bg-danger">Uyarı</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
