@if ($paginator->hasPages())
    <ul class="wg-pagination">
        @if (! $paginator->onFirstPage())
            <li><a href="{{ $paginator->previousPageUrl() }}" class="pagination-item" rel="prev" aria-label="Önceki"><i class="icon icon-angle-left-solid"></i></a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li><span class="pagination-item">{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li><a href="{{ $url }}" class="pagination-item {{ $page == $paginator->currentPage() ? 'active' : '' }}">{{ $page }}</a></li>
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <li><a href="{{ $paginator->nextPageUrl() }}" class="pagination-item" rel="next" aria-label="Sonraki"><i class="icon icon-angle-right-solid"></i></a></li>
        @endif
    </ul>
@endif
