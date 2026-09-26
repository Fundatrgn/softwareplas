<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Danışan Portalı | {{ $settings->site_title ?? 'Marya' }}</title>
    <link rel="icon" href="{{ asset('images/' . ($settings->favicon ?? '')) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('theme/assets/css/bootstrap.min.css') }}">
    <style>
        :root {
            --base-color-1: {{ $settings->accent_color ?? '#223B52' }};
            --heading-color: {{ $settings->heading_color ?? '#18212B' }};
            --body-color: {{ $settings->body_text_color ?? '#45566B' }};
            --page-bg: {{ $settings->background_color ?? '#F7F3EA' }};
        }
        body { font-family: 'Montserrat', sans-serif; background: var(--page-bg); color: var(--body-color); min-height: 100vh; }
        .danisan-portal-wrap { max-width: 640px; margin: 0 auto; padding: 40px 16px; }
        .danisan-portal-logo { text-align: center; margin-bottom: 24px; }
        .danisan-portal-logo img { max-width: 160px; }
        .danisan-portal-card { background: #fff; border-radius: 12px; padding: 32px; box-shadow: 0 8px 24px rgba(24,33,43,0.08); }
        h1, h2, h3, h4, h5 { color: var(--heading-color); font-weight: 700; }
        .btn-marya { background: var(--base-color-1); color: #fff; border: none; }
        .btn-marya:hover { background: var(--base-color-1); opacity: 0.9; color: #fff; }
        a { color: var(--base-color-1); }
        .danisan-portal-topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
    </style>
</head>
<body>
    <div class="danisan-portal-wrap">
        <div class="danisan-portal-logo">
            <a href="/danisan/panel"><img src="{{ asset('images/' . ($settings->image ?? '')) }}" alt="Logo"></a>
        </div>
        @yield('content')
    </div>
</body>
</html>
