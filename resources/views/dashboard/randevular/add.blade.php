@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Yeni Randevu</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/randevular">Randevu Takvimi</a></li>
                            <li class="breadcrumb-item active">Yeni Randevu</li>
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
                    <form method="POST" action="/admin/randevular" id="randevu-form">
                        @csrf
                        <input type="hidden" name="patient_id" id="patient_id">

                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Danışan Ara (isim / telefon)</label>
                                <input type="text" class="form-control" id="danisan-ara" placeholder="Aramak için yazın..." autocomplete="off">
                                <div id="danisan-sonuclar" class="list-group position-absolute" style="z-index:10; max-width:500px;"></div>
                                <div class="form-text">Kayıtlı danışanı seçin, ya da aşağıya yeni danışan bilgilerini girin.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ad Soyad *</label>
                                <input type="text" class="form-control" name="name" id="name" required value="{{ old('name') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Telefon *</label>
                                <input type="text" class="form-control" name="phone" id="phone" required value="{{ old('phone') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-posta</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Görüşme Türü</label>
                                <select class="form-select" name="service_id">
                                    <option value="">Seçiniz...</option>
                                    @foreach($hizmetler as $hizmet)
                                        <option value="{{ $hizmet->id }}">{{ $hizmet->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Tarih *</label>
                                <input type="date" class="form-control" name="tarih" id="tarih" required value="{{ old('tarih', $tarih) }}" min="{{ \Carbon\Carbon::today()->toDateString() }}">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Saat *</label>
                                <input type="time" class="form-control" name="saat" id="saat" required value="{{ old('saat', $saat) }}" step="300">
                                <div class="form-text">İstediğiniz saati serbestçe girebilirsiniz (ör. 10:15); sabit bir saat listesiyle sınırlı değildir.</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Süre (dakika)</label>
                                <input type="number" class="form-control" name="sure" id="sure" min="10" max="240" step="5" placeholder="{{ $varsayilanSure }}" value="{{ old('sure') }}">
                                <div class="form-text">Boş bırakılırsa varsayılan ({{ $varsayilanSure }} dk) kullanılır.</div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Randevu Kaynağı *</label>
                                <select class="form-select" name="source" required>
                                    <option value="panel">Planlı (Panelden)</option>
                                    <option value="yuz_yuze">Yüz Yüze (Kurum Ziyareti)</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Terapi Odası *</label>
                                <select class="form-select" name="room_id" required>
                                    <option value="">Oda seçin...</option>
                                    @foreach($odalar as $oda)
                                        <option value="{{ $oda->id }}">{{ $oda->name }}</option>
                                    @endforeach
                                </select>
                                @if($odalar->isEmpty())
                                    <div class="form-text text-danger">Henüz aktif oda tanımlanmadı. Önce "Terapi Odaları" sayfasından oda ekleyin.</div>
                                @endif
                            </div>

                            <div class="col-md-12" id="gun-durum-alani" style="display:none;">
                                <div class="alert alert-light border small mb-0" id="gun-durum-metni"></div>
                            </div>

                            @if(count($psikologlar))
                            <div class="col-md-6">
                                <label class="form-label">Psikolog / Personel</label>
                                <select class="form-select" name="user_id">
                                    <option value="">Belirtilmedi</option>
                                    @foreach($psikologlar as $p)
                                        <option value="{{ $p->id }}">{{ $p->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @endif

                            <div class="col-md-4">
                                <label class="form-label">Tekrar (haftalık)</label>
                                <select class="form-select" name="tekrar_hafta">
                                    <option value="1">Tekrar yok (sadece bu tarih)</option>
                                    @foreach([2,3,4,6,8,10,12] as $n)
                                        <option value="{{ $n }}" {{ old('tekrar_hafta') == $n ? 'selected' : '' }}>{{ $n }} hafta boyunca, aynı gün/saat</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Danışan her hafta aynı gün/saatte geliyorsa, tek seferde birden fazla hafta için randevu açabilirsiniz. Dolu olan haftalar otomatik atlanır.</div>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Not (opsiyonel)</label>
                                <textarea class="form-control" name="not" rows="3">{{ old('not') }}</textarea>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary px-4">Randevuyu Oluştur</button>
                                <a href="/admin/randevular" class="btn btn-outline-secondary px-4">Vazgeç</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        var aramaInput = document.getElementById('danisan-ara');
        var sonuclar = document.getElementById('danisan-sonuclar');
        var patientId = document.getElementById('patient_id');
        var nameInput = document.getElementById('name');
        var phoneInput = document.getElementById('phone');
        var emailInput = document.getElementById('email');
        var tarihInput = document.getElementById('tarih');
        var saatInput = document.getElementById('saat');
        var gunDurumAlani = document.getElementById('gun-durum-alani');
        var gunDurumMetni = document.getElementById('gun-durum-metni');

        var zamanlayici = null;
        aramaInput.addEventListener('input', function () {
            patientId.value = '';
            var q = aramaInput.value.trim();
            clearTimeout(zamanlayici);
            if (q.length < 2) { sonuclar.innerHTML = ''; return; }
            zamanlayici = setTimeout(function () {
                fetch('/admin/danisanlar/ara?q=' + encodeURIComponent(q))
                    .then(function (r) { return r.json(); })
                    .then(function (list) {
                        sonuclar.innerHTML = '';
                        list.forEach(function (p) {
                            var a = document.createElement('a');
                            a.href = 'javascript:;';
                            a.className = 'list-group-item list-group-item-action';
                            a.textContent = p.name + ' — ' + p.phone;
                            a.addEventListener('click', function () {
                                patientId.value = p.id;
                                nameInput.value = p.name;
                                phoneInput.value = p.phone;
                                emailInput.value = p.email || '';
                                aramaInput.value = p.name;
                                sonuclar.innerHTML = '';
                            });
                            sonuclar.appendChild(a);
                        });
                    });
            }, 250);
        });

        function gunDurumunuGoster() {
            var tarih = tarihInput.value;
            if (!tarih) { gunDurumAlani.style.display = 'none'; return; }

            fetch('/admin/randevular/gun?tarih=' + tarih)
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    gunDurumAlani.style.display = 'block';
                    if (data.closed) {
                        gunDurumMetni.textContent = 'Bu gün klinik normal çalışma saatlerine göre kapalı görünüyor. Yine de dilerseniz bu tarihe randevu ekleyebilirsiniz.';
                        return;
                    }
                    var dolular = data.slots.filter(function (s) { return !s.available; }).map(function (s) { return s.time; });
                    gunDurumMetni.textContent = dolular.length
                        ? ('Bu günde dolu/geçmiş saatler: ' + dolular.join(', '))
                        : 'Bu gün için henüz hiç randevu yok, istediğiniz saati girebilirsiniz.';
                });
        }

        tarihInput.addEventListener('change', gunDurumunuGoster);
        if (tarihInput.value) gunDurumunuGoster();
    })();
    </script>
@endsection
