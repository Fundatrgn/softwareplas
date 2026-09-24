@extends('site.layout')

@section('title', 'Projeler ve Yaptığım İşler')
@section('description', ($settings?->author ?: 'Yunuscan ZEYBEK') . ' tarafından hayata geçirilen projeler: ' . $projects->pluck('title')->take(6)->implode(', ') . '.')

@section('content')
    @include('site.partials.page-hero', [
        'line1' => 'Yaptığım',
        'line2' => 'İşler',
        'text' => 'Web yazılımı, dijital medya ve kurumsal iletişim alanlarında hayata geçirdiğim projelerden seçkiler.',
    ])

    <div id="works" class="section-featured-works flat-spacing">
        <div class="container">
            <div class="heading-section mb-0">
                <div class="heading-sub fw-semibold mx-auto effectFade fadeUp">Projeler</div>
            </div>
            @if ($projects->isEmpty())
                <p class="text-center text-secondary mt-5">Projeler çok yakında burada olacak.</p>
            @endif
            @include('site.partials.featured-works', ['projects' => $projects])
        </div>
    </div>

    @include('site.partials.dark-block', ['testimonials' => $testimonials])
    @include('site.partials.contact-section')
@endsection
