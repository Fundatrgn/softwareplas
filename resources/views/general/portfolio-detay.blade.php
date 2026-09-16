@extends('general.layout.template')
@section('content')
  
<!-- Start of Breadcrumbs  section
	============================================= -->
	<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{asset('theme/assets/img/bg/bread-bg.png')}}">
		<div class="container">
			<div class="ori-breadcrumb-content text-center ul-li">
				<h1>{{$data['title'] ?? ''}}</h1>
				<ul>
					<li><a href="/">Anasayfa</a></li>
					<li>Portfolio Detay</li>
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

<!-- Start of Portfolio Details  section
	============================================= -->
	<section id="ori-portfolio-details" class="ori-portfolio-details-section position-relative">
		<div class="container">
			<div class="ori-portfolio-details-content">
				<div class="ori-portfolio-details-video-play">
					<div class="ori-about-play-area position-relative">
						<div class="ori-about-play-img">
							<img src="{{asset('images/'.$data['referans']->image ?? '')}}" alt="" style="min-width:100%">
						</div>
						{{-- <div class="about-play-btn position-absolute">
							<a class="text-uppercase video_box d-flex align-items-center justify-content-center" href="https://www.youtube.com/watch?v=bIoPkZRVll">Play</a>
						</div> --}}
					</div>
				</div>
				<div class="ori-portfolio-details-text-info-wrapper">
					<div class="row">
						<div class="col-lg-8">
							<div class="ori-portfolio-details-text-wrap pera-content">
								<div class="ori-portfolio-details-text">
									<h3>{{$data['referans']->title ?? ''}}</h3>
									{!! $data['referans']->content ?? '' !!}
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="ori-portfolio-details-info ul-li-block">
								<h3>Bilgiler</h3>
								<ul>
									<li>Müşteri : <span>{{$data['referans']->musteri ?? ''}}</span></li>
									<li>Kategori  : <span>{{$data['referans']->category->title ?? ''}}</span></li>
									<li>Yazılım : <span>{{$data['referans']->yazilim ?? ''}}</span></li>
									<li>Konum : <span>{{$data['referans']->konum ?? ''}}</span></li>
									<li>Tarih : <span>{{$data['referans']->created_at ?? ''}}</span></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="ori-portfolio-details-tag-share d-flex justify-content-between align-items-center">
					<div class="ori-portfolio-details-tag">
						<a href="#">{{$data['referans']->category->title ?? ''}}</a>
						
					</div>
				
				</div>
				<div class="ori-single-details-prev-next-btn  d-flex align-items-center justify-content-between">
					@isset($data['previousReferans']->id)      
                    <div class="ori-single-prev-btn text-uppercase">
						<a href="/referanslarimiz/detay/{{$data['previousReferans']->id ?? ''}}/{{Str::slug($data['previousReferans']->title ??'')}}"><img src="{{asset('theme/assets/img/vector/prev.png')}}" alt=""> Önceki Proje</a>
					</div>
                    @endisset
                    @isset($data['nextReferans']->id)      

					<div class="ori-single-next-btn text-uppercase">
						<a href="/referanslarimiz/detay/{{$data['nextReferans']->id ?? ''}}/{{Str::slug($data['nextReferans']->title ?? '')}}">Sonraki Proje <img src="{{asset('theme/assets/img/vector/next.png')}}" alt=""></a>
					</div>
                    @endisset

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
