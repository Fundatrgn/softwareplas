@extends('general.layout.template')

@section('content')
<section id="ori-breadcrumbs" class="ori-breadcrumbs-section position-relative" data-background="{{asset('theme/assets/img/bg/bread-bg.png')}}">
  <div class="container">
    <div class="ori-breadcrumb-content text-center ul-li">
      <h1>{{ $page->title }}</h1>
      <ul>
        <li><a href="/">Anasayfa</a></li>
        <li>{{ $page->title }}</li>
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
<section class="ori-blog-details-section position-relative">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-9">
        <div class="ori-blog-details-text-wrapper pera-content">
          {!! $page->content !!}
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
