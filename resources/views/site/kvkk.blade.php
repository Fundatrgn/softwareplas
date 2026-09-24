@extends('site.layout')

@section('title', 'KVKK Aydınlatma Metni')

@section('content')
    @include('site.partials.page-title', ['title' => 'KVKK Aydınlatma Metni', 'crumbs' => [[null, 'KVKK']]])
    <section class="flat-spacing">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 rich-text text-secondary">
                    {!! $settings?->kvkk_text ?: '<p>Aydınlatma metni henüz eklenmedi.</p>' !!}
                </div>
            </div>
        </div>
    </section>
@endsection
