<!DOCTYPE html>
<html lang="tr">
<script>
    // Kaydedilmiş açık/koyu tema tercihi, sayfa içeriği boyanmadan
    // (CSS yüklenmeden) hemen uygulanır; aksi halde önce açık temayla
    // çizilip sonra koyuya geçen rahatsız edici bir "flash" oluşur.
    (function () {
        try {
            var kayitli = localStorage.getItem('siteTheme');
            if (kayitli === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
            }
        } catch (e) {}
    })();
</script>

<head>
    <meta charset="UTF-8">
    <meta name="author" content="{{ $settings->author ?? '' }}">
    <meta name="keywords" content="{{ $settings->keywords ?? '' }}">
    <meta name="description" content="{{ $settings->description ?? '' }}">
    <!-- Open Graph / Sosyal Medya Paylaşım Kartı -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $settings->site_title ?? '' }}">
    <meta property="og:description" content="{{ $settings->description ?? '' }}">
    <meta property="og:image" content="{{ asset('images/og-image.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <!-- Favicon Icon -->
    <link rel="icon" href="{{ asset('images/' . ($settings->favicon ?? '')) }}">
    <!-- Site Title -->
    <title>{{ $settings->site_title }}</title>
    <link rel="shortcut icon" href="{{ asset('images/' . $settings->favicon ?? '') }}" type="image/x-icon">
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{ asset('theme/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/video.min.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/global.css') }}?v=34">
    <style>
        /* Admin panelinden ("Ayarlar > Site Görünümü / Renkler") seçilen
           renkler burada :root değişkenlerinin üzerine yazılır. Herhangi
           bir CSS dosyasına dokunmadan sitenin ana renklerini değiştirir. */
        :root {
            --base-color: {{ $settings->accent_color ?? '#D9784B' }};
            --base-color-1: {{ $settings->accent_color ?? '#D9784B' }};
            --base-color-3: {{ $settings->accent_color ?? '#D9784B' }};
            --base-color-5: {{ $settings->accent_color ?? '#D9784B' }};
            --base-color-7: {{ $settings->accent_color ?? '#D9784B' }};
            --base-color-2: {{ $settings->secondary_color ?? '#7FA36F' }};
            --base-color-4: {{ $settings->secondary_color ?? '#7FA36F' }};
            --base-color-6: {{ $settings->secondary_color ?? '#7FA36F' }};
            --heading-color: {{ $settings->heading_color ?? '#1F2D30' }};
            --body-color: {{ $settings->body_text_color ?? '#4B5A5E' }};
            --page-bg: {{ $settings->background_color ?? '#F7F5F0' }};
            --dark-surface: #FFFFFF;
            --surface-border: rgba(31, 45, 48, 0.12);
            --on-surface: {{ $settings->heading_color ?? '#1F2D30' }};
            --on-surface-muted: {{ $settings->body_text_color ?? '#4B5A5E' }};
        }
    </style>
    <link rel="stylesheet" href="{{ asset('theme/assets/css/style.css') }}?v=34">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/psikolog-theme.css') }}?v=34">
</head>

