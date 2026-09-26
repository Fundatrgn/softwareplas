@if(!empty($testimonials) && $testimonials->count())
<section id="ori-testimonial-1" class="ori-testimonial-section-1 position-relative">
    <div class="ori-vector-bg position-absolute wow fadeInUp" data-wow-delay="400ms" data-wow-duration="1500ms">
        <img src="{{ asset('theme/assets/img/vector/tst-vector1.png') }}" alt="">
    </div>
    <div class="container">
        <div class="ori-testimonial-content-1 position-relative">
            <div class="ori-testimonial-title text-center text-uppercase">
                <h3>Danışanlarımızın Ne Dediğini İnceleyin</h3>
            </div>
            <div class="ori-testimonial-slider-1">
                @foreach ($testimonials as $t)
                    <div class="ori-testimonial-item-area">
                        <div class="ori-testimonial-item-1">
                            <div class="ori-testimonial-text text-center pera-content">
                                <p>&ldquo;{{ $t->content }}&rdquo;</p>
                                <div class="ori-testimonial-author text-center text-uppercase">
                                    <h4>{{ $t->name }}</h4>
                                    @if ($t->role)
                                        <span>{{ $t->role }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="carousel_nav">
                <button type="button" class="testi-left_arrow"><img src="{{ asset('theme/assets/img/vector/prev.png') }}" alt=""></button>
                <button type="button" class="testi-right_arrow"><img src="{{ asset('theme/assets/img/vector/next.png') }}" alt=""></button>
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
@endif
