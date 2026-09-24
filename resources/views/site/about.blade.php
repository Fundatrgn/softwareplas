@extends('site.layout')

@php
    $name = $settings?->author ?: 'Yunuscan ZEYBEK';
    $valueIcons = ['icon-bullseye-solid', 'icon-user-check-solid', 'icon-shield-alt-solid', 'icon-chart-line-solid', 'icon-plug-solid', 'icon-book-solid'];
@endphp

@section('title', $name . ' Kimdir?')
@section('description', $settings?->description ?: $name . ' kimdir, ne iş yapar? Biyografisi, uzmanlık alanları, projeleri ve kariyer yolculuğu.')
@section('og_type', 'profile')

@push('schema')
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'ProfilePage',
        'url' => url('/yunuscan-zeybek-kimdir'),
        'name' => $name . ' Kimdir?',
        'inLanguage' => 'tr-TR',
        'mainEntity' => ['@id' => url('/') . '#person'],
        'breadcrumb' => [
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Anasayfa', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => $name . ' Kimdir?', 'item' => url('/yunuscan-zeybek-kimdir')],
            ],
        ],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    @include('site.partials.page-hero', [
        'line1' => $name,
        'line2' => 'Kimdir?',
        'text' => $settings?->job_title,
    ])

    <div class="section-about-us flat-spacing" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-section">
                        <div class="heading-sub fw-semibold effectFade fadeUp">Biyografi</div>
                        <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">{{ $intro?->subtitle ?: 'Kısaca Ben' }}</h2>
                    </div>
                </div>
                <div class="col-xxl-5 col-lg-5 lg-mb-24">
                    <div class="col-left profile-card {{ $settings?->profile_image ? 'has-photo' : '' }}">
                        @if ($settings?->profile_image)
                            <img class="profile-photo" src="{{ asset('images/' . $settings->profile_image) }}" alt="{{ $name }}">
                        @endif
                        <div class="position-relative z-5">
                            @if ($settings?->availability_text)
                                <div class="sub text-white"><span class="dot"></span>{{ $settings->availability_text }}</div>
                            @endif
                            <h3 class="title h5 fw-semibold text-white">{{ $name }}
                                @if ($settings?->location_text)
                                    <span class="d-block text-brand">{{ $settings->location_text }}</span>
                                @endif
                            </h3>
                            <a href="{{ url('/iletisim') }}" class="tf-btn">İletişime Geç</a>
                        </div>
                        @unless ($settings?->profile_image)
                            <img class="effectFade fadeRotateX" src="{{ asset('site/images/yz/globe.svg') }}" alt="">
                        @endunless
                    </div>
                </div>
                <div class="col-xxl-7 col-lg-7">
                    <div class="mission-box mb-24">
                        <div class="text rich-text effectFade fadeUp">{!! $intro?->content !!}</div>
                    </div>
                    @if ($settings?->quote_text)
                        <div class="box-quotes effectFade fadeRotateX">
                            <div class="content w-100">
                                <div class="icon mb-8"><i class="icon icon-quote-right-solid fs-20"></i></div>
                                <div class="text-body-1 fw-semibold desc">{{ $settings->quote_text }}</div>
                                <div class="cite">
                                    <div class="name text-body-3 fw-semibold">{{ $settings->quote_author ?: $name }}</div>
                                    @if ($settings->quote_role)
                                        <div class="line"></div>
                                        <div class="sub text-body-3">{{ $settings->quote_role }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('site.partials.brands')

    @if ($values->isNotEmpty())
        <div class="box-white">
            <div class="section-features flat-spacing">
                <div class="container">
                    <div class="heading-section center mb-64">
                        <div class="heading-sub fw-semibold effectFade fadeUp">Yaklaşımım</div>
                        <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Değer Verdiğim İlkeler</h2>
                    </div>
                    <div class="row">
                        @foreach ($values as $value)
                            <div class="col-md-6 mb-24">
                                <div class="features-item style-2 h-100 effectFade fadeRotateX" data-delay="{{ $loop->even ? '0.1' : '0' }}">
                                    <div class="icon">
                                        @if ($value->image)
                                            <img src="{{ asset('images/' . $value->image) }}" alt="" style="max-width:48px">
                                        @else
                                            <i class="icon {{ $valueIcons[$loop->index % count($valueIcons)] }}"></i>
                                        @endif
                                    </div>
                                    @if ($value->subtitle)
                                        <div class="text-secondary fw-semibold mb-8">{{ $value->subtitle }}</div>
                                    @endif
                                    <h3 class="title h4 fw-semibold">{{ $value->title }}</h3>
                                    <div class="text-secondary rich-text">{!! $value->content !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    @include('site.partials.dark-block', ['testimonials' => $testimonials, 'timeline' => $timeline])
    @include('site.partials.faq', ['faqs' => $faqs, 'class' => ''])
    @include('site.partials.contact-section')
@endsection