<body class="ori-digital-studio">
    <div class="up">
        <a href="#" class="scrollup text-center"><i class="fas fa-chevron-up"></i></a>
    </div>
    <div class="cursor"></div>
    <!-- Start of header section
 ============================================= -->
    <header id="ori-header" class="ori-header-section header-style-one">
        <div class="ori-header-content-area">
            <div class="ori-header-content d-flex align-items-center justify-content-between">
                <div class="brand-logo">
                    <a href="#">
                        <img src="{{ asset('images/' . $settings->image ?? '') }}" alt="Site Logosu" style="max-width: 190px; width:100%; height:auto;">
                    </a>
                </div>
                <div class="ori-main-navigation-area">
                    <nav class="ori-main-navigation clearfix ul-li">
                        <ul id="main-nav" class="nav navbar-nav clearfix">
                            <li class="dropdown ori-megamenu">
                                <a href="/">ANASAYFA</a>
                            </li>
                            <!-- <li><a target="_blank" href="#"></a></li> -->
                            <li class="dropdown">
                                <a href="#">Kurumsal</a>
                                <ul class="dropdown-menu clearfix">
                                    <li><a href="/hakkimizda">Hakkımızda </a></li>
                                    {{-- <li><a  href="./ekibimiz.html">Ekibimiz</a></li> --}}
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="/hizmetler">Hizmetlerimiz</a>
                                <ul class="dropdown-menu clearfix">
                                    {{-- @foreach ($services as $service)
                                        @if ($service->category_id == $item->id)
                                            <li>
                                                <a
                                                    href="/hizmetlerimiz/{{ $service->slug ?? '' }}">{{ $service->title ?? '' }}</a>
                                            </li>
                                        @endif
                                    @endforeach --}}
                                    @foreach ($services_categories as $item)
                                    <li class="menu-item-has-children">
                                        <a href="/hizmetler/{{ $item->id ?? '' }}/{{ $item->slug ?? '' }}">{{ $item->title ?? '' }}</a>
                                        {{-- <ul>
                                            @foreach ($services as $service)
                                                @if ($service->category_id == $item->id)
                                                    <li>
                                                        <a href="/hizmetlerimiz/{{$service->slug ?? ''}}">{{$service->title ?? ''}}</a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul> --}}
                                    </li>
                                @endforeach
                                </ul>
                            </li>
                            <li>
                                <a class="" href="/blog">Blog</a>
                            </li>
                            <li class="">
                                <a href="/sss">SSS</a>
                            </li>
                            <li class="">
                                <a href="/iletisim">İletişim</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="ori-header-sidebar-search d-flex align-items-center">
                    <button type="button" id="theme-toggle-btn" aria-label="Koyu/Açık tema"
                        style="display:inline-flex; align-items:center; justify-content:center; width:42px; height:42px; border-radius:50%; border:1px solid var(--surface-border); background:var(--dark-surface); color:var(--heading-color); margin-right:14px; cursor:pointer; font-size:16px;">
                        <i class="fas fa-moon" id="theme-toggle-icon"></i>
                    </button>
                    <a href="/randevu" class="ori-header-randevu-btn" style="display:inline-block; background-color:var(--base-color-1); color:#fff; padding:12px 26px; border-radius:30px; font-weight:700; font-size:14px; white-space:nowrap; margin-right:20px;">Randevu Al</a>
                    <div class="ori-sidenav-btn navSidebar-button">
                        <button><i class="fal fa-bars"></i></button>
                    </div>
                </div>
            </div>
            <div class="mobile_menu position-relative">
                <div class="mobile_menu_button open_mobile_menu">
                    <i class="fal fa-bars"></i>
                </div>
                <div class="mobile_menu_wrap">
                    <div class="mobile_menu_overlay open_mobile_menu"></div>
                    <div class="mobile_menu_content">
                        <div class="mobile_menu_close open_mobile_menu">
                            <i class="fal fa-times"></i>
                        </div>
                        <div class="m-brand-logo d-flex align-items-center justify-content-between">
                            <a href="/"><img src="{{ asset('images/' . ($settings->image ?? '')) }}" alt="" style="max-width:170px; width:100%; height:auto;"></a>
                            <button type="button" id="theme-toggle-btn-mobile" aria-label="Koyu/Açık tema"
                                style="display:inline-flex; align-items:center; justify-content:center; width:38px; height:38px; border-radius:50%; border:1px solid var(--surface-border); background:var(--page-bg); color:var(--heading-color); cursor:pointer; font-size:15px;">
                                <i class="fas fa-moon" id="theme-toggle-icon-mobile"></i>
                            </button>
                        </div>
                        <nav class="mobile-main-navigation  clearfix ul-li">
                            <ul id="m-main-nav" class="nav navbar-nav clearfix">
                                <li class="dropdown ori-megamenu">
                                    <a href="/">ANASAYFA</a>
                                </li>
                                <!-- <li><a target="_blank" href="#"></a></li> -->
                                <li class="dropdown">
                                    <a href="#">Kurumsal</a>
                                    <ul class="dropdown-menu clearfix">
                                        <li><a href="/hakkimizda">Hakkımızda </a></li>
                                        {{-- <li><a  href="./ekibimiz.html">Ekibimiz</a></li> --}}
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="/hizmetler">Hizmetlerimiz</a>
                                    <ul class="dropdown-menu clearfix">
                                        {{-- @foreach ($services as $service)
                                            @if ($service->category_id == $item->id)
                                                <li>
                                                    <a
                                                        href="/hizmetlerimiz/{{ $service->slug ?? '' }}">{{ $service->title ?? '' }}</a>
                                                </li>
                                            @endif
                                        @endforeach --}}
                                        @foreach ($services_categories as $item)
                                        <li class="menu-item-has-children">
                                            <a href="/hizmetler/{{ $item->id ?? '' }}/{{ $item->slug ?? '' }}">{{ $item->title ?? '' }}</a>
                                            {{-- <ul>
                                                @foreach ($services as $service)
                                                    @if ($service->category_id == $item->id)
                                                        <li>
                                                            <a href="/hizmetlerimiz/{{$service->slug ?? ''}}">{{$service->title ?? ''}}</a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul> --}}
                                        </li>
                                    @endforeach
                                    </ul>
                                </li>
                                <li>
                                    <a class="" href="/blog">Blog</a>
                                </li>
                                <li class="">
                                    <a href="/sss">SSS</a>
                                </li>
                                <li class="">
                                    <a href="/randevu" style="color: var(--base-color-1); font-weight:700;">Randevu Al</a>
                                </li>
                                <li class="">
                                    <a href="/iletisim">İletişim</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <!-- /Mobile-Menu -->
            </div>
        </div>
    </header><!-- /header -->

    <!-- Search PopUp -->
    <div class="search-popup">
        <button class="close-search style-two"><span class="fal fa-times"></span></button>
        <button class="close-search"><span class="fa fa-arrow-up"></span></button>
        <form method="get" action="/blog/search">
            <div class="form-group">
                <input type="search" name="search" value="" placeholder="Blogda ara..." required="">
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    </div>
    <!-- Sidebar sidebar Item -->
    <div class="xs-sidebar-group info-group">
        <div class="xs-overlay xs-bg-black">
            <div class="row loader-area">
                <div class="col-3 preloader-wrap">
                    <div class="loader-bg"></div>
                </div>
                <div class="col-3 preloader-wrap">
                    <div class="loader-bg"></div>
                </div>
                <div class="col-3 preloader-wrap">
                    <div class="loader-bg"></div>
                </div>
                <div class="col-3 preloader-wrap">
                    <div class="loader-bg"></div>
                </div>
            </div>
        </div>
        <div class="xs-sidebar-widget">
            <div class="sidebar-widget-container">
                <div class="widget-heading">
                    <a href="#" class="close-side-widget">
                        X
                    </a>
                </div>
                <div class="sidebar-textwidget">

                    <div class="sidebar-info-contents headline pera-content">
                        <div class="content-inner">
                            <div class="logo">
                                <a href="/"><img src="{{ asset('images/' . ($settings->image ?? '')) }}" alt="" style="max-width:180px; width:100%; height:auto;"></a>
                            </div>
                            <div class="content-box">
                                <h5>Hakkımda</h5>
                                <p class="text">{{ $settings->sidebar_bio ?? 'Manisa\'da ve online olarak bireysel ve çift terapisi hizmeti veriyorum. Randevu almak için benimle iletişime geçebilirsiniz.' }}</p>
                            </div>
                            <div class="content-box">
                                <h5>Sosyal Medya</h5>
                                <ul class="social-box">
                                    <li><a target="_blank" href="{{ $settings->facebook ?? '' }}"
                                            class="fab fa-facebook-f"></a></li>
                                    <li><a target="_blank" href="{{ $settings->twitter ?? '' }}"
                                            class="fab fa-twitter"></a></li>
                                    {{-- <li><a target="_blank" href="https://dribbble.com/" class="fab fa-dribbble"></a></li> --}}
                                    <li><a target="_blank" href="{{ $settings->linkedin ?? '' }}"
                                            class="fab fa-linkedin"></a></li>
                                    <li><a target="_blank" href="{{ $settings->instagram ?? '' }}"
                                            class="fab fa-instagram"></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    (function () {
        function guncelIkon() {
            var koyu = document.documentElement.getAttribute('data-theme') === 'dark';
            ['theme-toggle-icon', 'theme-toggle-icon-mobile'].forEach(function (id) {
                var el = document.getElementById(id);
                if (el) el.className = koyu ? 'fas fa-sun' : 'fas fa-moon';
            });
        }

        function temayiDegistir() {
            var koyu = document.documentElement.getAttribute('data-theme') === 'dark';
            if (koyu) {
                document.documentElement.removeAttribute('data-theme');
                try { localStorage.setItem('siteTheme', 'light'); } catch (e) {}
            } else {
                document.documentElement.setAttribute('data-theme', 'dark');
                try { localStorage.setItem('siteTheme', 'dark'); } catch (e) {}
            }
            guncelIkon();
        }

        ['theme-toggle-btn', 'theme-toggle-btn-mobile'].forEach(function (id) {
            var btn = document.getElementById(id);
            if (btn) btn.addEventListener('click', temayiDegistir);
        });

        guncelIkon();
    })();
    </script>
