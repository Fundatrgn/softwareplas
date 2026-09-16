@extends('general.layout.template')

@section('content')
<style>
    input,textarea{
        color: var(--on-surface) !important
    }
</style>

<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{asset('theme/assets/img/bg/bread-bg.png')}}">
    <div class="container">
        <div class="ori-breadcrumb-content text-center ul-li">
            <h1>İletişim </h1>
            <ul>
                <li><a href="/">Anasayfa</a></li>
                <li>İletişim </li>
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
<div class="ori-google-map">
    <iframe class="map" src="https://www.google.com/maps?q={{ urlencode($settings->address ?? 'Manisa, Türkiye') }}&output=embed" height="865"></iframe>
</div>
<section id="ori-contact-form" class="ori-contact-form-section position-relative">
    <div class="container">
        <div class="ori-contact-form-content">
            <div class="row">
                <div class="col-lg-6">
                    <div class="ori-contact-form-text-info pera-content">
                        <h3>Benimle İletişime Geçin</h3>
                        <p>Randevu almak veya sormak istediğiniz bir şey varsa, aşağıdaki formu doldurabilir ya da telefon/WhatsApp üzerinden ulaşabilirsiniz. Paylaştığınız bilgiler gizlilik ilkesiyle korunur.</p>
                        <div class="ori-contact-form-item-info">
                            <div class="ori-contact-info d-flex align-items-center">
                                <div class="info-icon d-flex align-items-center justify-content-center">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="info-text pera-content">
                                    <h4>Telefon</h4>
                                    <p>{{$settings->phone ?? ''}}</p>
                                </div>
                            </div>
                            <div class="ori-contact-info d-flex align-items-center">
                                <div class="info-icon d-flex align-items-center justify-content-center">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-text pera-content">
                                    <h4>Email</h4>
                                    <p>{{$settings->email ?? ''}}</p>
                                </div>
                            </div>
                            <div class="ori-contact-info d-flex align-items-center">
                                <div class="info-icon d-flex align-items-center justify-content-center">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-text pera-content">
                                    <h4>Adres</h4>
                                    <p>{{$settings->address ?? ''}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ori-contact-form-wrap">
                         <form action="/iletisim" method="POST">
                            @csrf
                             <label>İsim *</label>
                             <input type="text" name="name" required>
                             <label>Email *</label>
                             <input type="text" name="email" placeholder="ornek@eposta.com" required>
                             <label>Telefon *</label>
                             <input type="text" name="phone" placeholder="(5XX) XXX XX XX" required>
                             <label>Konu *</label>
                             <input type="text" name="type" placeholder="Randevu talebi" required>
                             <label>Mesaj *</label>
                             <textarea name="content" placeholder="Merhaba, bir randevu almak istiyorum. Uygun olduğunuz bir gün için bilgi alabilir miyim?" required></textarea>
                             @include('general.comp.kvkk-modal')

                             <button type="submit">Gönder</button>
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
@endsection