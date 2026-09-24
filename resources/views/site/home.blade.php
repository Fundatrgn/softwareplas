@extends('site.layout')

@php
    $name = $settings?->author ?: 'Yunuscan ZEYBEK';
    $stats = $settings?->stats ?? [];
    $firstStat = $stats[0] ?? null;
@endphp

@section('body_class', $firstStat ? 'counter-scroll' : '')

@section('content')
    {{-- Giriş (Hero) --}}
    <div class="section-hero" @if ($hero?->image) style="--hero-bg: url('{{ asset('images/' . $hero->image) }}')" @endif>
        <div class="hero-image {{ $hero?->image ? 'has-photo' : '' }}"></div>
        <div class="container">
            <div class="content-wrap text-center">
                @if ($hero?->badge)
                    <div class="sub fw-semibold effectFade fadeUp">
                        <i class="icon icon-bolt-solid text-brand"></i>
                        {{ $hero->badge }}
                    </div>
                @endif
                <h1 class="title text-display-2 effectFade fadeRotateX">
                    <span class="title1 fw-semibold text-gradient-1">{{ $hero->title ?? $name }}</span>
                    @if ($hero?->title2)
                        <br>
                        <span class="title2 d-flex gap-20 justify-content-center flex-wrap">
                            <span class="fw-semibold text-gradient-1">{{ $hero->title2 }}</span>
                            <span class="title-icon">
                                <span class="box"></span>
                                <span class="title-icon-wrap">
                                    <img class="img-1 img-transform-3" src="{{ asset('site/images/item/hero-1.svg') }}" alt="">
                                    <img class="img-2 img-transform-3" src="{{ asset('site/images/item/hero-2.svg') }}" alt="">
                                    <img class="img-3 img-transform-3" src="{{ asset('site/images/item/hero-3.svg') }}" alt="">
                                </span>
                            </span>
                        </span>
                    @endif
                </h1>
                @if ($hero?->subtitle)
                    <p class="text effectFade fadeUp">{{ $hero->subtitle }}</p>
                @endif
                <div class="bot-btns effectFade fadeRotateX">
                    @if ($hero?->btn_text)
                        <a href="{{ $hero->btn_url ?: url('/projeler') }}" class="tf-btn">{{ $hero->btn_text }}</a>
                    @endif
                    @if ($hero?->btn2_text)
                        <a href="{{ $hero->btn2_url ?: url('/iletisim') }}" class="tf-btn-2">{{ $hero->btn2_text }}</a>
                    @endif
                </div>
            </div>
        </div>
        <a href="#about" class="scroll-more">
            <span class="fw-semibold link1">Keşfetmek için kaydırın</span>
            <i class="icon icon-long-arrow-alt-down-solid"></i>
        </a>
    </div>

    {{-- Kısaca ben --}}
    <div class="section-about-us flat-spacing" id="about">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-section">
                        <div class="heading-sub fw-semibold effectFade fadeUp">{{ $intro?->subtitle ?: 'Hakkımda' }}</div>
                        <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">{{ $intro?->title ?: $name . ' Kimdir?' }}</h2>
                    </div>
                </div>
                <div class="col-xxl-7 col-lg-6 lg-mb-24">
                    <div class="col-left">
                        <div class="position-relative z-5">
                            @if ($settings?->availability_text)
                                <div class="sub text-white">
                                    <span class="dot"></span>
                                    {{ $settings->availability_text }}
                                </div>
                            @endif
                            @if ($settings?->location_text)
                                <h3 class="title h5 fw-semibold text-white">Merkez: <span class="text-brand">{{ $settings->location_text }}</span></h3>
                            @endif
                            <a href="{{ url('/yunuscan-zeybek-kimdir') }}" class="tf-btn">Beni Daha Yakından Tanıyın</a>
                        </div>
                        <img class="effectFade fadeRotateX" src="{{ asset('site/images/yz/globe.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-xxl-5 col-lg-6">
                    <div class="review-box mb-24">
                        <div class="desc fw-semibold text-body-1">
                            {{ \Illuminate\Support\Str::limit(trim(html_entity_decode(strip_tags($intro?->content ?? ''))), 170) }}
                        </div>
                        @if ($firstStat)
                            <div class="d-flex justify-content-between flex-wrap align-items-end gap-12">
                                <div class="text-secondary fw-semibold">{{ $firstStat['label'] }}</div>
                                <div class="counter text-neutral-200">
                                    @if (is_numeric($firstStat['value']))
                                        <span class="number" data-speed="1500" data-to="{{ $firstStat['value'] }}" data-inviewport="yes">0</span><span>{{ $firstStat['suffix'] ?? '' }}</span>
                                    @else
                                        <span>{{ $firstStat['value'] }}{{ $firstStat['suffix'] ?? '' }}</span>
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                    @if ($settings?->quote_text)
                        <div class="box-quotes effectFade fadeRotateX">
                            <div class="image">
                                <img src="{{ $settings->profile_image ? asset('images/' . $settings->profile_image) : asset('site/images/yz/cover-3.svg') }}" alt="{{ $name }}">
                            </div>
                            <div class="content">
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

    <div class="box-white">
        {{-- Hizmetler --}}
        @if ($services->isNotEmpty())
            <div id="services" class="section-services flat-spacing">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-xxl-4 col-lg-6">
                            <div class="d-flex flex-column justify-content-between h-100">
                                <div class="col-left">
                                    <div class="heading-section mb-48">
                                        <div class="heading-sub fw-semibold effectFade fadeUp">Hizmetler</div>
                                        <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Uzmanlık <br> Alanlarım</h2>
                                    </div>
                                    <p class="effectFade fadeUp mb-24">Web yazılımından dijital medyaya, kurumsal iletişimden içerik üretimine kadar; fikri planlayıp hayata geçiren, ölçen ve geliştiren uçtan uca çözümler.</p>
                                    <a href="{{ url('/hizmetler') }}" class="tf-btn-2 effectFade fadeUp">Tüm hizmetler <i class="icon icon-arrow-top-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-lg-6">
                            <div class="accordion-faq_list" id="accordion-services">
                                @foreach ($services as $i => $service)
                                    @php $img = \App\Support\Img::cover($service->image, $service->id + 2); @endphp
                                    <div class="accordion-faq_item effectFade fadeUp" role="presentation">
                                        <div class="accordion-action services-image-btn {{ $loop->first ? 'active-img' : 'collapsed' }}" data-img="{{ $img }}"
                                            data-bs-target="#svc-{{ $service->id }}" role="button" data-bs-toggle="collapse" aria-controls="svc-{{ $service->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                            <h3 class="accordion-title">
                                                {{ $service->title }}
                                                <span class="text-body-1 num">({{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }})</span>
                                            </h3>
                                        </div>
                                        <div id="svc-{{ $service->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#accordion-services">
                                            <div class="accordion-content">
                                                <div class="text-body-3 text-neutral-300 text">{{ $service->summary }}</div>
                                                <div class="list-tags">
                                                    @foreach ($service->tagList() as $tag)
                                                        <span class="tags-item fw-semibold">{{ $tag }}</span>
                                                    @endforeach
                                                    <a href="{{ $service->url() }}" class="tags-item fw-semibold tags-link">Detaylar <i class="icon icon-arrow-top-right"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @php $firstService = $services->first(); @endphp
                        <div class="services-image effectFade fadeUp">
                            <img src="{{ \App\Support\Img::cover($firstService->image, $firstService->id + 2) }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Öne çıkan projeler --}}
        @if ($projects->isNotEmpty())
            <div id="works" class="section-featured-works flat-spacing pt-0">
                <div class="container">
                    <div class="heading-section mb-0">
                        <div class="heading-sub fw-semibold mx-auto effectFade fadeUp">Öne Çıkan Projeler</div>
                    </div>
                    @include('site.partials.featured-works', ['projects' => $projects])
                    <div class="text-center mt-5">
                        <a href="{{ url('/projeler') }}" class="tf-btn">Tüm Projeler</a>
                    </div>
                </div>
            </div>
        @endif

        @include('site.partials.process', ['steps' => $steps])
    </div>

    @include('site.partials.dark-block', ['testimonials' => $testimonials])

    {{-- Son blog yazıları --}}
    @if ($posts->isNotEmpty())
        <section class="section-blog flat-spacing">
            <div class="container">
                <div class="heading-section center mb-64">
                    <div class="heading-sub fw-semibold effectFade fadeUp">Blog</div>
                    <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Son Yazılarım</h2>
                </div>
                <div class="row">
                    @foreach ($posts as $post)
                        <div class="col-lg-4 col-md-6 mb-24">
                            @include('site.partials.blog-card', ['post' => $post])
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @include('site.partials.faq', ['faqs' => $faqs, 'class' => $posts->isNotEmpty() ? 'pt-0' : ''])
    @include('site.partials.contact-section')
@endsection
