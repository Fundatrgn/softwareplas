@extends('general.layout.template')
@section('content')
    <section id="ori-slider-1" class="ori-slider-section-1 position-relative">
        <div class="ori-slider-content-wrapper-1 postion-relative">
            <div class="ori-slider-social position-absolute text-uppercase ul-li">
                <ul>
                    <li><a target="_blank" href="{{$settings->instagram ?? ''}}"><i class="fab fa-instagram"></i> Instagram</a></li>
                    @if(!empty($settings->whatsapp_number))
                    <li><a target="_blank" href="https://wa.me/{{ preg_replace('/\D/', '', $settings->whatsapp_number) }}"><i class="fab fa-whatsapp"></i> WhatsApp</a></li>
                    @endif
                    <li><a target="_blank" href="{{$settings->facebook ?? ''}}"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                </ul>
            </div>

            <div class="ori-slider-wrap-1">
                @foreach ($data['slider'] as $item)
                    <div class="ori-slider-content-1 position-relative">
                        <div class="ori-slider-text ori-slider-align-{{ $item['text_position'] ?? 'orta' }} text-uppercase">
							<h1>
                            <?php
                                // Kelimeler her sayfa yenilendiğinde/slayt değiştiğinde
                                // FARKLI bir dağılımla dolu/kontur (outline) gösterilsin
                                // diye rastgele seçiliyor — bu yüzden aynı başlık bile
                                // her yüklemede biraz farklı görünür. 2+ kelime varsa,
                                // şans eseri hepsinin aynı stilde çıkıp efektin o an hiç
                                // görünmemesi ihtimaline karşı en az bir kelime karşı
                                // stile zorlanır.
                                $words = explode(' ', $item['title']);
                                $styles = [];
                                foreach ($words as $word) {
                                    $styles[] = random_int(0, 1);
                                }
                                if (count($styles) > 1 && count(array_unique($styles)) === 1) {
                                    $flipIndex = array_rand($styles);
                                    $styles[$flipIndex] = 1 - $styles[$flipIndex];
                                }
                                foreach ($words as $i => $word) {
                                    if ($styles[$i] == 1) {
                                        echo "<span>$word</span> ";
                                    } else {
                                        echo "$word ";
                                    }
                                }
                            ?>
                        </h1>
                            @if(!empty($item['subtitle']))
                            <p class="ori-slider-subtitle" style="text-transform:none; max-width:640px; font-size:18px; color: var(--body-color);">{{ $item['subtitle'] }}</p>
                            @endif
                            <div class="slider-play-btn">
                                @if(!empty($item['btn_text']))
                                <a style="display:inline-block; width:auto; height:auto; margin-top:30px; padding:16px 38px; border-radius:35px; background-color: var(--base-color-1); color:#fff; font-weight:700; letter-spacing: .05em; text-transform:none; white-space:nowrap; border:none;" href="/randevu">{{ $item['btn_text'] }}</a>
                                @endif
                            </div>
                            <div class="ori-slider-img position-absolute">
                                <img src="{{ asset('images/'.$item['image'] ?? '') }}" alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
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
        </div>
        <div class="ori-slider-scroll position-absolute text-uppercase">
            <span>KAYDIR </span>
            <div class="scroll-mouse">
                <i class="fal fa-mouse"></i>
            </div>
        </div>
    </section>
    @include('general.comp.hizmetler')

    @include('general.comp.slogan')

    @include('general.comp.lastpost')
@endsection
