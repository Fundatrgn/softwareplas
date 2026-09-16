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
        background-color: var(--page-bg);
        border: 1px solid rgba(47,109,128,0.15);
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
        </div>
    </div>
    <div class="line_animation">
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
    </div>
</section>

<section id="ori-contact-form" class="ori-contact-form-section position-relative">
    <div class="container">
        <div class="ori-contact-form-content">
            <div class="row">
                <div class="col-lg-5">
                    <div class="ori-contact-form-text-info pera-content">
                        <h3>Nasıl İşliyor?</h3>
                        <p>Aşağıdaki formdan size uygun bir gün ve saat seçip talebinizi iletebilirsiniz. En kısa sürede sizi arayarak ya da mesaj yoluyla randevunuzu teyit ederim. Dilerseniz doğrudan WhatsApp'tan da yazabilirsiniz.</p>

                        <div class="ori-randevu-info-box">
                            <h4><i class="fas fa-shield-alt"></i> Gizlilik</h4>
                            <p>Paylaştığınız bilgiler yalnızca randevu planlaması için kullanılır ve gizlilik ilkesi çerçevesinde korunur.</p>
                        </div>
                        <div class="ori-randevu-info-box">
                            <h4><i class="fas fa-clock"></i> Yanıt Süresi</h4>
                            <p>Randevu taleplerine genellikle aynı gün içinde dönüş yapılır.</p>
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
                    <div class="ori-contact-form-wrap">
                        <form action="/iletisim" method="POST" id="randevu-form">
                            @csrf
                            <input type="hidden" name="type" id="randevu-type" value="Randevu Talebi">

                            <label>Ad Soyad *</label>
                            <input type="text" name="name" required>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Telefon *</label>
                                    <input type="text" name="phone" placeholder="(5XX) XXX XX XX" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Email *</label>
                                    <input type="text" name="email" placeholder="ornek@eposta.com" required>
                                </div>
                            </div>

                            <label>Görüşme Türü *</label>
                            <select id="randevu-hizmet" required style="width:100%; height:50px; padding:10px 20px; margin-bottom:30px; background-color:var(--dark-surface); border:1px solid #393939;">
                                <option value="">Seçiniz...</option>
                                @foreach(App\Models\Services::orderBy('order','ASC')->get() as $hizmet)
                                    <option value="{{ $hizmet->title }}">{{ $hizmet->title }}</option>
                                @endforeach
                            </select>

                            <div class="row">
                                <div class="col-md-6">
                                    <label>Tarih *</label>
                                    <input type="date" name="randevu_tarih" id="randevu-tarih" required min="{{ \Carbon\Carbon::tomorrow()->toDateString() }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Saat *</label>
                                    <select name="randevu_saat" id="randevu-saat" required style="width:100%; height:50px; padding:10px 20px; margin-bottom:30px; background-color:var(--dark-surface); border:1px solid #393939;">
                                        <option value="">Seçiniz...</option>
                                        @foreach(['09:00','10:00','11:00','13:00','14:00','15:00','16:00','17:00'] as $saat)
                                            <option value="{{ $saat }}">{{ $saat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <label>Eklemek İstedikleriniz (opsiyonel)</label>
                            <textarea name="content" id="randevu-not" placeholder="Kısaca eklemek istediğiniz bir şey varsa buraya yazabilirsiniz."></textarea>

                            @include('general.comp.kvkk-modal')

                            <button type="submit">Randevu Talebi Gönder</button>
                            <p style="margin-top:15px; font-size:14px; color:var(--body-color)">
                                * Bu bir randevu talebidir, kesin onay için sizinle iletişime geçilecektir.
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="line_animation">
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
    </div>
</section>

<script>
(function() {
    var form = document.getElementById('randevu-form');
    if (!form) return;

    function updateHiddenFields() {
        var hizmet = document.getElementById('randevu-hizmet').value;
        var tarih = document.getElementById('randevu-tarih').value;
        var saat = document.getElementById('randevu-saat').value;
        var not = document.getElementById('randevu-not').value;

        document.getElementById('randevu-type').value = 'Randevu Talebi' + (hizmet ? ' - ' + hizmet : '');

        var mesaj = 'Randevu talebi:\n';
        if (hizmet) mesaj += 'Görüşme türü: ' + hizmet + '\n';
        if (tarih) mesaj += 'Tarih: ' + tarih + '\n';
        if (saat) mesaj += 'Saat: ' + saat + '\n';
        if (not) mesaj += 'Not: ' + not;
        document.getElementById('randevu-not').setAttribute('data-composed', mesaj);

        // WhatsApp linkini de seçilen bilgilerle güncelle
        var waLink = document.getElementById('whatsapp-randevu-link');
        if (waLink) {
            var waText = 'Merhaba, bir randevu almak istiyorum.';
            if (hizmet) waText += ' Görüşme türü: ' + hizmet + '.';
            if (tarih) waText += ' Tarih: ' + tarih + '.';
            if (saat) waText += ' Saat: ' + saat + '.';
            var base = waLink.href.split('?')[0];
            waLink.href = base + '?text=' + encodeURIComponent(waText);
        }
    }

    ['randevu-hizmet', 'randevu-tarih', 'randevu-saat', 'randevu-not'].forEach(function(id) {
        var el = document.getElementById(id);
        if (el) el.addEventListener('input', updateHiddenFields);
    });

    form.addEventListener('submit', function() {
        var hizmet = document.getElementById('randevu-hizmet').value;
        var tarih = document.getElementById('randevu-tarih').value;
        var saat = document.getElementById('randevu-saat').value;
        var notAlani = document.getElementById('randevu-not');
        var ekNot = notAlani.value;

        var mesaj = '';
        if (hizmet) mesaj += 'Görüşme türü: ' + hizmet + '\n';
        if (tarih) mesaj += 'Tarih: ' + tarih + '\n';
        if (saat) mesaj += 'Saat: ' + saat + '\n';
        if (ekNot) mesaj += 'Not: ' + ekNot;
        notAlani.value = mesaj;
    });
})();
</script>
@endsection
