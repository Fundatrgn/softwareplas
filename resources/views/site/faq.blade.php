@extends('site.layout')

@section('title', 'Sık Sorulan Sorular')
@section('description', ($settings?->author ?: 'Yunuscan ZEYBEK') . ' hakkında ve verilen hizmetlerle ilgili sık sorulan sorular.')

@section('content')
    @include('site.partials.page-hero', [
        'line1' => 'Sık Sorulan',
        'line2' => 'Sorular',
        'text' => 'Merak ettiğiniz bir soru burada yoksa iletişim formundan bana yazabilirsiniz.',
    ])
    @include('site.partials.faq', ['faqs' => $faqs, 'class' => ''])
    @include('site.partials.contact-section')
@endsection
