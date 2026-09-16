<section id="ori-service-1" class="ori-service-section-1">
    <div class="ori-service-wrapper-1">
        <div class="container">
            <div class="ori-service-top-content-1 d-flex justify-content-between align-items-center">
                <div class="ori-section-title-1 text-uppercase wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                    <h2>Size Nasıl <span>Yardımcı Olabilirim</span></h2>
                </div>
                <div class="ori-btn-1 text-uppercase wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                    <a href="/hizmetler">Hizmetlerimiz</a>
                </div>
            </div>
            <div class="ori-service-content-1">
                <div class="row">
                    @foreach ($data['services'] as $hizmet)       
                    <div class="col-lg-4">
                        <div class="ori-service-inner-item position-relative">
                            <div class="ori-service-more position-absolute">
                                <a href="/hizmetler/detay/{{$hizmet->id}}/{{$hizmet->slug}}"><i class="fas fa-arrow-right"></i></a>
                            </div>
                            <div class="ori-service-img-title position-relative">
                                <div class="ori-service-img">
                                    <img src="{{asset('images/'.$hizmet->image ?? '')}}" alt="">
                                </div>
                                <div class="ori-service-title text-center position-absolute">
                                    <h3><a href="/hizmetler/detay/{{$hizmet->id}}/{{$hizmet->slug}}" style="color:inherit;">{{$hizmet->title}}  <i class="fal fa-arrow-right"></i></a></h3>
                                </div> 
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>