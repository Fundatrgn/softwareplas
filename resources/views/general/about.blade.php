@extends('general.layout.template')
@section('content')
    <!-- Start of Breadcrumbs  section
             ============================================= -->
    <section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative"
        data-background="{{ asset('theme/assets/img/bg/bread-bg.png') }}">
        <div class="container">
            <div class="ori-breadcrumb-content text-center ul-li">
                <h1>Hakkımızda</h1>
                <ul>
                    <li><a href="/">Anasayfa</a></li>
                    <li>Hakkımızda</li>
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

    <!-- Start of About Play  section
             ============================================= -->
    {{-- <section id="ori-about-play" class="ori-about-play-section position-relative">
        @foreach ($data['hakkimizda'] as $item)    
		<div class="container">
			<div class="ori-about-play-top-content d-flex justify-content-between align-items-center">
				<div class="ori-inner-section-title">
					<span class="sub-title text-uppercase">{{$item->subtitle ?? ''}}</span>
					<h2>{{$item->title ?? ''}}</h2>
				</div>
			</div>
			<div class="ori-about-play-top-text">
			{!!$item->content ?? ''!!}
			</div>
		</div>
        @endforeach
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
	</section> --}}
    @php
        $count = 0;
    @endphp
    @foreach ($data['hakkimizda'] as $item)
        <section id="ori-vission" class="ori-vission-section position-relative" style="margin-bottom: 50px !important; {{ $count == 0 ? 'padding-top: 90px;' : '' }}">
            <div class="container">
                <div class="ori-vission-content">
                    <div class="row">
                        @if ($count % 2 == 0)
                            <div class="col-lg-6">
                                <div class="ori-vission-text-area">
                                    <div class="ori-service-why-choose-text">
                                        <div class="ori-inner-section-title">
                                            <span class="sub-title text-uppercase">{{ $item->subtitle ?? '' }}</span>
                                            <h2>{{ $item->title ?? '' }}

                                            </h2>
                                        </div>
                                        <div class="ori-service-why-choose-list-item ul-li-block">
                                            {!! $item->content ?? '' !!}
                                        </div>

                                    </div>
                                </div>
                            </div>
							<div class="col-lg-6">
								<div class="ori-about-play-area position-relative">
									<div class="ori-about-play-img">
										<img src="{{ asset('images/' . $item->image ?? '') }}" alt=""
											style="min-width: 100%">
									</div>
								</div>
							</div>
                        @else
						<div class="col-lg-6">
							<div class="ori-about-play-area position-relative">
								<div class="ori-about-play-img">
									<img src="{{ asset('images/' . $item->image ?? '') }}" alt=""
										style="min-width: 100%">
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="ori-vission-text-area">
								<div class="ori-service-why-choose-text">
									<div class="ori-inner-section-title">
										<span class="sub-title text-uppercase">{{ $item->subtitle ?? '' }}</span>
										<h2>{{ $item->title ?? '' }}

										</h2>
									</div>
									<div class="ori-service-why-choose-list-item ul-li-block">
										{!! $item->content ?? '' !!}
									</div>

								</div>
							</div>
						</div>
						
                        @endif

                      
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
        @php
            $count++;
        @endphp
    @endforeach
    <!-- End of About Play   section
             ============================================= -->
@endsection
