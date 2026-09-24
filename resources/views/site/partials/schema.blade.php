@php
    $personName = $settings?->author ?: 'Yunuscan ZEYBEK';
    $person = array_filter([
        '@type' => 'Person',
        '@id' => url('/') . '#person',
        'name' => $personName,
        'url' => url('/yunuscan-zeybek-kimdir'),
        'image' => $settings?->profile_image ? asset('images/' . $settings->profile_image) : null,
        'jobTitle' => $settings?->job_title,
        'description' => $settings?->description,
        'email' => $settings?->email ? 'mailto:' . $settings->email : null,
        'telephone' => $settings?->phone,
        'address' => $settings?->location_text ? [
            '@type' => 'PostalAddress',
            'addressLocality' => trim(explode(',', $settings->location_text)[0]),
            'addressCountry' => 'TR',
        ] : null,
        'knowsAbout' => $menu_services->pluck('title')->all() ?: null,
        'sameAs' => $settings?->sameAsList() ?: null,
    ]);
    $graph = [
        $person,
        [
            '@type' => 'WebSite',
            '@id' => url('/') . '#website',
            'url' => url('/'),
            'name' => $personName,
            'inLanguage' => 'tr-TR',
            'publisher' => ['@id' => url('/') . '#person'],
        ],
    ];
@endphp
<script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
