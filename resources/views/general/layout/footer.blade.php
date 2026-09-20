<!-- Start of Footer section
 ============================================= -->
<footer id="ori-footer" class="ori-footer-section footer-style-one">
    <div class="container">
        <div class="ori-footer-title text-center text-uppercase">
          <a href="/randevu">  <h2> Randevu <span>Alın</span> <i class="fas fa-arrow-right"></i></h2></a>
        </div>
        <div class="ori-footer-widget-wrapper">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="ori-footer-widget">
                        <div class="logo-widget">
                            <a href="#"><img src="{{ asset('images/' . $settings->image ?? '') }}" alt=""
                                    style="width:180px"></a>
                            <p>
                                {!! $settings->description ?? '' !!}
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="ori-footer-widget">
                        <div class="menu-location-widget ul-li-block">
                            <h2 class="widget-title text-uppercase">Hizmetlerimiz</h2>
                            <ul>
                                @foreach ($services_categories->take(8) as $item)
                                    <li>
                                        <a href="/hizmetler/{{ $item->id ?? '' }}/{{ $item->slug ?? '' }}">{{ $item->title ?? '' }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @if(!empty($settings->footer_menu_title) && isset($footer_links) && $footer_links->isNotEmpty())
                <div class="col-lg-3 col-md-6">
                    <div class="ori-footer-widget">
                        <div class="menu-location-widget ul-li-block">
                            <h2 class="widget-title text-uppercase">{{ $settings->footer_menu_title }}</h2>
                            <ul>
                                @foreach ($footer_links as $link)
                                    <li>
                                        <a href="{{ $link->url }}">{{ $link->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                <div class="col-lg-3 col-md-6">
                    <div class="ori-footer-widget">
                        <div class="contact-widget ul-li-block">
                            <h2 class="widget-title text-uppercase">İletişim</h2>
                            <div class="contact-info">
                                <span>{{ $settings->address ?? '' }} </span>
                                <span>{{ $settings->phone ?? '' }}</span>
                                <a href="#">{{ $settings->email ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="ori-footer-copyright ori-footer-copyright-refresh d-flex justify-content-between align-items-center">
            <div class="ori-copyright-text">
                © {{ date('Y') }} {{ $settings->footer_copyright_text ?: 'All Right: Yunuscan ZEYBEK | Tüm Hakları Saklıdır' }}
            </div>
            <div class="ori-copyright-social">
                <a target="_blank" href="{{ $settings->instagram ?? '#' }}"><i class="fab fa-instagram"></i></a>
                <a target="_blank" href="{{ $settings->facebook ?? '#' }}"><i class="fab fa-facebook-f"></i></a>
                <a target="_blank" href="{{ $settings->youtube ?? '#' }}"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</footer>
<!-- End of Footer section
 ============================================= -->

@if(!empty($settings->whatsapp_number))
<a href="https://wa.me/{{ preg_replace('/\D/', '', $settings->whatsapp_number) }}?text={{ urlencode('Merhaba, bir randevu almak istiyorum.') }}"
   target="_blank" rel="noopener" class="ori-whatsapp-float" aria-label="WhatsApp'tan hızlı randevu">
    <i class="fab fa-whatsapp"></i>
    <span class="ori-whatsapp-float-text">Hızlı Randevu</span>
</a>
@endif

<!-- For Js Library -->
<script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/appear.js') }}"></script>
<script src="{{ asset('theme/assets/js/slick.js') }}"></script>
<script src="{{ asset('theme/assets/js/twin.js') }}"></script>
<script src="{{ asset('theme/assets/js/wow.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/knob.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.filterizr.js') }}"></script>
<script src="{{ asset('theme/assets/js/imagesloaded.pkgd.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/rbtools.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/rs6.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jarallax.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.inputarrow.js') }}"></script>
<script src="{{ asset('theme/assets/js/swiper.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/waypoints.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.magnific-popup.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/jquery.marquee.min.js') }}"></script>
<script>
    // Admin panelinden ("Anasayfa Slider" sayfası) ayarlanan slayt geçiş süresi.
    window.oriSliderSpeed = {{ $settings->slider_speed ?? 6000 }};
</script>
<script src="{{ asset('theme/assets/js/script.js') }}?v=2"></script>
</body>

</html>
