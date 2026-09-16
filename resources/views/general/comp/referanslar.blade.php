
<!-- Start of Sponsor section
	============================================= -->
	<section id="ori-sponsor-1" class="ori-sponsor-section-1 position-relative">
		<div class="container">
			<div class="ori-sponsor-title text-uppercase text-center">
				<h3><i></i> <span>Referanslarımız</span> <i></i> </h3>
			</div>
			<div class="ori-sponsor-content">
				<div class="ori-sponsor-slider">
                    @foreach ($data['referanslogo'] as $hizmet) 
					<div class="ori-sponsor-item">
						<div class="ori-sponsor-img">
							<a href="# ">
								<img src="{{asset('images/'.$hizmet->image ?? '')}}" alt="">
							</a>
						</div>
					</div>
                    @endforeach
					
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
<!-- End of Sponsor section
	============================================= -->