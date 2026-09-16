@if ($paginator->hasPages())
    <div class="ori-pagination-wrap ul-li">
        <ul>
            {{-- "Önceki" düğmesi --}}
            @if ($paginator->onFirstPage())
                <li><a href="#"><i class="fal fa-arrow-left"></i></a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fal fa-arrow-left"></i></a></li>
            @endif

            {{-- Sayfa bağlantıları --}}
            @foreach ($elements as $element)
                {{-- "Önceki" düğmesi arasındaki sayfa bağlantıları --}}
                @if (is_string($element))
                    <li class="active"><a href="#">{{ $element }}</a></li>
                @endif

                {{-- Mevcut sayfa --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="{{ $url }}">{{ $page }}</a></li>
                        @else
                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Sayfalar arasında ileri gitmek için "Sonraki" düğmesi --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}"><i class="fal fa-arrow-right"></i></a></li>
            @else
                <li><a href="#"><i class="fal fa-arrow-right"></i></a></li>
            @endif
        </ul>
    </div>
@endif
