@extends('general.layout.template')
@section('content')

<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{ asset('theme/assets/img/bg/bread-bg.png') }}">
    <div class="container">
        <div class="ori-breadcrumb-content text-center ul-li">
            <h1>{{ $item->name }}</h1>
            <ul>
                <li><a href="/">Anasayfa</a></li>
                <li><a href="/ekibimiz">Ekibimiz</a></li>
                <li>{{ $item->name }}</li>
            </ul>
        </div>
    </div>
    <div class="line_animation">
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
        <div class="line_area"></div>
    </div>
</section>

<section class="position-relative" style="padding: 100px 0;">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-4 mb-4">
                <div class="ori-team-inner-item position-relative">
                    <div class="ori-team-img">
                        <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}">
                    </div>
                </div>
                <div class="text-center mt-3">
                    <h3 style="color: var(--heading-color);">{{ $item->name }}</h3>
                    <span class="text-uppercase" style="color: var(--body-color);">{{ $item->title }}</span>
                    <div class="mt-3">
                        @if($item->linkedin)<a class="me-2" target="_blank" href="{{ $item->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                        @if($item->instagram)<a class="me-2" target="_blank" href="{{ $item->instagram }}"><i class="fab fa-instagram"></i></a>@endif
                        @if($item->twitter)<a class="me-2" target="_blank" href="{{ $item->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                        @if($item->youtube)<a target="_blank" href="{{ $item->youtube }}"><i class="fab fa-youtube"></i></a>@endif
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="pera-content" style="color: var(--body-color); font-size: 17px; line-height: 1.8;">
                    {!! $item->content !!}
                </div>
                <a href="/ekibimiz" class="btn-1 text-uppercase mt-4 d-inline-block">&larr; Tüm Ekibi Gör</a>
            </div>
        </div>
    </div>
</section>
@endsection
