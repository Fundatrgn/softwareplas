@extends('general.layout.template')

@section('content')
<style>
    .ori-contact-form-wrap input,
    .ori-contact-form-wrap select,
    .ori-contact-form-wrap textarea{
        color: var(--on-surface) !important
    }
    .ori-contact-form-wrap select option{
        color: #1F2D30;
    }
    .ori-randevu-info-box {
        background-color: var(--dark-surface);
        border: 1px solid var(--surface-border);
        border-radius: 12px;
        padding: 30px;
        margin-bottom: 30px;
    }
    .ori-randevu-info-box h4 {
        color: var(--heading-color);
        margin-bottom: 10px;
    }
    .ori-randevu-info-box p {
        color: var(--body-color);
        margin-bottom: 0;
    }
    .ori-whatsapp-alt-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background-color: #25D366;
        color: #fff !important;
        padding: 14px 26px;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        margin-top: 10px;
    }
    .ori-whatsapp-alt-btn:hover {
        opacity: 0.9;
        color: #fff;
    }

    /* --- Randevu takvimi --- */
    .ori-randevu-takvim {
        background: var(--dark-surface);
        border: 1px solid var(--surface-border);
        border-radius: 12px;
        padding: 24px;
        margin-bottom: 24px;
    }
    .ori-randevu-takvim-baslik {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 16px;
    }
    .ori-randevu-takvim-baslik h4 {
        margin: 0;
        color: var(--heading-color);
        font-size: 18px;
        text-transform: capitalize;
    }
    .ori-randevu-ay-btn {
        background: var(--page-bg);
        border: 1px solid var(--surface-border);
        color: var(--heading-color);
        width: 36px;
        height: 36px;
        border-radius: 50%;
        cursor: pointer;
        font-size: 16px;
        line-height: 1;
    }
    .ori-randevu-ay-btn:hover { background: var(--base-color-1); color: #fff; }
    .ori-randevu-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
    }
    .ori-randevu-gun-baslik {
        text-align: center;
        font-size: 12px;
        font-weight: 700;
        color: var(--on-surface-muted);
        padding-bottom: 6px;
    }
    .ori-randevu-gun {
        aspect-ratio: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        border: 1px solid transparent;
        color: var(--heading-color);
        background: var(--page-bg);
    }
    .ori-randevu-gun.bos { visibility: hidden; }
    .ori-randevu-gun.musait {
        background: rgba(217, 120, 75, 0.12);
        border: 1px solid rgba(217, 120, 75, 0.35);
    }
    .ori-randevu-gun.musait:hover,
    .ori-randevu-gun.secili {
        border-color: var(--base-color-1);
        background: var(--base-color-1);
        color: #fff;
    }
    .ori-randevu-gun.dolu {
        background: transparent;
        color: #C97B7B;
        border: 1px dashed #C97B7B;
        cursor: not-allowed;
        opacity: 0.75;
    }
    .ori-randevu-gun.kapali,
    .ori-randevu-gun.gecmis {
        background: transparent;
        color: var(--on-surface-muted);
        cursor: not-allowed;
        opacity: 0.4;
    }
    .ori-randevu-legend {
        display: flex; flex-wrap: wrap; gap: 14px; margin-top: 16px; font-size: 13px; color: var(--body-color);
    }
    .ori-randevu-legend span { display:inline-flex; align-items:center; gap:6px; }
    .ori-randevu-legend i { width:12px; height:12px; border-radius:3px; display:inline-block; }

    .ori-randevu-saatler {
        margin-top: 20px;
        display: none;
    }
    .ori-randevu-saatler h5 {
        color: var(--heading-color);
        margin-bottom: 12px;
        font-size: 15px;
    }
    .ori-randevu-saat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
        gap: 8px;
    }
    .ori-randevu-saat-btn {
        padding: 10px 8px;
        text-align: center;
        border-radius: 8px;
        border: 1px solid var(--surface-border);
        background: var(--page-bg);
        color: var(--heading-color);
        cursor: pointer;
        font-weight: 600;
        font-size: 14px;
    }
    .ori-randevu-saat-btn:hover:not(:disabled) {
        border-color: var(--base-color-1);
    }
    .ori-randevu-saat-btn.secili {
        background: var(--base-color-1);
        border-color: var(--base-color-1);
        color: #fff;
    }
    .ori-randevu-saat-btn:disabled {
        opacity: 0.35;
        cursor: not-allowed;
        text-decoration: line-through;
    }
    .ori-randevu-secim-ozet {
        margin-top: 16px;
        padding: 14px 18px;
        border-radius: 8px;
        background: rgba(217,120,75,0.12);
        color: var(--heading-color);
        font-weight: 600;
        display: none;
    }
    .ori-contact-form-wrap.ori-form-disabled {
        opacity: 0.5;
        pointer-events: none;
    }
