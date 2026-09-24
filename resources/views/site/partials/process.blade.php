@if ($steps->isNotEmpty())
    <div class="section-process flat-spacing {{ $class ?? 'pt-0' }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="process-heading h-100">
                        <div class="heading-section mb-80">
                            <div class="heading-sub fw-semibold effectFade fadeUp">Süreç</div>
                            <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Fikirden <br> Yayına</h2>
                        </div>
                        <div class="group-btn-slider">
                            <div class="nav-prev-swiper"><i class="icon icon-angle-left-solid"></i></div>
                            <div class="nav-next-swiper"><i class="icon icon-angle-right-solid"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="process-slide">
                        <div dir="ltr" class="swiper tf-swiper swiper-box-shadow" data-preview="1.78" data-tablet="2" data-mobile-sm="1" data-mobile="1"
                            data-loop="false" data-center="false" data-space-lg="24" data-space-md="24" data-space="30">
                            <div class="swiper-wrapper">
                                @foreach ($steps as $step)
                                    <div class="swiper-slide">
                                        <div class="process-card">
                                            <i class="icon {{ $step->icon ?: 'icon-bolt-solid' }}"></i>
                                            <div class="content">
                                                <h3 class="title h4 fw-semibold">{{ $step->title }}</h3>
                                                <p class="text text-secondary">{{ $step->content }}</p>
                                            </div>
                                            <div class="bot">
                                                <div class="time fw-semibold">{{ $step->duration }}</div>
                                                <div class="number">
                                                    <span class="text-neutral-400">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                                    <span class="text-neutral-200">/{{ str_pad($loop->count, 2, '0', STR_PAD_LEFT) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
