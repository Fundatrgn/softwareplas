{{-- Siyah zeminli blok: istatistikler + (varsa) kariyer + referans yorumları --}}
@php
    $stats = $settings?->stats ?? [];
    $timeline = $timeline ?? collect();
@endphp
@if ($stats || $testimonials->isNotEmpty() || $timeline->isNotEmpty())
    <div class="box-black">
        <div class="light-box"></div>
        <img class="light-top" src="{{ asset('site/images/yz/light-top.svg') }}" alt="">
        <img class="light-bot" src="{{ asset('site/images/yz/light-bot.svg') }}" alt="">

        @if ($stats)
            <div class="section-statistic flat-spacing">
                <div class="line"></div>
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-md-6">
                            <div class="heading-section mb-48">
                                <div class="heading-sub fw-semibold style-1 effectFade fadeUp">Rakamlarla</div>
                                <h2 class="heading-title text-white effectFade fadeRotateX">Üretmeye, <br> öğrenmeye ve <br> paylaşmaya devam</h2>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="statistic-slider">
                                @if ($settings?->quote_text)
                                    <div class="text text-body-1 text-neutral-400 effectFade fadeUp">{{ $settings->quote_text }}</div>
                                @endif
                                <div class="swiper swiper-progressbar">
                                    <div class="group-slider effectFade fadeUp">
                                        <div class="progress-bar"><div class="progress-fill" id="progressBar"></div></div>
                                        <div class="group-btn-slider">
                                            <div class="btn-slider progressbar-prev"><i class="icon icon-angle-left-solid"></i></div>
                                            <div class="btn-slider progressbar-next"><i class="icon icon-angle-right-solid"></i></div>
                                        </div>
                                    </div>
                                    <div class="swiper-wrapper effectFade fadeUp">
                                        @foreach ($stats as $stat)
                                            <div class="swiper-slide">
                                                <div class="title fw-semibold text-body-1">{{ mb_strtoupper($stat['label']) }}</div>
                                                <div class="statistic-number">
                                                    <span class="number text-white fw-semibold">{{ $stat['value'] }}</span>
                                                    <span class="prefix text-brand">{{ $stat['suffix'] ?? '' }}</span>
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

        @if ($timeline->isNotEmpty())
            <div class="section-awards flat-spacing {{ $stats ? 'pt-0' : '' }}">
                <div class="container">
                    <div class="heading-section center mb-48">
                        <div class="heading-sub fw-semibold style-1 effectFade fadeUp">Kariyer Yolculuğu</div>
                        <h2 class="heading-title text-white effectFade fadeRotateX">Neler yaptım, <br> nerelerde çalıştım?</h2>
                    </div>
                    <div class="d-grid gap-16">
                        @foreach ($timeline as $step)
                            <div class="awards-item effectFade fadeUp" data-delay="{{ min($loop->index * 0.1, 0.3) }}">
                                <div class="image">
                                    @if ($step->logo)
                                        <img src="{{ asset('images/' . $step->logo) }}" alt="{{ $step->company }}">
                                    @else
                                        <span class="timeline-initial">{{ mb_substr($step->company ?: $step->title, 0, 1) }}</span>
                                    @endif
                                </div>
                                <div class="title text-body-1 text-white">
                                    {{ $step->title }}
                                    @if ($step->description)
                                        <span class="d-block text-body-3 text-neutral-400 mt-1">{{ $step->description }}</span>
                                    @endif
                                </div>
                                <div class="text text-body-1 text-white">{{ $step->company }}</div>
                                <div class="year text-body-1 text-neutral-400">/ {{ $step->year }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if ($testimonials->isNotEmpty())
            <div class="section-testimonials flat-spacing {{ ($stats || $timeline->isNotEmpty()) ? 'pt-0' : '' }}">
                <div class="container">
                    <div class="row justify-content-between">
                        <div class="col-lg-5">
                            <div class="col-left">
                                <div class="heading-section mb-48">
                                    <div class="heading-sub fw-semibold style-1 effectFade fadeUp">Referanslar</div>
                                    <h2 class="heading-title text-white effectFade fadeRotateX">Birlikte <br> çalıştıklarım ne diyor?</h2>
                                </div>
                                <div class="swiper-testimonial_wrap effectFade fadeUp">
                                    <div dir="ltr" class="swiper tf-swiper swiper-testimonial">
                                        <div class="swiper-wrapper">
                                            @foreach ($testimonials as $t)
                                                <div class="swiper-slide">
                                                    <div>
                                                        <div class="top-icon d-flex gap-4">
                                                            @for ($s = 0; $s < 5; $s++)<i class="icon icon-star-solid"></i>@endfor
                                                        </div>
                                                        <div class="text-body-1 text-white desc">{{ $t->content }}</div>
                                                        <div class="cite">
                                                            <img class="line-left" src="{{ asset('site/images/item/line-1.png') }}" alt="">
                                                            <div class="name text-body-3 text-neutral-400 fw-semibold">{{ $t->name }}</div>
                                                            @if ($t->role)
                                                                <div class="line"></div>
                                                                <div class="sub text-body-3 text-neutral-400">{{ $t->role }}</div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="group-slider">
                                        <div class="group-btn-slider">
                                            <div class="btn-slider nav-prev-swiper testimonials-prev"><i class="icon icon-angle-left-solid"></i></div>
                                            <div class="btn-slider nav-next-swiper testimonials-next"><i class="icon icon-angle-right-solid"></i></div>
                                        </div>
                                        <div class="testimonials-pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div dir="ltr" class="swiper sw-main-image effectFade fadeUp">
                                <div class="swiper-wrapper">
                                    @foreach ($testimonials as $t)
                                        <div class="swiper-slide">
                                            <div class="testimonial-image">
                                                @if ($t->image)
                                                    <img src="{{ asset('images/' . $t->image) }}" alt="{{ $t->name }}">
                                                @else
                                                    <div class="testimonial-placeholder"><span>{{ mb_substr($t->name, 0, 1) }}</span></div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endif
