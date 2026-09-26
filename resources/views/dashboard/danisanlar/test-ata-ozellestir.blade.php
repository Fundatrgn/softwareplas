@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Test Ata: {{ $test->name }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/danisanlar/{{ $patient->id }}">{{ $patient->name }}</a></li>
                            <li class="breadcrumb-item active">Test Ata: {{ $test->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <p class="text-muted small">Bu danışan için testin hangi sorularının uygulanacağını seçin. Varsayılan olarak tüm sorular işaretlidir; isterseniz bazılarının işaretini kaldırabilirsiniz (ör. bu danışan için uygun olmayan bir soru).</p>

                    <form method="POST" action="/admin/danisanlar/{{ $patient->id }}/test-ata">
                        @csrf
                        <input type="hidden" name="test_id" value="{{ $test->id }}">

                        <div class="mb-3 d-flex gap-2">
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="hepsiniSec">Tümünü Seç</button>
                            <button type="button" class="btn btn-outline-secondary btn-sm" id="hepsiniKaldir">Tümünü Kaldır</button>
                        </div>

                        @foreach($test->questions as $q)
                            <div class="form-check mb-2">
                                <input class="form-check-input soru-checkbox" type="checkbox" name="question_ids[]" value="{{ $q->id }}" id="soru{{ $q->id }}" checked>
                                <label class="form-check-label" for="soru{{ $q->id }}">
                                    {{ $q->text }}
                                    <span class="text-muted small">({{ $q->typeLabel() }})</span>
                                </label>
                            </div>
                        @endforeach

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary px-4">Bu Şekilde Ata</button>
                            <a href="/admin/danisanlar/{{ $patient->id }}" class="btn btn-outline-secondary px-4">Vazgeç</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('hepsiniSec').addEventListener('click', function () {
            document.querySelectorAll('.soru-checkbox').forEach(function (c) { c.checked = true; });
        });
        document.getElementById('hepsiniKaldir').addEventListener('click', function () {
            document.querySelectorAll('.soru-checkbox').forEach(function (c) { c.checked = false; });
        });
    </script>
@endsection
