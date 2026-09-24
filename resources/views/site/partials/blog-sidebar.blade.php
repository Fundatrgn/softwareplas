<aside class="blog-sidebar m-lg-0">
    <div class="sidebar-item effectFade fadeUp no-div">
        <h2 class="sidebar-title h5">Ara</h2>
        <form class="form-search" action="{{ url('/blog') }}" method="GET" role="search">
            <fieldset class="text">
                <input type="text" placeholder="Yazılarda ara" name="q" value="{{ $search ?? '' }}" aria-label="Blog yazılarında ara" required>
            </fieldset>
            <button type="submit" class="link1 text-white" aria-label="Ara"><i class="icon icon-search-solid"></i></button>
        </form>
    </div>
    @if ($recentPosts->isNotEmpty())
        <div class="sidebar-item effectFade fadeUp no-div">
            <h2 class="sidebar-title h5">Son Yazılar</h2>
            <div class="list-relatest-post">
                @foreach ($recentPosts as $recent)
                    <div class="relatest-post-item">
                        <div class="image">
                            <img loading="lazy" width="80" height="80" src="{{ \App\Support\Img::cover($recent->image, $recent->id + 4) }}" alt="{{ $recent->title }}">
                        </div>
                        <div class="content">
                            <h3 class="title text-body-1"><a href="{{ $recent->url() }}" class="link1">{{ $recent->title }}</a></h3>
                            <p class="time text-body-3 text-white-64">{{ $recent->created_at?->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if ($categories->isNotEmpty())
        <div class="sidebar-item effectFade fadeUp no-div">
            <h2 class="sidebar-title h5">Kategoriler</h2>
            <div class="sidebar-categories">
                @foreach ($categories as $cat)
                    <div class="item">
                        <a href="{{ url('/blog/kategori/' . $cat->slug) }}" class="text-body-1 link1">{{ $cat->title }}</a>
                        <span class="text-body-3 text-white-64">({{ $cat->posts_count }})</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if ($popularTags->isNotEmpty())
        <div class="sidebar-item effectFade fadeUp no-div">
            <h2 class="sidebar-title h5">Etiketler</h2>
            <div class="list-tags">
                @foreach ($popularTags as $tag)
                    <a href="{{ url('/blog') . '?q=' . urlencode($tag) }}" class="tags-item fw-semibold">{{ $tag }}</a>
                @endforeach
            </div>
        </div>
    @endif
</aside>
