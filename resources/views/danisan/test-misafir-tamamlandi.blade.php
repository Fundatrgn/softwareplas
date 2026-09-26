@extends('danisan.layout')
@section('content')
    <div class="danisan-portal-card text-center">
        <h4 class="mb-3">{{ $assignment->test->name }}</h4>
        <p class="text-success fw-bold">Test tamamlandı, teşekkür ederiz.</p>
        <p class="text-muted small">Bu pencereyi kapatabilirsiniz.</p>
    </div>
@endsection
