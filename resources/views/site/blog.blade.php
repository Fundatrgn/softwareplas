@extends('site.layout')

@php
    $heading = $category ? $category->title : ($search !== '' ? '"' . $search . '" araması' : 'Blog');
@endphp

@section('title', $category ? $category->title . ' - Blog' : 'Blog')
@section('description', 'Web yazılımı, dijital medya, kurumsal iletişim ve içerik üretimi üzerine yazılar.')

@section('content')
    @include('site.partials.page-title', [
        'title' => $heading,
        'crumbs' => $category || $search !== '' ? [[url('/blog'), 'Blog'], [null, $heading]] : [[null, 'Blog']],
    ])

    <section class="section-blog flat-spacing">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7">
                    <div class="tf-grid-layout">
                        @forelse ($posts as $post)
                            @include('site.partials.blog-card', ['post' => $post, 'horizontal' => true])
                        @empty
                            <p class="text-secondary">Bu kriterlere uygun yazı bulunamadı.</p>
                        @endforelse
                        <div class="wd-full">
                            {{ $posts->links('pagination.site') }}
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    @include('site.partials.blog-sidebar')
                </div>
            </div>
        </div>
    </section>
@endsection
