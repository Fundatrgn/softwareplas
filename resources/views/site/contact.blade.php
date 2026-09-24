@extends('site.layout')

@php $socials = $settings?->socials() ?? []; @endphp

@section('title', 'İletişim')
@section('description', ($settings?->author ?: 'Yunuscan ZEYBEK') . ' ile iletişime geçin: iş birliği, proje ve röportaj talepleriniz için.')

@section('content')
    @include('site.partials.page-hero', [
        'line1' => 'Birlikte',
        'line2' => 'Üretelim',
        'text' => 'Proje, iş birliği ya da röportaj talepleriniz için bana ulaşın; en kısa sürede dönüş yapayım.',
    ])

    <div id="contact" class="flat-spacing">
        <div class="section-contact p-0">
            <div class="container">
                <div class="row mb-60 justify-content-center">
                    @if ($settings?->email)
                        <div class="col-md-4 md-mb-24">
                            <div class="box-contact-item text-center effectFade fadeUp">
                                <i class="icon icon-envelope-solid"></i>
                                <h2 class="title h6 fw-semibold">E-posta</h2>
                                <a class="text" href="mailto:{{ $settings->email }}">{{ $settings->email }}</a>
                            </div>
                        </div>
                    @endif
                    @if ($settings?->phone)
                        <div class="col-md-4 md-mb-24">
                            <div class="box-contact-item text-center effectFade fadeUp" data-delay="0.1">
                                <i class="icon icon-headset-solid"></i>
                                <h2 class="title h6 fw-semibold">Telefon</h2>
                                <a href="tel:{{ preg_replace('/[^0-9+]/', '', $settings->phone) }}" class="text">{{ $settings->phone }}</a>
                            </div>
                        </div>
                    @endif
                    @if ($settings?->location_text || $settings?->address)
                        <div class="col-md-4">
                            <div class="box-contact-item text-center effectFade fadeUp" data-delay="0.2">
                                <i class="icon icon-map-marker-solid"></i>
                                <h2 class="title h6 fw-semibold">Konum</h2>
                                <p class="text">{{ $settings->address ?: $settings->location_text }}</p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="row">
                    <div class="col-lg-6 lg-mb-24">
                        <div class="col-left p-0">
                            <div class="mb-24">
                                <div class="heading-section mb-48">
                                    <div class="heading-sub fw-semibold effectFade fadeUp">İletişim</div>
                                    <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Bir fikriniz mi var? <br> Konuşalım.</h2>
                                </div>
                                <p class="text effectFade fadeUp">Web sitesi, dijital medya, kurumsal iletişim ya da içerik projeleriniz için formu doldurmanız yeterli. Mesajınız doğrudan bana ulaşır.</p>
                            </div>
                            @if ($socials)
                                <div class="tf-social-1 gap-24 flex-wrap effectFade fadeRotateX">
                                    @foreach ($socials as $social)
                                        <a href="{{ $social['url'] }}" target="_blank" rel="noopener" class="text-body-1 fw-semibold">
                                            {{ $social['label'] }}
                                            <div class="social-item"><i class="icon {{ $social['icon'] }}"></i></div>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        @include('site.partials.contact-form', ['formClass' => 'm-0'])
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($settings?->map_embed && str_starts_with($settings->map_embed, 'https://www.google.com/maps/embed'))
        <div class="wg-map">
            <iframe src="{{ $settings->map_embed }}" height="520" style="border:0;" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Konum haritası"></iframe>
        </div>
    @endif

    @include('site.partials.faq', ['faqs' => $faqs, 'class' => ''])
@endsection
