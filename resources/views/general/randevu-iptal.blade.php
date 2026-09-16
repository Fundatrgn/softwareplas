@extends('general.layout.template')

@section('content')
<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{asset('theme/assets/img/bg/bread-bg.png')}}">
    <div class="container">
        <div class="ori-breadcrumb-content text-center ul-li">
            <h1>Randevu İptali</h1>
            <ul>
                <li><a href="/">Anasayfa</a></li>
                <li>Randevu İptali</li>
            </ul>
        </div>
    </div>
</section>

<section class="position-relative" style="padding: 60px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div style="background: var(--dark-surface); border: 1px solid var(--surface-border); border-radius: 12px; padding: 40px; text-align:center;">
                    @if($zatenIslendi)
                        <h3 style="color: var(--heading-color);">Bu randevu için yapılabilecek bir işlem yok</h3>
                        <p style="color: var(--body-color); margin-top: 14px;">
                            {{ $appointment->starts_at->translatedFormat('d F Y, H:i') }} tarihli randevunuzun durumu zaten
                            "<strong>{{ $appointment->statusLabel() }}</strong>" olarak işaretlenmiş.
                        </p>
                    @else
                        <h3 style="color: var(--heading-color);">Randevunuz İptal Edildi</h3>
                        <p style="color: var(--body-color); margin-top: 14px;">
                            {{ $appointment->starts_at->translatedFormat('d F Y, H:i') }} tarihli randevunuz başarıyla iptal edildi.
                            Yeni bir randevu almak isterseniz aşağıdaki butonu kullanabilirsiniz.
                        </p>
                    @endif
                    <a href="/randevu" class="ori-whatsapp-alt-btn" style="background-color: var(--base-color-1); margin-top: 20px;">
                        Yeni Randevu Al
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
