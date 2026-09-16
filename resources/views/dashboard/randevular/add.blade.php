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

                            <div class="col-md-4">
                                <label class="form-label">Tarih *</label>
                                <input type="date" class="form-control" name="tarih" id="tarih" required value="{{ old('tarih', $tarih) }}" min="{{ \Carbon\Carbon::today()->toDateString() }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Saat *</label>
                                <select class="form-select" name="saat" id="saat" required>
                                    <option value="">Önce tarih seçin</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Randevu Kaynağı *</label>
                                <select class="form-select" name="source" required>
                                    <option value="panel">Planlı (Panelden)</option>
                                    <option value="yuz_yuze">Yüz Yüze (Kurum Ziyareti)</option>
                                </select>
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
        var saatSelect = document.getElementById('saat');

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

        function saatleriYukle() {
            var tarih = tarihInput.value;
            saatSelect.innerHTML = '<option value="">Yükleniyor...</option>';
            if (!tarih) { saatSelect.innerHTML = '<option value="">Önce tarih seçin</option>'; return; }

            fetch('/admin/randevular/gun?tarih=' + tarih)
                .then(function (r) { return r.json(); })
                .then(function (data) {
                    saatSelect.innerHTML = '';
                    if (data.closed) {
                        saatSelect.innerHTML = '<option value="">Bu gün kapalı</option>';
                        return;
                    }
                    var bosVar = false;
                    data.slots.forEach(function (slot) {
                        var opt = document.createElement('option');
                        opt.value = slot.time;
                        opt.textContent = slot.time + (slot.available ? '' : ' (dolu)');
                        opt.disabled = !slot.available;
                        if (slot.available) bosVar = true;
                        saatSelect.appendChild(opt);
                    });
                    if (!bosVar) {
                        var uyari = document.createElement('option');
                        uyari.value = '';
                        uyari.textContent = 'Bu gün için müsait saat yok';
                        saatSelect.prepend(uyari);
                    }

                    @if($saat)
                        var onceden = "{{ $saat }}";
                        if (onceden) saatSelect.value = onceden;
                    @endif
                });
        }

        tarihInput.addEventListener('change', saatleriYukle);
        if (tarihInput.value) saatleriYukle();
    })();
    </script>
@endsection
