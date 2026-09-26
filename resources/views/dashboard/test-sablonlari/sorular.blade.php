@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ $test->name }} — Sorular</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/test-sablonlari">Test Şablonları</a></li>
                            <li class="breadcrumb-item active">{{ $test->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Mevcut Sorular ({{ $test->questions->count() }})</h6>
                            @forelse($test->questions as $q)
                                <div class="mb-2 pb-2 border-bottom">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <strong>{{ $loop->iteration }}. {{ $q->text }}</strong>
                                            <br><span class="badge bg-secondary">{{ $q->typeLabel() }}</span>
                                            @if($q->hasOptions())
                                                <div class="text-muted small mt-1">
                                                    @foreach($q->options as $opt)
                                                        {{ $opt->label }} ({{ $opt->value }})@if(!$loop->last), @endif
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>
                                        <div class="text-nowrap">
                                            <a href="/admin/test-sablonlari/soru/{{ $q->id }}/duzenle" class="text-warning" title="Düzenle">
                                                <ion-icon name="pencil-outline"></ion-icon>
                                            </a>
                                            <a href="/admin/test-sablonlari/soru/{{ $q->id }}/sil" class="text-danger" title="Sil"
                                                onclick="return confirm('Bu soruyu silmek istediğinize emin misiniz?');">
                                                <ion-icon name="trash-outline"></ion-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted small mb-0">Henüz soru eklenmedi.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h6>Yeni Soru Ekle</h6>
                            @include('dashboard.test-sablonlari._soru-form', [
                                'action' => '/admin/test-sablonlari/' . $test->id . '/sorular',
                                'question' => null,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
