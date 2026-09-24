@if ($faqs->isNotEmpty())
    <div class="section-faqs flat-spacing {{ $class ?? 'pt-0' }}">
        <div class="container">
            <div class="heading-section center mb-64">
                <div class="heading-sub fw-semibold effectFade fadeUp">SSS</div>
                <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Sık Sorulan <br> Sorular</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion-asked" id="accordion-asked">
                        @foreach ($faqs as $faq)
                            <div class="accordion-asked-item effectFade fadeRotateX" data-delay="{{ min($loop->index * 0.1, 0.3) }}">
                                <div class="accordion-asked-title" id="asked{{ $faq->id }}">
                                    <button class="accordion-button text-body-1 fw-semibold {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse{{ $faq->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}">
                                        {{ $faq->title }}
                                        <span class="right-icon"></span>
                                    </button>
                                </div>
                                <div id="collapse{{ $faq->id }}" role="region" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="asked{{ $faq->id }}" data-bs-parent="#accordion-asked">
                                    <div class="accordion-body rich-text">{!! $faq->content !!}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('schema')
        <script type="application/ld+json">{!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $faqs->map(fn ($f) => [
                '@type' => 'Question',
                'name' => $f->title,
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => trim(strip_tags($f->content))],
            ])->values()->all(),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
    @endpush
@endif
