@extends('general.layout.template')

@section('content')

    <!-- Start of Breadcrumbs  section
                 ============================================= -->
    <section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative"
        data-background="{{ asset('theme/assets/img/bg/bread-bg.png') }}">
        <div class="container">
            <div class="ori-breadcrumb-content text-center ul-li">
                <h1>{{ $data['title'] ?? '' }}</h1>
                <ul>
                    <li><a href="/">Anasayfa</a></li>
                    <li>{{ $data['title'] ?? '' }}</li>
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
    <!-- End of Breadcrumbs section
                 ============================================= -->

    <!-- Start of Service  section
                 ============================================= -->
    @if ($data['alt'] == 0)
        <section id="ori-service-page-service" class="ori-service-page-service-section">
            <div class="container">
                <div class="ori-service-page-service-content">
                    <div class="row">
                        @foreach ($data['servicesCategory'] as $item)
                            <div class="col-lg-3 col-md-6">
                                <div class="ori-service-page-service-inner-item">
                                    <div class="service-icon">
                                        <i class="fal fa-comments-alt"></i>
                                    </div>
                                    <div class="service-text pera-content">
                                        <h3><a href="/hizmetler/{{$item->id}}/{{$item->slug}}">{{ $item->title ?? '' }}</a></h3>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <!-- End of Service  section
                 ============================================= -->


    <!-- Start of Service section
                 ============================================= -->
    @if ($data['alt'] == 1)
        @include('general.comp.hizmetler')
    @endif
    <!-- End of Service section
                 ============================================= -->

@endsection
