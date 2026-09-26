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

        <form method="POST" action="{{ $formAction }}">
            @csrf
            @foreach($sorular as $i => $q)
                <div class="mb-4">
                    <p class="mb-2"><strong>{{ $i + 1 }}.</strong> {{ $q->text }}</p>
                    @if($q->type === 'text')
                        <textarea class="form-control" name="cevap[{{ $q->id }}]" rows="3" required></textarea>
                    @elseif($q->type === 'multi_choice')
                        <div class="d-flex flex-column gap-1">
                            @foreach($q->options as $opt)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="cevap[{{ $q->id }}][]" id="q{{ $q->id }}_{{ $opt->id }}" value="{{ $opt->id }}">
                                    <label class="form-check-label" for="q{{ $q->id }}_{{ $opt->id }}">{{ $opt->label }}</label>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="d-flex flex-column gap-1">
                            @foreach($q->options as $opt)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="cevap[{{ $q->id }}]" id="q{{ $q->id }}_{{ $opt->id }}" value="{{ $opt->id }}" required>
                                    <label class="form-check-label" for="q{{ $q->id }}_{{ $opt->id }}">{{ $opt->label }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach
            <div class="d-grid">
                <button type="submit" class="btn btn-marya">Testi Gönder</button>
            </div>
        </form>
    </div>
@endsection
