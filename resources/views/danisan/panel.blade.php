@extends('danisan.layout')
@section('content')
    <div class="danisan-portal-topbar">
        <h4 class="mb-0">Merhaba, {{ $patient->name }}</h4>
        <a href="/danisan/cikis">Çıkış Yap</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="danisan-portal-card mb-3">
        <h5>Bekleyen Testleriniz</h5>
        @forelse($bekleyenler as $ta)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                <span>{{ $ta->test->name }}</span>
                <a href="/danisan/test/{{ $ta->id }}" class="btn btn-marya btn-sm">Doldur</a>
            </div>
        @empty
            <p class="text-muted mb-0">Şu an bekleyen bir test bulunmuyor.</p>
        @endforelse
    </div>

    <div class="danisan-portal-card">
        <h5>Tamamlanan Testleriniz</h5>
        @forelse($tamamlananlar as $ta)
            <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                <span>{{ $ta->test->name }}</span>
                <span class="text-muted small">{{ $ta->completed_at?->format('d.m.Y') }}</span>
            </div>
        @empty
            <p class="text-muted mb-0">Henüz tamamlanmış test yok.</p>
        @endforelse
    </div>
@endsection
