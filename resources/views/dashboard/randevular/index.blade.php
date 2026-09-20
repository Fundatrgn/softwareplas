@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Randevu Takvimi</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">Randevu Takvimi</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto d-flex gap-2">
                    <a href="/admin/randevular/liste" class="btn btn-outline-secondary"><ion-icon name="list-outline"></ion-icon> Tüm Randevular</a>
                    <a href="/admin/randevular/ekle" class="btn btn-primary"><ion-icon name="add-outline"></ion-icon> Yeni Randevu</a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="ay-once">‹ Önceki</button>
                                <h5 class="mb-0" id="ay-baslik">&nbsp;</h5>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="ay-sonra">Sonraki ›</button>
                            </div>
                            <div class="crm-takvim-grid crm-takvim-baslik">
                                @foreach(['Pzt','Sal','Çar','Per','Cum','Cmt','Paz'] as $g)
                                    <div class="text-center text-muted small fw-bold">{{ $g }}</div>
                                @endforeach
                            </div>
                            <div class="crm-takvim-grid" id="takvim-grid"></div>

                            <div class="d-flex flex-wrap gap-3 mt-3 small text-muted">
                                <span><i class="crm-legend-dot" style="background:#5b8def"></i> Müsait yer var</span>
                                <span><i class="crm-legend-dot" style="background:#e35d6a"></i> Tamamen dolu</span>
                                <span><i class="crm-legend-dot" style="background:#c9c9c9"></i> Kapalı / Geçmiş</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6 id="secili-gun-baslik">Bir gün seçin</h6>
                            <div id="gun-detay">
                                <p class="text-muted">Detayları görmek için takvimden bir gün seçin.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .crm-takvim-grid { display: grid; grid-template-columns: repeat(7, 1fr); gap: 6px; }
        .crm-takvim-baslik { margin-bottom: 6px; }
        .crm-gun {
            aspect-ratio: 1; display:flex; flex-direction:column; align-items:center; justify-content:center;
            border-radius:8px; cursor:pointer; border:1px solid transparent; font-weight:600; background:rgba(91,141,239,.08);
        }
        .crm-gun.bos { visibility:hidden; }
        .crm-gun .crm-gun-sayi { font-size:14px; }
        .crm-gun .crm-gun-durum { font-size:10px; font-weight:400; }
        .crm-gun.musait:hover, .crm-gun.secili { border-color:#5b8def; }
        .crm-gun.dolu { background:rgba(227,93,106,.12); color:#e35d6a; }
        .crm-gun.kapali, .crm-gun.gecmis { background:transparent; color:#aaa; cursor:not-allowed; }
        .crm-legend-dot { display:inline-block; width:10px; height:10px; border-radius:50%; margin-right:4px; }
        .crm-slot-row { display:flex; align-items:center; justify-content:space-between; padding:8px 10px; border-radius:6px; margin-bottom:6px; }
        .crm-slot-row.dolu { background:rgba(227,93,106,.08); }
        .crm-slot-row.bos { background:rgba(91,141,239,.06); }
    </style>

    <script>
    (function () {
        var ayBaslik = document.getElementById('ay-baslik');
        var takvimGrid = document.getElementById('takvim-grid');
        var gunDetay = document.getElementById('gun-detay');
        var seciliGunBaslik = document.getElementById('secili-gun-baslik');

        var aylar = ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'];
        var bugun = new Date();
        var goruntulenenAy = new Date(bugun.getFullYear(), bugun.getMonth(), 1);

        function ayAnahtari(d) { return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0'); }

        function ayiYukle() {
            ayBaslik.textContent = aylar[goruntulenenAy.getMonth()] + ' ' + goruntulenenAy.getFullYear();
            fetch('/admin/randevular/ay?ay=' + ayAnahtari(goruntulenenAy))
                .then(function (r) { return r.json(); })
                .then(function (data) { gunleriCiz(data.days); });
        }

        function gunleriCiz(days) {
            takvimGrid.innerHTML = '';
            if (!days.length) return;
            var ilk = new Date(days[0].date + 'T00:00:00');
            var bosluk = (ilk.getDay() + 6) % 7;
            for (var i = 0; i < bosluk; i++) {
                var b = document.createElement('div');
                b.className = 'crm-gun bos';
                takvimGrid.appendChild(b);
            }
            days.forEach(function (gun) {
                var el = document.createElement('div');
                var gunNo = parseInt(gun.date.split('-')[2], 10);

                var durum = 'musait';
                if (gun.past || gun.closed) durum = gun.past ? 'gecmis' : 'kapali';
                else if (gun.full) durum = 'dolu';

                el.className = 'crm-gun ' + durum;
                var altYazi = durum === 'musait' ? (gun.booked_count + '/' + gun.total_slots)
                    : (durum === 'dolu' ? 'Dolu' : (durum === 'kapali' ? 'Kapalı' : ''));
                el.innerHTML = '<span class="crm-gun-sayi">' + gunNo + '</span><span class="crm-gun-durum">' + altYazi + '</span>';
                el.addEventListener('click', function () { gunSec(gun.date, el); });
                takvimGrid.appendChild(el);
            });
        }

        function gunSec(tarih, el) {
            document.querySelectorAll('.crm-gun.secili').forEach(function (n) { n.classList.remove('secili'); });
            el.classList.add('secili');

            var tarihObj = new Date(tarih + 'T00:00:00');
            seciliGunBaslik.textContent = tarihObj.toLocaleDateString('tr-TR', { day:'numeric', month:'long', year:'numeric', weekday:'long' });
            gunDetay.innerHTML = '<p class="text-muted">Yükleniyor...</p>';

            fetch('/admin/randevular/gun?tarih=' + tarih)
                .then(function (r) { return r.json(); })
                .then(function (data) { detayCiz(tarih, data); });
        }

        function detayCiz(tarih, data) {
            if (data.closed) {
                gunDetay.innerHTML = '<p class="text-muted">Bu gün klinik kapalı.</p>';
                return;
            }
            if (!data.slots.length) {
                gunDetay.innerHTML = '<p class="text-muted">Bu gün için tanımlı saat aralığı yok.</p>';
                return;
            }

            var html = '';
            data.slots.forEach(function (slot) {
                if (slot.appointment) {
                    html += '<a href="/admin/randevular/' + slot.appointment.id + '" class="crm-slot-row dolu text-decoration-none text-reset d-block">'
                        + '<strong>' + slot.time + '</strong> — ' + (slot.appointment.patient_name || 'İsimsiz')
                        + ' <span class="badge bg-secondary float-end">' + slot.appointment.status_label + '</span>'
                        + '</a>';
                } else if (slot.available) {
                    html += '<a href="/admin/randevular/ekle?tarih=' + tarih + '&saat=' + slot.time + '" class="crm-slot-row bos text-decoration-none text-reset d-block">'
                        + '<strong>' + slot.time + '</strong> <span class="text-primary float-end">+ Randevu Ekle</span>'
                        + '</a>';
                } else {
                    html += '<div class="crm-slot-row text-muted"><strong>' + slot.time + '</strong> <span class="float-end">Geçti</span></div>';
                }
            });
            gunDetay.innerHTML = html;
        }

        document.getElementById('ay-once').addEventListener('click', function () {
            goruntulenenAy.setMonth(goruntulenenAy.getMonth() - 1);
            ayiYukle();
        });
        document.getElementById('ay-sonra').addEventListener('click', function () {
            goruntulenenAy.setMonth(goruntulenenAy.getMonth() + 1);
            ayiYukle();
        });

        ayiYukle();
    })();
    </script>
@endsection
