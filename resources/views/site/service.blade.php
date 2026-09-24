@extends('site.layout')

@section('title', $service->title)
@section('description', $service->summary)
@if ($service->image)
    @section('og_image', asset('images/' . $service->image))
@endif

@push('schema')
    <script type="application/ld+json">{!! json_encode([
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $service->title,
        'description' => $service->summary,
        'url' => $service->url(),
        'provider' => ['@id' => url('/') . '#person'],
        'areaServed' => 'TR',
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    @include('site.partials.page-hero', [
        'line1' => $service->title,
        'line2' => null,
        'variant' => 'v2',
        'text' => $service->summary,
    ])

    <div id="services" class="section-services-single flat-spacing pt-0">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-image mb-40 effectFade fadeZoom">
                        <img src="{{ \App\Support\Img::cover($service->image, $service->id + 2) }}" alt="{{ $service->title }}">
                    </div>
                </div>
            </div>
            <div class="row mb-80 justify-content-between">
                <div class="col-lg-8 md-mb-24">
                    <div class="text-secondary rich-text effectFade fadeUp">{!! $service->content !!}</div>
                </div>
                <div class="col-lg-3">
                    @if ($service->tagList())
                        <h2 class="h6 fw-semibold mb-16">Kapsam</h2>
                        <div class="list-tags mb-30 effectFade fadeUp">
                            @foreach ($service->tagList() as $tag)
                                <span class="tags-item fw-semibold">{{ $tag }}</span>
                            @endforeach
                        </div>
                    @endif
                    <a href="{{ url('/iletisim') }}" class="tf-btn mb-30">Bu konuda görüşelim</a>
                    @if ($others->isNotEmpty())
                        <h2 class="h6 fw-semibold mb-16">Diğer Hizmetler</h2>
                        <ul class="d-grid gap-8">
                            @foreach ($others as $other)
                                <li><a href="{{ $other->url() }}" class="link1">+ {{ $other->title }}</a></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="box-white">
        @include('site.partials.process', ['steps' => $steps, 'class' => ''])
    </div>
    @include('site.partials.contact-section')
@endsection
