@extends('general.layout.template')
@section('content')

<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{ asset('theme/assets/img/bg/bread-bg.png') }}">
    <div class="container">
        <div class="ori-breadcrumb-content text-center ul-li">
            <h1>Ekibimiz</h1>
            <ul>
                <li><a href="/">Anasayfa</a></li>
                <li>Ekibimiz</li>
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

<section id="ori-team-1" class="ori-team-section-1 position-relative" style="padding: 100px 0;">
    <div class="container">
        @if($data->count())
            <div class="row">
                @foreach($data as $item)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="ori-team-inner-item position-relative">
                            <div class="ori-team-img">
                                <a href="/ekibimiz/{{ $item->id }}/{{ \Illuminate\Support\Str::slug($item->name) }}">
                                    <img src="{{ asset('images/' . $item->image) }}" alt="{{ $item->name }}">
                                </a>
                            </div>
                            <div class="ori-team-text text-center position-absolute">
                                <h3><a href="/ekibimiz/{{ $item->id }}/{{ \Illuminate\Support\Str::slug($item->name) }}">{{ $item->name }}</a></h3>
                                <span>{{ $item->title }}</span>
                            </div>
                            <div class="ori-team-social text-center position-absolute">
                                @if($item->linkedin)<a target="_blank" href="{{ $item->linkedin }}"><i class="fab fa-linkedin-in"></i></a>@endif
                                @if($item->instagram)<a target="_blank" href="{{ $item->instagram }}"><i class="fab fa-instagram"></i></a>@endif
                                @if($item->twitter)<a target="_blank" href="{{ $item->twitter }}"><i class="fab fa-twitter"></i></a>@endif
                                @if($item->youtube)<a target="_blank" href="{{ $item->youtube }}"><i class="fab fa-youtube"></i></a>@endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center" style="color: var(--body-color);">Ekip bilgileri yakında eklenecek.</p>
        @endif
    </div>
</section>
@endsection
