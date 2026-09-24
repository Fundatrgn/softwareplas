@php
    $name = $settings?->author ?: 'Yunuscan ZEYBEK';
    $pageTitle = trim($__env->yieldContent('title'));
    $fullTitle = $pageTitle ? $pageTitle . ' | ' . $name : ($settings?->site_title ?: $name);
    $metaDescription = trim($__env->yieldContent('description')) ?: ($settings?->description ?? '');
    $canonical = trim($__env->yieldContent('canonical')) ?: url()->current();
    $ogImage = trim($__env->yieldContent('og_image'))
        ?: ($settings?->og_image ? asset('images/' . $settings->og_image) : ($settings?->profile_image ? asset('images/' . $settings->profile_image) : null));
    $nav = [
        ['/', 'Anasayfa'],
        ['/yunuscan-zeybek-kimdir', 'Hakkımda'],
        ['/hizmetler', 'Hizmetler'],
        ['/projeler', 'Projeler'],
        ['/blog', 'Blog'],
        ['/iletisim', 'İletişim'],
    ];
    $isActive = fn ($path) => $path === '/' ? request()->is('/') : request()->is(ltrim($path, '/') . '*');
    $socials = $settings?->socials() ?? [];
@endphp
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <title>{{ $fullTitle }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ \Illuminate\Support\Str::limit(strip_tags($metaDescription), 300, '') }}">
    @if ($settings?->keywords)
        <meta name="keywords" content="{{ $settings->keywords }}">
    @endif
    <meta name="author" content="{{ $name }}">
    <link rel="canonical" href="{{ $canonical }}">
    @if ($settings?->google_verification)
        <meta name="google-site-verification" content="{{ $settings->google_verification }}">
    @endif

    {{-- Sosyal medya paylaşım önizlemesi (Open Graph / X) --}}
    <meta property="og:locale" content="tr_TR">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="{{ $name }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($metaDescription), 200, '') }}">
    <meta property="og:url" content="{{ $canonical }}">
    @if ($ogImage)
        <meta property="og:image" content="{{ $ogImage }}">
    @endif
    <meta name="twitter:card" content="{{ $ogImage ? 'summary_large_image' : 'summary' }}">
    <meta name="twitter:title" content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit(strip_tags($metaDescription), 200, '') }}">

    @include('site.partials.schema')
    @stack('schema')

    <link rel="stylesheet" href="{{ asset('site/fonts/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('site/icon/icomoon/style.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('site/css/custom.css') }}?v=1">
    <style>
        :root { --brand: {{ $settings?->accent_color ?: '#FD3A25' }}; }
    </style>

    @if ($settings?->favicon)
        <link rel="icon" href="{{ asset('images/' . $settings->favicon) }}">
        <link rel="apple-touch-icon" href="{{ asset('images/' . $settings->favicon) }}">
    @else
        <link rel="icon" href="{{ asset('site/images/yz/favicon.svg') }}">
    @endif

    @if ($settings?->analytics_id)
        <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings->analytics_id }}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', @json($settings->analytics_id));
        </script>
    @endif
</head>

