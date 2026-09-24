@php
    $logoFile = $variant === 'footer' ? ($settings?->logo_footer ?: $settings?->image) : $settings?->image;
    $logoName = $settings?->author ?: 'Yunuscan ZEYBEK';
    $parts = preg_split('/\s+/', trim($logoName), 2);
@endphp
@if ($logoFile)
    <img src="{{ asset('images/' . $logoFile) }}" alt="{{ $logoName }}">
@else
    <span class="text-logo">{{ $parts[0] }}@if (isset($parts[1]))<strong>{{ $parts[1] }}</strong>@endif<i class="dot"></i></span>
@endif
