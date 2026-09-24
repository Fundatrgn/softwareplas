@extends('site.layout')

@section('title', 'Hizmetler')
@section('description', ($settings?->author ?: 'Yunuscan ZEYBEK') . ' tarafından sunulan hizmetler: ' . $services->pluck('title')->implode(', ') . '.')

@section('content')
    @include('site.partials.page-hero', [
        'line1' => 'Neler',
        'line2' => 'Yapıyorum?',
        'text' => 'Fikri planlamaktan yayına almaya, ölçmekten büyütmeye kadar uçtan uca destek.',
    ])

    <div id="services" class="section-services flat-spacing">
        <div class="container">
            <div class="top">
                <div class="heading-section center mb-48">
                    <div class="heading-sub fw-semibold effectFade fadeUp">Hizmetler</div>
                    <h2 class="heading-title text-gradient-3 effectFade fadeRotateX">Uzmanlık Alanlarım</h2>
                </div>
            </div>
            <div class="accordion-faq_list gap-32" id="accordion-services">
                @foreach ($services as $i => $service)
                    <div class="accordion-faq_item style-1 effectFade fadeRotateX" role="presentation">
                        <div class="accordion-action {{ $loop->first ? '' : 'collapsed' }}" data-bs-target="#svc-{{ $service->id }}" role="button"
                            data-bs-toggle="collapse" aria-controls="svc-{{ $service->id }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                            <h3 class="accordion-title">
                                {{ $service->title }}
                                <i class="icon icon-arrow-top-right"></i>
                            </h3>
                        </div>
                        <div id="svc-{{ $service->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#accordion-services">
                            <div class="accordion-content">
                                <div class="image">
                                    <img src="{{ \App\Support\Img::cover($service->image, $service->id + 2) }}" alt="{{ $service->title }}" loading="lazy">
                                </div>
                                <div class="content">
                                    <div class="text-body-3 text-neutral-300 text">{{ $service->summary }}</div>
                                    <div class="list-tags">
                                        @foreach ($service->tagList() as $tag)
                                            <span class="tags-item fw-semibold">{{ $tag }}</span>
                                        @endforeach
                                    </div>
                                    <a href="{{ $service->url() }}" class="tf-btn-2 mt-3">Hizmet detayları <i class="icon icon-arrow-top-right"></i></a>
                                    <div class="text-body-1 num">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    @include('site.partials.brands')
    <div class="box-white">
        @include('site.partials.process', ['steps' => $steps, 'class' => ''])
    </div>
    @include('site.partials.faq', ['faqs' => $faqs, 'class' => ''])
    @include('site.partials.contact-section')
@endsection
