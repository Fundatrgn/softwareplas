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
                <div class="ms-auto d-flex align-items-center gap-2">
                    <a href="?ay={{ $oncekiAy }}" class="btn btn-outline-secondary btn-sm">&larr; Önceki Ay</a>
                    <span class="fw-bold text-capitalize">{{ $ayBaslik }}</span>
                    <a href="?ay={{ $sonrakiAy }}" class="btn btn-outline-secondary btn-sm">Sonraki Ay &rarr;</a>
                </div>
            </div>

            <p class="text-muted small">Bu ekran, o ay için <strong>onaylanmış</strong> veya <strong>tamamlanmış</strong> randevulara göre hangi terapi odasının hangi gün/saatte dolu olduğunu gösteren bir <strong>taslak çalışma takvimidir</strong>. Sistem zaten aynı oda ve saat için ikinci bir randevu onaylanmasına izin vermez; bu sayfa sadece yönetici ve psikologların göz atıp karışıklığı önceden fark etmesi içindir.</p>

            @forelse($rooms as $room)
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">{{ $room->name }}</div>
                    <div class="card-body p-2">
                        <div class="oda-takvim-grid">
                            @foreach(['Pzt','Sal','Çar','Per','Cum','Cmt','Paz'] as $gun)
                                <div class="oda-takvim-baslik">{{ $gun }}</div>
                            @endforeach

                            @foreach($weeks as $hafta)
                                @foreach($hafta as $gun)
                                    @php
                                        $digerAy = $gun->format('Y-m') !== $buAy;
                                        $anahtar = $room->id . '_' . $gun->toDateString();
                                        $oGunRandevular = $appointmentsByRoomDay->get($anahtar, collect());
                                        $bugunMu = $gun->isToday();
                                    @endphp
                                    <div class="oda-takvim-gun {{ $digerAy ? 'diger-ay' : '' }} {{ $bugunMu ? 'bugun' : '' }}">
                                        <div class="oda-takvim-gun-no">{{ $gun->day }}</div>
                                        @foreach($oGunRandevular as $a)
                                            <div class="oda-takvim-slot" title="{{ $a->patient_name_snapshot ?? $a->patient?->name }}">
                                                {{ $a->starts_at->format('H:i') }}
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted py-3">Henüz aktif oda tanımlanmadı. Önce "Terapi Odaları" sayfasından oda ekleyin.</p>
            @endforelse
        </div>
    </div>

    <style>
        .oda-takvim-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 4px;
        }
        .oda-takvim-baslik {
            text-align: center;
            font-weight: 600;
            font-size: 12px;
            color: #888;
            padding: 4px 0;
        }
        .oda-takvim-gun {
            min-height: 80px;
            border: 1px dashed rgba(0,0,0,0.15);
            border-radius: 6px;
            padding: 4px;
            background: rgba(0,0,0,0.015);
        }
        .oda-takvim-gun.diger-ay {
            opacity: 0.35;
        }
        .oda-takvim-gun.bugun {
            border: 1px solid #5b8def;
            background: rgba(91,141,239,.08);
        }
        .oda-takvim-gun-no {
            font-size: 11px;
            font-weight: 600;
            color: #999;
            margin-bottom: 4px;
        }
        .oda-takvim-slot {
            font-size: 11px;
            background: #5b8def;
            color: #fff;
            border-radius: 4px;
            padding: 1px 4px;
            margin-bottom: 2px;
            display: inline-block;
            width: 100%;
            text-align: center;
        }
        @media (max-width: 767px) {
            .oda-takvim-grid { grid-template-columns: repeat(7, minmax(36px, 1fr)); font-size: 10px; }
            .oda-takvim-gun { min-height: 56px; padding: 2px; }
        }
    </style>
@endsection
