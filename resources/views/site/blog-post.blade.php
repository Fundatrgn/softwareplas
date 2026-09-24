@extends('site.layout')

@php $name = $settings?->author ?: 'Yunuscan ZEYBEK'; @endphp

@section('title', $post->title)
@section('description', $post->summary)
@section('og_type', 'article')
@if ($post->image)
    @section('og_image', asset('images/' . $post->image))
@endif

@push('schema')
    <script type="application/ld+json">{!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'BlogPosting',
        'headline' => $post->title,
        'description' => $post->summary,
        'url' => $post->url(),
        'mainEntityOfPage' => $post->url(),
        'image' => $post->image ? asset('images/' . $post->image) : null,
        'datePublished' => $post->created_at?->toAtomString(),
        'dateModified' => $post->updated_at?->toAtomString(),
        'keywords' => $post->tags,
        'inLanguage' => 'tr-TR',
        'author' => ['@id' => url('/') . '#person'],
        'publisher' => ['@id' => url('/') . '#person'],
    ]), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) !!}</script>
@endpush

@section('content')
    @include('site.partials.page-title', [
        'title' => $post->title,
        'crumbs' => [[url('/blog'), 'Blog'], [null, \Illuminate\Support\Str::limit($post->title, 40)]],
    ])

    <section class="section-blog flat-spacing">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <article class="blog-single-wrap">
                        <div class="image effectFade fadeZoom">
                            <img loading="lazy" width="777" height="548" src="{{ \App\Support\Img::cover($post->image, $post->id + 4) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="meta-list">
                            <div class="meta-item">
                                <i class="icon icon-user-solid"></i>
                                <a href="{{ url('/yunuscan-zeybek-kimdir') }}" class="link" rel="author">{{ $name }}</a>
                            </div>
                            <div class="meta-item">
                                <i class="icon icon-clock-solid"></i>
                                <time datetime="{{ $post->created_at?->toDateString() }}">{{ $post->created_at?->translatedFormat('d F Y') }}</time>
                            </div>
                            @if ($post->category)
                                <div class="meta-item">
                                    <i class="icon icon-book-solid"></i>
                                    <a href="{{ url('/blog/kategori/' . $post->category->slug) }}" class="link">{{ $post->category->title }}</a>
                                </div>
                            @endif
                        </div>
                        <div class="text-body-2 rich-text">{!! $post->content !!}</div>
                        <div class="entry-footer">
                            @if ($post->tagList())
                                <div class="tags-links">
                                    <h2 class="text-body-1 h6">Etiketler:</h2>
                                    <div class="list-tags">
                                        @foreach ($post->tagList() as $tag)
                                            <a href="{{ url('/blog') . '?q=' . urlencode($tag) }}" class="tags-item fw-semibold">{{ $tag }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex align-items-center gap-12">
                                <h2 class="text-body-1 h6">Paylaş:</h2>
                                <div class="tf-social justify-content-center">
                                    <a href="https://x.com/intent/tweet?url={{ urlencode($post->url()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener" class="social-item" aria-label="X'te paylaş"><i class="icon icon-twitter-x"></i></a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode($post->url()) }}" target="_blank" rel="noopener" class="social-item" aria-label="LinkedIn'de paylaş"><i class="icon icon-linkedin-in"></i></a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode($post->url()) }}" target="_blank" rel="noopener" class="social-item" aria-label="Facebook'ta paylaş"><i class="icon icon-facebook-f"></i></a>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
                <div class="col-lg-4">
                    @include('site.partials.blog-sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
