{{-- Blog sayfalarındaki sade başlık + gezinti yolu. $title, $crumbs = [[url, etiket], ...] --}}
<div class="section-page-title">
    <div class="container text-center">
        <h1 class="page-title fw-semibold effectFade fadeZoom">{{ $title }}</h1>
        <nav class="breadcrumbs effectFade fadeUp" aria-label="Gezinti yolu">
            <a href="{{ url('/') }}" class="link1">Anasayfa</a>
            @foreach ($crumbs as [$crumbUrl, $crumbLabel])
                <div>/</div>
                @if ($crumbUrl)
                    <a href="{{ $crumbUrl }}" class="link1">{{ $crumbLabel }}</a>
                @else
                    <div>{{ $crumbLabel }}</div>
                @endif
            @endforeach
        </nav>
    </div>
</div>
