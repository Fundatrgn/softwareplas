<section id="ori-blog-1" class="ori-blog-section-1 position-relative">
    <div class="container">
        <div class="ori-blog-top-content-1 d-flex justify-content-between align-items-center">
            <div class="ori-section-title-1 text-uppercase wow fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                <h2>Son <span>Postlarımız</span></h2>
            </div>
            <div class="ori-btn-1 text-uppercase wow fadeInRight" data-wow-delay="300ms" data-wow-duration="1500ms">
                <a href="/blog">Tümünü Gör
                </a>
            </div>
        </div>
        <div class="ori-blog-content-1">
            <div class="row">
                @foreach ($data['blog'] as $hizmet)       
                <div class="col-lg-4 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
                    <div class="ori-blog-inner-item">
                        <div class="blog-inner-img">
                            <img src="{{asset('images/'.$hizmet->image ?? '')}}" alt="">
                        </div>
                        <div class="blog-inner-text">
                            <h3><a href="blog/{{$hizmet->id ?? ''}}/{{$hizmet->slug ?? ''}}">{{$hizmet->title ?? ''}}</a></h3>
                            <a class="read-more text-uppercase" href="blog/{{$hizmet->id ?? ''}}/{{$hizmet->slug ?? ''}}">Devamını Oku <i class="fal fa-chevron-right"></i></a>
                        </div>
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