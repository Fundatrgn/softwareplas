@extends('general.layout.template')

@section('content')
<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{asset('theme/assets/img/bg/bread-bg.png')}}">
  <div class="container">
    <div class="ori-breadcrumb-content text-center ul-li">
      <h1>{{$data['title'] ?? ''}}</h1>
      <ul>
        <li><a href="/">Anasayfa</a></li>
        <li>Blog Detay</li>
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
<section id="ori-blog-details" class="ori-blog-details-section position-relative">
  <div class="container">
    <div class="ori-blog-details-content">
      <div class="row">
        <div class="col-lg-8">
          <div class="ori-blog-details-text-wrapper">
            <div class="ori-blog-feed-item">
              <div class="ori-blog-img">
                <img src="{{asset('images/'.$data['blog']->image)}}" alt="">
              </div>
              <div class="ori-blog-text pera-content">
                <div class="blog-meta text-uppercase">
                  <a class="blog-cate" href="/blog/detay/{{$data['blog']->id}}/{{ $data['blog']->slug ?? ''}}"><i class="fas fa-file"></i> {{$data['blog']->category->title ?? ''}}</a>
                  <a class="blog-date" href="/blog/detay/{{$data['blog']->id}}/{{ $data['blog']->slug ?? ''}}"><i class="fas fa-calendar-alt"></i>{{ optional($data['blog']->created_at)->translatedFormat('d F Y') }} </a>
                </div>
                <h3>{{$data['blog']->title ?? ''}}</h3>
              {!! $data['blog']->content ?? ''!!}
              </div>
            </div>
            <div class="ori-portfolio-details-tag-share d-flex justify-content-between align-items-center">
              <div class="ori-portfolio-details-tag">
                @php
                $keywords = explode(',',$data['blog']->tags);

                @endphp
                @foreach ($keywords as $item)
                <a >{{$item ?? ''}}</a>
                @endforeach
               
              </div>
            </div>
          </div>
        </div>
      	<div class="col-lg-4">
          <div class="ori-blog-sidebar">
            <div class="ori-blog-widget">
              <div class="search-widget">
                <h3 class="widget-title">Bloglarda Ara</h3>
                <form action="/blog/search">
                  <input type="text" name="search" placeholder="Aramak istediğiniz kelimeyi yazınız" value="{{$_GET['search'] ?? ''}}">
                  <button type="submit"><i class="fal fa-search"></i></button>
                </form>
              </div>
            </div>
            <div class="ori-blog-widget">
              <div class="recent-post-widget">
                <h3 class="widget-title">Son Postlarımız</h3>
                @foreach ($data['lastestBlog'] as $item)     
                <div class="ori-recent-post-item d-flex align-items-center">
                  <div class="recent-blog-img col-md-4">
                    <img src="{{asset('images/'.$item->image ?? '')}}" alt="">
                  </div>
                  <div class="recent-blog-text">
                    {{-- <span class="date-meta text-uppercase">July 25,2022 </span> --}}
                    <h3><a href="/blog/detay/{{$item->id}}/{{ $item->slug ?? ''}}">{{$item->title ?? ''}} </a></h3>
                  </div>
                </div>
                @endforeach
              
              </div>
            </div>
            <div class="ori-blog-widget">
              <div class="service-widget ul-li-block">
                <h3 class="widget-title">Kategoriler</h3>
                <ul>
                  @foreach ($data['blogCategory'] as $item)      
                  <li class="cat-item">
                    <a href="/blog/detay/{{$item->id}}/{{ $item->slug ?? ''}}">{{$item->title ?? ''}}</a>
                  </li>
                  @endforeach
                </ul>
              </div>
            </div>
            @if (!empty($keywords))
            <div class="ori-blog-widget">
              <div class="tag-widget ul-li">
                <h3 class="widget-title">Etiketler</h3>
                <ul>
                  @foreach ($keywords as $item)
                  <li class="cat-item"><a>{{ trim($item) ?? '' }}</a></li>
                  @endforeach
                </ul>
              </div>
            </div>
            @endif
          </div>
        </div>
      </div>
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
    <!-- End CTA -->
@endsection