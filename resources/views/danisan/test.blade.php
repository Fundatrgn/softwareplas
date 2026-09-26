@extends('danisan.layout')
@section('content')
    <div class="danisan-portal-topbar">
        <h4 class="mb-0">{{ $assignment->test->name }}</h4>
        <a href="/danisan/panel">&larr; Panele Dön</a>
    </div>

    <div class="danisan-portal-card">
        <p class="text-muted">{{ $assignment->test->description }}</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="/danisan/test/{{ $assignment->id }}">
            @csrf
            @foreach($assignment->test->questions as $i => $q)
                <div class="mb-4">
                    <p class="mb-2"><strong>{{ $i + 1 }}.</strong> {{ $q->text }}</p>
                    <div class="d-flex flex-column gap-1">
                        @foreach(['Hiç', 'Birkaç gün', 'Yarısından fazla günlerde', 'Neredeyse her gün'] as $deger => $etiket)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="cevap[{{ $q->id }}]" id="q{{ $q->id }}_{{ $deger }}" value="{{ $deger }}" required>
                                <label class="form-check-label" for="q{{ $q->id }}_{{ $deger }}">{{ $etiket }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            <div class="d-grid">
                <button type="submit" class="btn btn-marya">Testi Gönder</button>
            </div>
        </form>
    </div>
@endsection