</style>

<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{asset('theme/assets/img/bg/bread-bg.png')}}">
    <div class="container">
        <div class="ori-breadcrumb-content text-center ul-li">
            <h1>Randevu Al</h1>
            <ul>
                <li><a href="/">Anasayfa</a></li>
                <li>Randevu Al</li>
            </ul>
            @if (session('success'))
                <br>
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <br>
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
        </div>
    </div>
    <div class="line_animation">
        <div class="line_area"></div><div class="line_area"></div><div class="line_area"></div><div class="line_area"></div>
        <div class="line_area"></div><div class="line_area"></div><div class="line_area"></div><div class="line_area"></div>
    </div>
</section>

<section id="ori-contact-form" class="ori-contact-form-section position-relative">
    <div class="container">
        <div class="ori-contact-form-content">
            <div class="row">
                <div class="col-lg-5">
                    <div class="ori-contact-form-text-info pera-content">
                        <h3>Nasıl İşliyor?</h3>
                        <p>Aşağıdaki takvimden size uygun bir gün ve saat seçin. Seçtiğiniz saat gerçek zamanlı olarak sistemde ayrılır; bilgilerinizi girip onayladığınızda randevunuz oluşturulur. Dilerseniz doğrudan WhatsApp'tan da yazabilirsiniz.</p>

                        <div class="ori-randevu-info-box">
                            <h4><i class="fas fa-shield-alt"></i> Gizlilik</h4>
                            <p>Paylaştığınız bilgiler yalnızca randevu planlaması için kullanılır ve gizlilik ilkesi çerçevesinde korunur.</p>
                        </div>
                        <div class="ori-randevu-info-box">
                            <h4><i class="fas fa-clock"></i> Anında Kayıt</h4>
                            <p>Seçtiğiniz saat, formu onayladığınız anda sistemde sizin için ayrılır; aynı saat başka bir danışana verilmez.</p>
                        </div>

                        @if(!empty($settings->whatsapp_number))
                        <a id="whatsapp-randevu-link" target="_blank" rel="noopener"
                           href="https://wa.me/{{ preg_replace('/\D/', '', $settings->whatsapp_number) }}?text={{ urlencode('Merhaba, bir randevu almak istiyorum.') }}"
                           class="ori-whatsapp-alt-btn">
                            <i class="fab fa-whatsapp" style="font-size:22px"></i> WhatsApp'tan Yaz
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-7">

                    <div class="ori-randevu-takvim">
                        <div class="ori-randevu-takvim-baslik">
                            <button type="button" class="ori-randevu-ay-btn" id="ay-once">‹</button>
                            <h4 id="ay-baslik">&nbsp;</h4>
                            <button type="button" class="ori-randevu-ay-btn" id="ay-sonra">›</button>
                        </div>
                        <div class="ori-randevu-grid" id="gun-baslik-grid">
                            @foreach(['Pzt','Sal','Çar','Per','Cum','Cmt','Paz'] as $g)
                                <div class="ori-randevu-gun-baslik">{{ $g }}</div>
                            @endforeach
                        </div>
                        <div class="ori-randevu-grid" id="takvim-grid"></div>

                        <div class="ori-randevu-legend">
                            <span><i style="background:var(--base-color-1)"></i> Müsait</span>
                            <span><i style="background:transparent;border:1px dashed #C97B7B"></i> Dolu</span>
                            <span><i style="background:var(--page-bg);border:1px solid var(--surface-border);opacity:.5"></i> Kapalı</span>
                        </div>

                        <div class="ori-randevu-saatler" id="saatler-alan">
                            <h5>Müsait Saatler — <span id="secili-tarih-metin"></span></h5>
                            <div class="ori-randevu-saat-grid" id="saat-grid"></div>
                        </div>

                        <div class="ori-randevu-secim-ozet" id="secim-ozet"></div>
                    </div>

                    <div class="ori-contact-form-wrap ori-form-disabled" id="randevu-form-wrap">
                        <form action="/randevu" method="POST" id="randevu-form">
                            @csrf
                            <input type="hidden" name="tarih" id="randevu-tarih-input">
                            <input type="hidden" name="saat" id="randevu-saat-input">

                            <label>Ad Soyad *</label>
                            <input type="text" name="name" required value="{{ old('name') }}">

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Telefon *</label>
                                    <input type="text" name="phone" placeholder="(5XX) XXX XX XX" required value="{{ old('phone') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="text" name="email" placeholder="ornek@eposta.com" value="{{ old('email') }}">
                                </div>
                            </div>

                            <label>Görüşme Türü</label>
                            <select name="service_id" style="width:100%; height:50px; padding:10px 20px; margin-bottom:30px; background-color:var(--dark-surface); border:1px solid var(--surface-border);">
                                <option value="">Seçiniz...</option>
                                @foreach($hizmetler as $hizmet)
                                    <option value="{{ $hizmet->id }}">{{ $hizmet->title }}</option>
                                @endforeach
                            </select>

                            <label>Eklemek İstedikleriniz (opsiyonel)</label>
                            <textarea name="not" placeholder="Kısaca eklemek istediğiniz bir şey varsa buraya yazabilirsiniz.">{{ old('not') }}</textarea>

                            @include('general.comp.kvkk-modal')

                            <button type="submit">Randevuyu Onayla</button>
                            <p style="margin-top:15px; font-size:14px; color:var(--body-color)">
                                * Devam etmek için yukarıdaki takvimden bir gün ve saat seçmeniz gerekir.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line_animation">
        <div class="line_area"></div><div class="line_area"></div><div class="line_area"></div><div class="line_area"></div>
        <div class="line_area"></div><div class="line_area"></div><div class="line_area"></div><div class="line_area"></div>
    </div>
