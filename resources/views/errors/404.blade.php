@extends('site.layout')

@section('title', 'Sayfa Bulunamadı')

@section('content')
    <section class="section-404 flat-spacing">
        <div class="container text-center">
            <h1 class="title fw-semibold text-dispaly-1 effectFade fadeZoom">404 — Sayfa Bulunamadı</h1>
            <p class="desc text-body-1 text-white-64 effectFade fadeZoom">
                Aradığınız sayfa taşınmış ya da kaldırılmış olabilir. <br>
                Anasayfaya dönerek devam edebilirsiniz.
            </p>
            <div class="effectFade fadeZoom">
                <a href="{{ url('/') }}" class="tf-btn"><span class="text-body-2 fw-semibold">ANASAYFAYA DÖN</span></a>
            </div>
        </div>
    </section>
@endsection
