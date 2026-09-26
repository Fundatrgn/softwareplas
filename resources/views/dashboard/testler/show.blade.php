@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">{{ $assignment->test->name }}</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/danisanlar/{{ $assignment->patient_id }}">{{ $assignment->patient->name }}</a></li>
                            <li class="breadcrumb-item active">{{ $assignment->test->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="d-flex justify-content-between align-items-center">
                        {{ $assignment->test->name }}
                        @if($assignment->isCompleted())
                            <span class="badge bg-success">{{ $assignment->score }} puan — {{ $assignment->severityLabel() }}</span>
                        @else
                            <span class="badge bg-secondary">Bekliyor</span>
                        @endif
                    </h5>
                    <p class="text-muted small">Danışan: {{ $assignment->patient->name }} · Atanma: {{ $assignment->created_at->format('d.m.Y') }}
                        @if($assignment->completed_at) · Tamamlanma: {{ $assignment->completed_at->format('d.m.Y H:i') }} @endif
                    </p>

                    @if(!$assignment->isCompleted())
                        <div class="alert alert-light border d-flex justify-content-between align-items-center">
                            <span class="small">Yüz yüze görüşmede danışan girişi olmadan bu testi doldurmak için bağlantı:</span>
                            <button type="button" class="btn btn-outline-primary btn-sm text-nowrap"
                                onclick="navigator.clipboard.writeText('{{ \Illuminate\Support\Facades\URL::signedRoute('danisan.test.misafir', ['assignmentId' => $assignment->id]) }}'); this.textContent='Kopyalandı!'; setTimeout(() => this.textContent='Bağlantıyı Kopyala', 1500);">
                                Bağlantıyı Kopyala
                            </button>
                        </div>
                    @endif

                    @if($assignment->isCompleted())
                        <table class="table table-striped">
                            <thead>
                                <tr><th>Soru</th><th class="text-end">Cevap</th></tr>
                            </thead>
                            <tbody>
                                @php $cevaplar = $assignment->answers ?? []; @endphp
                                @foreach($sorular as $q)
                                    @php
                                        $deger = $cevaplar[$q->id] ?? null;
                                        if ($q->type === 'text') {
                                            $goruntu = $deger !== null && $deger !== '' ? $deger : '—';
                                        } elseif ($q->type === 'multi_choice') {
                                            $secilenIdler = (array) $deger;
                                            $goruntu = $q->options->whereIn('id', $secilenIdler)->pluck('label')->implode(', ') ?: '—';
                                        } else {
                                            $secilenSecenek = $deger !== null ? $q->options->firstWhere('id', (int) $deger) : null;
                                            $goruntu = $secilenSecenek ? $secilenSecenek->label . ' (' . $secilenSecenek->value . ')' : '—';
                                        }
                                    @endphp
                                    <tr>
                                        <td>{{ $q->text }}</td>
                                        <td class="text-end">{{ $goruntu }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">Danışan bu testi henüz tamamlamadı.</p>
                    @endif

                    <form method="POST" action="/admin/testler/{{ $assignment->id }}/sil" class="mt-3" onsubmit="return confirm('Bu test atamasını silmek istediğinize emin misiniz?');">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm">Test Atamasını Sil</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
