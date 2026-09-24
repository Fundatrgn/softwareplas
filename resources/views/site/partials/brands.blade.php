@if ($brands->isNotEmpty())
    <div class="section-partner">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="partner-wrap">
                        <p class="text-secondary text fw-semibold">Birlikte çalıştığım <br> markalar & kurumlar</p>
                        <div class="infiniteSlide_tech_main d-grid">
                            <div class="infiniteSlide infiniteSlide_partner" data-clone="5">
                                @foreach ($brands as $brand)
                                    @if ($brand->logo)
                                        <img src="{{ asset('images/' . $brand->logo) }}" alt="{{ $brand->name }}" title="{{ $brand->name }}">
                                    @else
                                        <span class="brand-text">{{ $brand->name }}</span>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