</section>

<script>
(function () {
    var ayBaslik = document.getElementById('ay-baslik');
    var takvimGrid = document.getElementById('takvim-grid');
    var saatlerAlan = document.getElementById('saatler-alan');
    var saatGrid = document.getElementById('saat-grid');
    var seciliTarihMetin = document.getElementById('secili-tarih-metin');
    var secimOzet = document.getElementById('secim-ozet');
    var tarihInput = document.getElementById('randevu-tarih-input');
    var saatInput = document.getElementById('randevu-saat-input');
    var formWrap = document.getElementById('randevu-form-wrap');

    var aylar = ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'];

    var today = new Date();
    var goruntulenenAy = new Date(today.getFullYear(), today.getMonth(), 1);
    var seciliGun = null;

    function ayAnahtari(d) {
        return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0');
    }

    function takvimiYukle() {
        ayBaslik.textContent = aylar[goruntulenenAy.getMonth()] + ' ' + goruntulenenAy.getFullYear();
        takvimGrid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:20px;color:var(--on-surface-muted)">Yükleniyor...</div>';

        fetch('/randevu/musaitlik?ay=' + ayAnahtari(goruntulenenAy))
            .then(function (r) { return r.json(); })
            .then(function (data) { gunleriCiz(data.days); })
            .catch(function () {
                takvimGrid.innerHTML = '<div style="grid-column:1/-1;text-align:center;padding:20px;color:var(--on-surface-muted)">Takvim yüklenemedi.</div>';
            });
    }

    function gunleriCiz(days) {
        takvimGrid.innerHTML = '';

        if (days.length === 0) return;
        var ilkTarih = new Date(days[0].date + 'T00:00:00');
        var haftaninGunu = (ilkTarih.getDay() + 6) % 7; // Pazartesi=0

        for (var b = 0; b < haftaninGunu; b++) {
            var bos = document.createElement('div');
            bos.className = 'ori-randevu-gun bos';
            takvimGrid.appendChild(bos);
        }

        days.forEach(function (gun) {
            var el = document.createElement('div');
            var gunNo = parseInt(gun.date.split('-')[2], 10);
            el.textContent = gunNo;
            el.setAttribute('data-tarih', gun.date);

            var durum = 'musait';
            if (gun.past || gun.closed) durum = gun.past ? 'gecmis' : 'kapali';
            else if (gun.full) durum = 'dolu';

            el.className = 'ori-randevu-gun ' + durum;

            if (durum === 'musait') {
                el.addEventListener('click', function () { gunSec(gun.date, el); });
            }

            takvimGrid.appendChild(el);
        });
    }

    function gunSec(tarih, el) {
        document.querySelectorAll('.ori-randevu-gun.secili').forEach(function (n) { n.classList.remove('secili'); });
        el.classList.add('secili');
        seciliGun = tarih;
        saatSecimiSifirla();

        var tarihObj = new Date(tarih + 'T00:00:00');
        seciliTarihMetin.textContent = tarihObj.toLocaleDateString('tr-TR', { day: 'numeric', month: 'long', year: 'numeric', weekday: 'long' });

        saatlerAlan.style.display = 'block';
        saatGrid.innerHTML = '<div style="color:var(--on-surface-muted)">Yükleniyor...</div>';

        fetch('/randevu/saatler?tarih=' + tarih)
            .then(function (r) { return r.json(); })
            .then(function (data) { saatleriCiz(data.slots || []); })
            .catch(function () {
                saatGrid.innerHTML = '<div style="color:var(--on-surface-muted)">Saatler yüklenemedi.</div>';
            });
    }

    function saatleriCiz(slots) {
        saatGrid.innerHTML = '';
        if (slots.length === 0) {
            saatGrid.innerHTML = '<div style="color:var(--on-surface-muted)">Bu gün için tanımlı saat yok.</div>';
            return;
        }
        slots.forEach(function (slot) {
            var btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'ori-randevu-saat-btn';
            btn.textContent = slot.time;
            btn.disabled = !slot.available;
            if (slot.available) {
                btn.addEventListener('click', function () { saatSec(slot.time, btn); });
            }
            saatGrid.appendChild(btn);
        });
    }

    function saatSec(saat, el) {
        document.querySelectorAll('.ori-randevu-saat-btn.secili').forEach(function (n) { n.classList.remove('secili'); });
        el.classList.add('secili');

        tarihInput.value = seciliGun;
        saatInput.value = saat;

        var tarihObj = new Date(seciliGun + 'T00:00:00');
        secimOzet.style.display = 'block';
        secimOzet.textContent = 'Seçiminiz: ' + tarihObj.toLocaleDateString('tr-TR', { day: 'numeric', month: 'long', year: 'numeric' }) + ' — ' + saat;

        formWrap.classList.remove('ori-form-disabled');

        var waLink = document.getElementById('whatsapp-randevu-link');
        if (waLink) {
            var base = waLink.href.split('?')[0];
            var metin = 'Merhaba, ' + tarihObj.toLocaleDateString('tr-TR') + ' ' + saat + ' için randevu almak istiyorum.';
            waLink.href = base + '?text=' + encodeURIComponent(metin);
        }
    }

    function saatSecimiSifirla() {
        tarihInput.value = '';
        saatInput.value = '';
        secimOzet.style.display = 'none';
        formWrap.classList.add('ori-form-disabled');
    }

    document.getElementById('ay-once').addEventListener('click', function () {
        goruntulenenAy.setMonth(goruntulenenAy.getMonth() - 1);
        saatlerAlan.style.display = 'none';
        saatSecimiSifirla();
        takvimiYukle();
    });
    document.getElementById('ay-sonra').addEventListener('click', function () {
        goruntulenenAy.setMonth(goruntulenenAy.getMonth() + 1);
        saatlerAlan.style.display = 'none';
        saatSecimiSifirla();
        takvimiYukle();
    });

    takvimiYukle();
})();
</script>
@endsection
