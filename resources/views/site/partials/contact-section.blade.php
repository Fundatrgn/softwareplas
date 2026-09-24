<div id="contact" class="flat-spacing pt-0">
    <div class="section-contact">
        <div class="contact-image contact-image-art" aria-hidden="true"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="col-left">
                        <div class="heading-section mb-48">
                            <div class="heading-sub fw-semibold effectFade fadeUp">İletişim</div>
                            <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Birlikte <br> Değer Üretelim</h2>
                        </div>
                        <div>
                            @if ($settings?->email)
                                <div class="contact-item mb-20 effectFade fadeRotateX">
                                    <i class="icon icon-envelope-solid"></i>
                                    <div class="content">
                                        <div class="title fw-semibold mb-2">E-posta</div>
                                        <a class="text link1" href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                                    </div>
                                </div>
                            @endif
                            @if ($settings?->phone)
                                <div class="contact-item mb-20 effectFade fadeRotateX" data-delay="0.1">
                                    <i class="icon icon-headset-solid"></i>
                                    <div class="content">
                                        <div class="title fw-semibold mb-2">Telefon</div>
                                        <a class="text link1" href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}">{{ $settings->phone }}</a>
                                    </div>
                                </div>
                            @endif
                            @if ($settings?->location_text)
                                <div class="contact-item effectFade fadeRotateX" data-delay="0.2">
                                    <i class="icon icon-map-marker-solid"></i>
                                    <div class="content">
                                        <div class="title fw-semibold mb-2">Konum</div>
                                        <div class="text">{{ $settings->location_text }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    @include('site.partials.contact-form')
                </div>
            </div>
        </div>
    </div>
</div>