<body class="@yield('body_class')">
    {{-- Şablonun imleç efekti betiği bu öğeyi bekliyor; gizli kalır. --}}
    <canvas class="cursor-trail" id="trail" style="display: none;"></canvas>

    <button id="goTop" aria-label="Yukarı çık">
        <span class="border-progress"></span>
        <span class="ic-wrap">
            <span class="icon icon-long-arrow-alt-up-solid"></span>
        </span>
    </button>

    <main id="wrapper">
        <header class="tf-header header2">
            <div class="header-inner">
                <a href="{{ url('/') }}" class="logo-site" aria-label="{{ $name }} anasayfa">
                    @include('site.partials.logo', ['variant' => 'header'])
                </a>
                <nav class="box-navigation" aria-label="Ana menü">
                    <ul class="nav-menu-main">
                        @foreach ($nav as [$path, $label])
                            @if ($path === '/hizmetler' && $menu_services->isNotEmpty())
                                <li class="menu-item has-child">
                                    <a href="{{ url($path) }}" class="item-link link1 {{ $isActive($path) ? 'active' : '' }}">{{ $label }}</a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item"><a href="{{ url($path) }}" class="item-link link1">Tüm Hizmetler</a></li>
                                        @foreach ($menu_services as $s)
                                            <li class="sub-menu-item"><a href="{{ url('/hizmetler/' . $s->slug) }}" class="item-link link1">{{ $s->title }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="menu-item">
                                    <a href="{{ url($path) }}" class="item-link link1 {{ $isActive($path) ? 'active' : '' }}">{{ $label }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </nav>
                <a href="{{ url('/iletisim') }}" class="tf-btn d-lg-flex d-none">İletişime Geç</a>
                <a href="#" class="tf-btn open-mb-menu mobile-menu d-lg-none d-flex" aria-label="Menüyü aç">
                    <i class="icon icon-grip-lines-solid"></i>
                </a>
            </div>
        </header>

        @yield('content')

        <footer>
            <div class="footer-image">
                <div class="footer-wordmark effectFade fadeUp" aria-hidden="true">{{ $name }}</div>
            </div>
            <div class="container">
                <div class="footer-content">
                    <a href="{{ url('/') }}" class="footer-logo" aria-label="{{ $name }}">
                        @include('site.partials.logo', ['variant' => 'footer'])
                    </a>
                    <div class="title h6 fw-semibold">{{ $settings?->footer_title ?: 'Sosyal medyada bağlantıda kalalım' }}</div>
                    @if ($settings?->availability_text)
                        <div class="text">{{ $settings->availability_text }}</div>
                    @endif
                    @if ($socials)
                        <div class="tf-social-1 justify-content-center flex-wrap">
                            @foreach ($socials as $social)
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener me" class="text-body-1 fw-semibold">
                                    {{ $social['label'] }}
                                    <div class="social-item"><i class="icon {{ $social['icon'] }}"></i></div>
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="footer-bottom">
                    <ul class="footer-links d-flex gap-24 align-items-center flex-wrap">
                        @foreach (array_slice($nav, 1) as [$path, $label])
                            <li><a href="{{ url($path) }}" class="fw-semibold link-underline link1">{{ $label }}</a></li>
                        @endforeach
                        @foreach ($footer_links as $link)
                            <li><a href="{{ $link->url }}" class="fw-semibold link-underline link1">{{ $link->title }}</a></li>
                        @endforeach
                    </ul>
                    <p class="text-secondary coppy-rights text-center">
                        © {{ date('Y') }} {{ $settings?->footer_copyright_text ?: $name . ' - Tüm Hakları Saklıdır' }}
                    </p>
                    <a href="#" class="action-go-top d-flex gap-8 align-items-center justify-content-end link1">
                        <span class="fw-semibold">Yukarı çık</span>
                        <i class="icon icon-long-arrow-alt-up-solid fs-20"></i>
                    </a>
                </div>
            </div>
        </footer>
    </main>

    {{-- Mobil menü --}}
    <div class="offcanvas-menu">
        <div class="offcanvas-content">
            <div class="container h-100">
                <div class="offcanvas-content_wrapin">
                    <div class="canvas_head">
                        <a href="{{ url('/') }}" class="logo-site">
                            @include('site.partials.logo', ['variant' => 'header'])
                        </a>
                        <div class="btn-mobile-menu close-mb-menu text-caption link">
                            <i class="icon icon-close"></i>
                            KAPAT
                        </div>
                    </div>
                    <div class="canvas_center">
                        <ul class="nav-ul-mb" id="mobile-menu">
                            @foreach ($nav as [$path, $label])
                                <li>
                                    <div class="item">
                                        <a href="{{ url($path) }}" class="mb-menu-link text-display-1">
                                            <span class="text">{{ $label }}</span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="canvas_foot">
                        <div class="left">
                            @if ($settings?->email)
                                <a href="mailto:{{ $settings->email }}" class="text-caption text-neutral-200">{{ $settings->email }}</a>
                            @endif
                            @if ($settings?->location_text)
                                <p class="text-caption text-neutral-200">{{ $settings->location_text }}</p>
                            @endif
                        </div>
                        <div class="right">
                            @foreach ($socials as $social)
                                <a href="{{ $social['url'] }}" target="_blank" rel="noopener" class="tf-link-icon text-caption text-neutral-200">
                                    <i class="icon icon-arrow-top-right"></i>
                                    {{ mb_strtoupper($social['label']) }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($settings?->whatsappDigits())
        <a href="https://wa.me/{{ $settings->whatsappDigits() }}" class="whatsapp-float" target="_blank" rel="noopener" aria-label="WhatsApp ile yazın">
            <svg viewBox="0 0 32 32" width="28" height="28" fill="currentColor" aria-hidden="true"><path d="M16.02 3C8.84 3 3 8.83 3 16c0 2.29.6 4.52 1.74 6.49L3 29l6.68-1.72A12.96 12.96 0 0 0 16.02 29C23.2 29 29 23.17 29 16S23.2 3 16.02 3Zm0 23.64c-2.01 0-3.97-.54-5.69-1.56l-.41-.24-3.96 1.02 1.06-3.86-.27-.4A10.6 10.6 0 0 1 5.38 16c0-5.86 4.78-10.63 10.64-10.63 5.86 0 10.62 4.77 10.62 10.63 0 5.87-4.76 10.64-10.62 10.64Zm5.83-7.96c-.32-.16-1.89-.93-2.18-1.04-.29-.11-.5-.16-.72.16-.21.32-.82 1.04-1.01 1.25-.19.21-.37.24-.69.08-.32-.16-1.35-.5-2.57-1.59-.95-.85-1.59-1.9-1.78-2.22-.19-.32-.02-.49.14-.65.14-.14.32-.37.48-.56.16-.19.21-.32.32-.53.11-.21.05-.4-.03-.56-.08-.16-.72-1.73-.98-2.37-.26-.62-.52-.54-.72-.55h-.61c-.21 0-.56.08-.85.4-.29.32-1.12 1.09-1.12 2.66s1.14 3.09 1.3 3.3c.16.21 2.25 3.44 5.46 4.82.76.33 1.36.53 1.82.68.77.24 1.46.21 2.01.13.61-.09 1.89-.77 2.16-1.52.27-.75.27-1.39.19-1.52-.08-.13-.29-.21-.61-.37Z"/></svg>
        </a>
    @endif

    <script src="{{ asset('site/js/jquery.min.js') }}"></script>
    <script src="{{ asset('site/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('site/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('site/js/countto.js') }}"></script>
    <script src="{{ asset('site/js/carousel.js') }}"></script>
    <script src="{{ asset('site/js/infinityslide.js') }}"></script>
    <script src="{{ asset('site/js/ScrollSmooth.js') }}"></script>
    <script src="{{ asset('site/js/gsap.min.js') }}"></script>
    <script src="{{ asset('site/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('site/js/ScrollToPlugin.min.js') }}"></script>
    <script src="{{ asset('site/js/gsapAnimation.js') }}"></script>
    <script src="{{ asset('site/js/main.js') }}"></script>
    @stack('scripts')
</body>

</html>
