{{-- $post, $horizontal (bool) --}}
<article class="article-blog {{ ! empty($horizontal) ? 'style-horizontal' : '' }} hover-img effectFade fadeUp no-div h-100">
    <a href="{{ $post->url() }}" class="blog-image img-style" aria-label="{{ $post->title }}">
        <img loading="lazy" width="426" height="307" src="{{ \App\Support\Img::cover($post->image, $post->id + 4) }}" alt="{{ $post->title }}">
    </a>
    <div class="blog-content">
        <div class="infor">
            <p class="infor_sub text-secondary">
                {{ $post->category->title ?? 'Blog' }} · {{ $post->created_at?->translatedFormat('d F Y') }}
            </p>
            <h3 class="h6 fw-semibold">
                <a href="{{ $post->url() }}" class="link1 infor_name">{{ $post->title }}</a>
            </h3>
        </div>
        <a href="{{ $post->url() }}" class="tf-btn-2">
            Devamını oku
            <i class="icon icon-arrow-top-right"></i>
        </a>
    </div>
</article>
