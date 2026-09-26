@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">
                    {{ $patient->name }}
                    @if($gelmediSayisi >= \App\Http\Controllers\dashboard\ReportController::NO_SHOW_WARNING_THRESHOLD)
                        <span class="badge bg-danger ms-2" title="Sık randevuya gelmeyen danışan">⚠ {{ $gelmediSayisi }} kez gelmedi</span>
                    @endif
                </div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/danisanlar">Danışanlar</a></li>
                            <li class="breadcrumb-item active">{{ $patient->name }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto d-flex gap-2">
                    <a href="/admin/danisanlar/{{ $patient->id }}/pdf" class="btn btn-outline-danger">
                        <ion-icon name="document-text-outline"></ion-icon> PDF Rapor İndir
                    </a>
                    <a href="/admin/danisanlar/add/{{ $patient->id }}" class="btn btn-outline-secondary">Düzenle</a>
                    <a href="/admin/randevular/ekle?tarih={{ now()->toDateString() }}" class="btn btn-primary">Yeni Randevu</a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h6>Danışan Bilgileri</h6>
                            <table class="table table-borderless mb-0">
                                <tr><th>Telefon</th><td>{{ $patient->phone }}</td></tr>
                                <tr><th>E-posta</th><td>{{ $patient->email ?? '—' }}</td></tr>
                                <tr><th>Doğum Tarihi</th><td>{{ $patient->birth_date?->format('d.m.Y') ?? '—' }}</td></tr>
                                <tr><th>Cinsiyet</th><td>{{ $patient->gender ?? '—' }}</td></tr>
                                <tr><th>Kayıt Tarihi</th><td>{{ $patient->created_at->format('d.m.Y') }}</td></tr>
                            </table>
                            @if($patient->notes)
                                <hr>
                                <h6>Genel Not</h6>
                                <p class="text-muted mb-0">{{ $patient->notes }}</p>
                            @endif
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Danışan Portalı</h6>
                            @if($patient->hasPortalAccess())
                                <p class="mb-1"><strong>Kullanıcı Adı:</strong> {{ $patient->username }}</p>
                                <p class="text-muted small">Şifre güvenlik nedeniyle burada gösterilmez. Danışan unuttuysa aşağıdan yeni bir şifre oluşturup gönderebilirsiniz.</p>
                            @else
                                <p class="text-muted small">Bu danışanın henüz portal girişi yok.</p>
                            @endif
                            <form method="POST" action="/admin/danisanlar/{{ $patient->id }}/portal-sifre-sifirla" onsubmit="return confirm('Yeni bir şifre oluşturulup danışana e-posta ile gönderilecek. Devam edilsin mi?');">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm w-100">
                                    {{ $patient->hasPortalAccess() ? 'Şifreyi Sıfırla ve Gönder' : 'Portal Girişi Oluştur ve Gönder' }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Testler</h6>
                            <form method="POST" action="/admin/danisanlar/{{ $patient->id }}/test-ata" class="d-flex gap-2 mb-3">
                                @csrf
                                <select name="test_id" class="form-select form-select-sm" required>
                                    <option value="">Test seçin...</option>
                                    @foreach($tests as $t)
                                        <option value="{{ $t->id }}">{{ $t->name }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-outline-primary btn-sm text-nowrap">Ata</button>
                            </form>
                            @forelse($testAssignments as $ta)
                                <div class="mb-2 pb-2 border-bottom d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $ta->test->name }}</strong><br>
                                        <span class="text-muted small">{{ $ta->created_at->format('d.m.Y') }}</span>
                                    </div>
                                    <div class="text-end">
                                        @if($ta->isCompleted())
                                            <a href="/admin/testler/{{ $ta->id }}" class="badge bg-success text-decoration-none">{{ $ta->score }} puan — {{ $ta->severityLabel() }}</a>
                                        @else
                                            <span class="badge bg-secondary">Bekliyor</span>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted small mb-0">Henüz test atanmadı.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <h6>Randevu / Seans Geçmişi ({{ $appointments->count() }})</h6>
                            @if($appointments->isEmpty())
                                <p class="text-muted">Bu danışanın henüz randevu kaydı yok.</p>
                            @else
                                <div class="crm-timeline">
                                    @foreach($appointments as $a)
                                        <div class="crm-timeline-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong>
                                                    <a href="/admin/randevular/{{ $a->id }}">
                                                        {{ $a->starts_at->translatedFormat('d F Y, H:i') }}
                                                    </a>
                                                </strong>
                                                <span class="badge bg-primary">{{ $a->statusLabel() }}</span>
                                            </div>
                                            <div class="text-muted small">
                                                {{ $a->service?->title ?? 'Görüşme türü belirtilmemiş' }}
                                                @if($a->psychologist) · {{ $a->psychologist->name }} @endif
                                                · {{ $a->sourceLabel() }}
                                            </div>
                                            @if($a->doctor_notes)
                                                <div class="crm-timeline-note">
                                                    <strong>Seans Notu:</strong> {{ $a->doctor_notes }}
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .crm-timeline-item { padding: 14px 0; border-bottom: 1px solid rgba(0,0,0,0.08); }
        .crm-timeline-item:last-child { border-bottom: none; }
        .crm-timeline-note { margin-top:8px; padding:10px 12px; background:rgba(91,141,239,.08); border-radius:6px; font-size:14px; }
    </style>
@endsection
