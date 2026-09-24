{{-- İç sayfaların üstündeki büyük başlık alanı. $line1, $line2 (isteğe bağlı), $text, $h1 (bool) --}}
<div class="section-hero {{ $variant ?? 'v1' }}">
    <div class="hero-image"></div>
    <div class="container">
        <div class="content-wrap text-center">
            <h1 class="title text-display-2 effectFade fadeRotateX">
                <span class="title1 fw-semibold text-gradient-1">{{ $line1 }}</span>
                @if (! empty($line2))
                    <br>
                    <span class="title2 d-flex gap-20 justify-content-center flex-wrap">
                        <span class="fw-semibold text-gradient-1">{{ $line2 }}</span>
                        <span class="title-icon">
                            <span class="box"></span>
                            <span class="title-icon-wrap">
                                <img src="{{ asset('site/images/item/item-13.svg') }}" alt="" class="img-1 img-transform-3">
                                <img src="{{ asset('site/images/item/item-14.svg') }}" alt="" class="img-2 img-transform-3">
                                <img src="{{ asset('site/images/item/item-15.svg') }}" alt="" class="img-3 img-transform-3">
                            </span>
                        </span>
                    </span>
                @endif
            </h1>
            @if (! empty($text))
                <p class="text effectFade fadeUp">{{ $text }}</p>
            @endif
        </div>
    </div>
</div>
