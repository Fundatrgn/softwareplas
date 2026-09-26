@extends('general.layout.template')
@section('content')

<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{ asset('theme/assets/img/bg/bread-bg.png') }}">
    <div class="container">
        <div class="ori-breadcrumb-content text-center ul-li">
            <h1>Sık Sorulan Sorular</h1>
            <ul>
                <li><a href="/">Anasayfa</a></li>
                <li>Sık Sorulan Sorular</li>
            </ul>
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

<section id="ori-faq" class="position-relative" style="padding: 100px 0;">
    <div class="container" style="max-width: 860px;">
        @if($data['sorular']->count())
        <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => $data['sorular']->map(function ($item) {
                return [
                    '@type' => 'Question',
                    'name' => trim(html_entity_decode(strip_tags($item->title), ENT_QUOTES, 'UTF-8')),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => trim(html_entity_decode(strip_tags($item->content), ENT_QUOTES, 'UTF-8')),
                    ],
                ];
            })->values(),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
        </script>
        @endif
        @forelse($data['sorular'] as $item)
            <div class="ori-faq-item" style="margin-bottom: 18px; border-radius: 10px; overflow: hidden; background-color: var(--dark-surface);">
                <button type="button" class="ori-faq-question" data-faq-toggle
                    style="width:100%; text-align:left; padding:22px 26px; background:none; border:none; color:var(--heading-color); font-weight:700; font-size:18px; display:flex; justify-content:space-between; align-items:center; cursor:pointer;">
                    <span>{{ $item->title }}</span>
                    <i class="fal fa-chevron-down"></i>
                </button>
                <div class="ori-faq-answer" style="display:none; padding: 0 26px 26px; color:var(--body-color);">
                    {!! $item->content !!}
                </div>
            </div>
        @empty
            <p style="text-align:center; color: var(--body-color);">Şu an için eklenmiş bir soru bulunmuyor.</p>
        @endforelse
    </div>
</section>

<script>
document.querySelectorAll('[data-faq-toggle]').forEach(function (btn) {
    btn.addEventListener('click', function () {
        var answer = btn.nextElementSibling;
        var icon = btn.querySelector('i');
        var open = answer.style.display === 'block';
        answer.style.display = open ? 'none' : 'block';
        icon.classList.toggle('fa-chevron-down', open);
        icon.classList.toggle('fa-chevron-up', !open);
    });
});
</script>
@endsection
