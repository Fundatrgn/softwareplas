@extends('site.layout')

@section('title', $project->title)
@section('description', $project->summary)
@if ($project->image)
    @section('og_image', asset('images/' . $project->image))
@endif

@push('schema')
    <script type="application/ld+json">{!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'CreativeWork',
        'name' => $project->title,
        'description' => $project->summary,
        'url' => $project->url(),
        'image' => $project->image ? asset('images/' . $project->image) : null,
        'dateCreated' => $project->year,
        'genre' => $project->category,
        'creator' => ['@id' => url('/') . '#person'],
        'sameAs' => $project->url ?: null,
    ]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    @include('site.partials.page-hero', [
        'line1' => $project->title,
        'line2' => null,
        'variant' => 'v2',
        'text' => $project->summary,
    ])

    <div class="section-work-single flat-spacing pt-0">
        <div class="container">
            <div class="row mb-32">
                <div class="col-12">
                    <div class="wrap-image mb-60 effectFade fadeZoom">
                        <img src="{{ \App\Support\Img::cover($project->image, $project->id) }}" alt="{{ $project->title }}">
                    </div>
                </div>
            </div>
            <div class="row mb-60">
                @if ($project->deliverableList())
                    <div class="col-md-6 md-mb-24">
                        <div class="text-body-1 fw-semibold text-secondary mb-15">NELER YAPILDI</div>
                        <div class="list-tags">
                            @foreach ($project->deliverableList() as $d)
                                <span class="tags-item fw-semibold">{{ $d }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
                @foreach ([['ALAN', $project->category], ['MÜŞTERİ / KURUM', $project->client], ['YIL', $project->year]] as [$label, $value])
                    @if ($value)
                        <div class="col-md-2 col-6 md-mb-24">
                            <div class="text-body-1 fw-semibold text-secondary mb-15">{{ $label }}</div>
                            <div class="list-tags"><span class="tags-item fw-semibold">{{ $value }}</span></div>
                        </div>
                    @endif
                @endforeach
            </div>
            <div class="row mb-60">
                <div class="col-lg-10">
                    <h2 class="heading fw-semibold mb-32 effectFade fadeUp">Proje Detayları</h2>
                    <div class="text-secondary rich-text effectFade fadeUp">{!! $project->content ?: e($project->summary) !!}</div>
                    @if ($project->url)
                        <a href="{{ $project->url }}" target="_blank" rel="noopener" class="tf-btn mt-4">Projeyi ziyaret et <i class="icon icon-arrow-top-right"></i></a>
                    @endif
                </div>
            </div>
            @if ($project->image_2 || $project->image_3)
                <div class="row">
                    @foreach (array_filter([$project->image_2, $project->image_3]) as $img)
                        <div class="col-md-6 md-mb-24">
                            <div class="image effectFade fadeUp">
                                <img src="{{ asset('images/' . $img) }}" alt="{{ $project->title }}" loading="lazy">
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    @if ($next)
        <div class="section-featured-works flat-spacing">
            <div class="container">
                <div class="heading-section center mb-64">
                    <div class="heading-sub fw-semibold effectFade fadeUp">Proje</div>
                    <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Sıradaki Proje</h2>
                </div>
                @include('site.partials.featured-works', ['projects' => collect([$next])])
            </div>
        </div>
    @endif

    @include('site.partials.contact-section')
@endsection
