@extends('general.layout.template')
@section('content')
    <!-- Start of Breadcrumbs  section
                                 ============================================= -->
    <section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative"
        data-background="{{ asset('theme/assets/img/bg/bread-bg.png') }}">
        <div class="container">
            <div class="ori-breadcrumb-content text-center ul-li">
                <h1>Portfolio</h1>
                <ul>
                    <li><a href="index.html">Anasayfa</a></li>
                    <li>Portfolio</li>
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

    <section id="ori-portfolio-feed" class="ori-portfolio-feed-section position-relative">
        <div class="container">
            <div class="ori-portfolio-filter-btn ul-li text-center">
                <ul id="filters" class="nav-gallery">
                    <li class="filtr-button filtr-active" data-filter="all">Hepsini Gör</li>
                    @foreach ($data['referansCategory'] as $item)
                        <li class="filtr-button" data-filter="{{ $item->id ?? '' }}">{{ $item->title ?? '' }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="ori-portfolio-feed-item-wrapper filtr-container row">
                @foreach ($data['referans'] as $item)
                    <div class="col-lg-4 col-sm-6 filtr-item" data-category="{{$item->kategori}}" data-sort="{{$item->category->title ?? ''}}">
                        <div class="ori-portfolio-item position-relative">
                            <div class="portfolio-img">
                                <img src="{{asset('images/'.$item->image)}}" alt="">
                            </div>
                            <div class="portfolio-text">
                                <span class="port-category text-uppercase"><a href="">{{$item->category->title ?? ''}}</a></span>
                                <h3><a href="/referanslarimiz/detay/{{$item->id}}/{{Str::slug($item->title)}}">{{$item->title ?? ''}}</a></h3>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            {{-- <div class="ori-portfolio-more-btn text-center">
                <div class="ori-btn-1 text-uppercase">
                    <a href="#">load more projects</a>
                </div>
            </div> --}}
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
@endsection
