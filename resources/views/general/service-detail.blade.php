@extends('general.layout.template')
@section('content')
    <section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative"
        data-background="{{ asset('theme/assets/img/bg/bread-bg.png') }}">
        <div class="container">
            <div class="ori-breadcrumb-content text-center ul-li">
                <h1>{{ $data['hizmet']->title ?? '' }}</h1>
                <ul>
                    <li><a href="/">Anasayfa</a></li>
                    <li>Hizmet Detay</li>
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

    <section id="ori-service-details" class="ori-service-details-section position-relative">
        <div class="container">
            <div class="ori-service-details-content-wrapper">
                <div class="row">
                    <div class="col-lg-8">
                        {{-- <div class="ori-service-why-choose"> --}}
                            <div class="row">
                                @foreach ($data['hizmetler'] as $item)
                                <div class="ori-inner-section-title" style="margin-bottom: 50px !important">
                                    <span class="sub-title text-uppercase">{{$item->subtitle ?? ''}}</span>
                                    <h2>{{$item->title ?? ''}}
                                    </h2>
                                </div>
                                <br>
                                <br>
                                <div class="col-lg-12">
                                    <div class="ori-service-why-choose-img">
                                        <img src="{{asset('images/'.$item->image ?? '')}}" alt="{{$item->keywords ?? ''}}">
                                    </div>
                                    <br>
                                    <br>
                                </div>
                                <div class="col-lg-12">
                                      {!! $item->content ?? ''!!}
                                </div>

                                <br><br><br>
                                @endforeach
                            </div>
                        {{-- </div> --}}
                    </div>
                    <div class="col-lg-4">
                        <div class="ori-service-details-sidebar-widget-area">
                            <div class="ori-service-details-widget ul-li-block">
                                <div class="category-widget">
                                    <h3 class="widget-title">Diğer Hizmetlerimiz</h3>
                                    <ul>

                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($data['genelHizmetler'] as $item)
                                            <li><a href="/hizmetler/detay/{{$item->id ?? ''}}/{{$item->slug ?? ''}}"><span>0{{$count}}</span> {{$item->title ?? ''}}</a></li>
                                            @php
                                            $count++;
                                        @endphp
                                            @endforeach

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
@endsection
