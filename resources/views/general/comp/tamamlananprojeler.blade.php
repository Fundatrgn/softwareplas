<section id="ori-project-1" class="ori-project-section-1 position-relative">
    <div class="container">
        <div class="ori-project-content-1 position-relative">
            <div class="row">
                <div class="col-lg-4">
                    <div class="ori-project-tab-btn-content">
                        <div class="ori-section-title-1 text-uppercase wow fadeInUp" data-wow-delay="200ms"
                            data-wow-duration="1500ms">
                            <h2>Tamamlanan <span> Projeler</span></h2>
                        </div>
                        <div class="ori-project-tab-btn ul-li-block text-uppercase wow fadeInUp" data-wow-delay="400ms"
                            data-wow-duration="1500ms">
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                @php
                                    $count = 0;
                                @endphp
                                @foreach ($data['referanslarCategory'] as $item)
                                    @if ($count == 0)
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="{{ $item->slug }}-tab"
                                                data-bs-toggle="pill" data-bs-target="#{{ $item->slug }}"
                                                type="button" role="tab" aria-controls="{{ $item->slug }}"
                                                aria-selected="true">{{ $item->title ?? '' }}</button>
                                        </li>
                                    @else
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="{{ $item->slug }}-tab" data-bs-toggle="pill"
                                                data-bs-target="#{{ $item->slug }}" type="button" role="tab"
                                                aria-controls="{{ $item->slug }}"
                                                aria-selected="false">{{ $item->title ?? '' }}</button>
                                        </li>
                                    @endif
                                    @php
                                        $count++;
                                    @endphp
                                @endforeach


                                {{-- <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">UI/UX Tasarımı</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="interior-tab" data-bs-toggle="pill" data-bs-target="#interior" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Dijital Marketing</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="construction-tab" data-bs-toggle="pill" data-bs-target="#construction" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Ürün Tasarımı</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="construction-tab" data-bs-toggle="pill" data-bs-target="#construction" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Mobil Uygulama</button>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ori-project-tab-content wow fadeInUp" data-wow-delay="500ms" data-wow-duration="1500ms">
                        <div class="tab-content" id="pills-tabContent">
                            @php
                                $count = 0;
                            @endphp
                            @foreach ($data['referanslarCategory'] as $item)
                                <div class="tab-pane fade show {{ $count == 0 ? 'active' : '' }}"
                                    id="{{ $item->slug }}" role="tabpanel" aria-labelledby="{{ $item->slug }}-tab">
                                    
                                    @foreach ($item['referanslar'] as $referan)     
                                    <div class="ori-project-item-1 position-relative">
                                        <div class="ori-project-img">
                                            <img src="{{asset('images/'.$referan->image ?? '')}}" alt="">
                                        </div>
                                        <div class="ori-project-text position-absolute">
                                            <h3><a href="">{{$referan->title ?? ''}}</a></h3>
                                            <span class="text-uppercase project-category"><a href="#">{{$item->name ?? ''}}</a></span>
                                        </div>
                                        <div class="ori-project-link position-absolute">
                                            <a href=""><i class="fas fa-arrow-right"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                                @php
                                    $count++;
                                @endphp
                            @endforeach
                         
                        </div>
                    </div>
                </div>
            </div>
            <div class="ori-btn-1 position-absolute text-uppercase wow fadeInUp" data-wow-delay="400ms"
                data-wow-duration="1500ms">
                <a href="portfolio.html">Tümünü Gör</a>
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
