@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3 gap-2">
                <div>
                    <h5 class="mb-0">Hoş geldiniz, {{ auth()->user()->name }}</h5>
                    <div class="text-muted small">Sitenizdeki tüm içerikleri buradan yönetebilirsiniz.</div>
                </div>
                <div class="d-flex gap-2">
                    <a href="/admin/projeler/add" class="btn btn-primary">+ Yeni Proje</a>
                    <a href="/admin/blog/add" class="btn btn-outline-primary">+ Yeni Blog Yazısı</a>
                    <a href="/" target="_blank" class="btn btn-light">Siteyi Görüntüle</a>
                </div>
            </div>

            <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
                @foreach ($ozet as [$label, $count, $icon, $url, $bg])
                    <div class="col">
                        <a href="{{ $url }}" class="card radius-10 text-reset">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="widget-icon-small text-white {{ $bg }}"><ion-icon name="{{ $icon }}"></ion-icon></div>
                                <div>
                                    <div class="text-muted small">{{ $label }}</div>
                                    <h4 class="mb-0">{{ $count }}</h4>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>

            @if (! empty($eksikler))
                <div class="card radius-10">
                    <div class="card-body">
                        <h6 class="mb-3">Siteyi tamamlamak için öneriler</h6>
                        <ul class="mb-0">
                            @foreach ($eksikler as [$text, $url])
                                <li class="mb-1">{{ $text }} <a href="{{ $url }}">Düzenle →</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="row">
                @if (auth()->user()->isYonetici())
                    <div class="col-xl-6">
                        <div class="card radius-10">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <h6 class="mb-0">Son Gelen Mesajlar</h6>
                                    <a href="/admin/contact" class="ms-auto small">Tümü</a>
                                </div>
                                @forelse ($sonMesajlar as $m)
                                    <div class="border-bottom py-2">
                                        <a href="/admin/contact/add/{{ $m->id }}" class="fw-bold">{{ $m->name }}</a>
                                        <span class="text-muted small ms-2">{{ $m->created_at?->format('d.m.Y H:i') }}</span>
                                        <div class="small text-muted">{{ \Illuminate\Support\Str::limit($m->content, 90) }}</div>
                                    </div>
                                @empty
                                    <p class="text-muted mb-0">Henüz mesaj yok.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif
                <div class="col-xl-6">
                    <div class="card radius-10">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <h6 class="mb-0">Son Blog Yazıları</h6>
                                <a href="/admin/blog" class="ms-auto small">Tümü</a>
                            </div>
                            @forelse ($sonYazilar as $y)
                                <div class="border-bottom py-2 d-flex">
                                    <a href="/admin/blog/add/{{ $y->id }}">{{ $y->title }}</a>
                                    <span class="text-muted small ms-auto">{{ $y->created_at?->format('d.m.Y') }}</span>
                                </div>
                            @empty
                                <p class="text-muted mb-0">Henüz yazı yok.</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
