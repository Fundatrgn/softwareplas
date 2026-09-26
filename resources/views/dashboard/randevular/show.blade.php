@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">Randevu Detayı</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="/admin/randevular/liste">Tüm Randevular</a></li>
                            <li class="breadcrumb-item active">#{{ $appointment->id }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="ms-auto d-flex gap-2">
                    <a href="/admin/randevular/{{ $appointment->id }}/duzenle" class="btn btn-outline-primary">
                        <ion-icon name="create-outline"></ion-icon> Düzenle
                    </a>
                    <form method="POST" action="/admin/randevular/{{ $appointment->id }}/sil" onsubmit="return confirm('Bu randevuyu kalıcı olarak silmek istediğinize emin misiniz?');">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">
                            <ion-icon name="trash-outline"></ion-icon> Sil
                        </button>
                    </form>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <div class="row">
                <div class="col-lg-7">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="d-flex justify-content-between align-items-center">
                                {{ $appointment->starts_at->translatedFormat('d F Y, H:i') }} - {{ $appointment->ends_at->format('H:i') }}
                                <span class="badge bg-primary">{{ $appointment->displayStatusLabel() }}</span>
                            </h5>
                            <table class="table">
                                <tr>
                                    <th style="width:180px">Danışan</th>
                                    <td>
                                        <a href="/admin/danisanlar/{{ $appointment->patient_id }}">
                                            {{ $appointment->patient_name_snapshot ?? $appointment->patient?->name }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Telefon</th>
                                    <td>{{ $appointment->patient_phone_snapshot ?? $appointment->patient?->phone }}</td>
                                </tr>
                                <tr>
                                    <th>E-posta</th>
                                    <td>{{ $appointment->patient_email_snapshot ?? $appointment->patient?->email ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Görüşme Türü</th>
                                    <td>{{ $appointment->service?->title ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Psikolog</th>
                                    <td>{{ $appointment->psychologist?->name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Terapi Odası</th>
                                    <td>{{ $appointment->room?->name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <th>Kaynak</th>
                                    <td>{{ $appointment->sourceLabel() }}</td>
                                </tr>
                                <tr>
                                    <th>Oluşturan</th>
                                    <td>{{ $appointment->createdBy?->name ?? 'Web sitesi (ziyaretçi)' }}</td>
                                </tr>
                                <tr>
                                    <th>Son Güncelleyen</th>
                                    <td>
                                        @if($appointment->lastUpdatedBy)
                                            {{ $appointment->lastUpdatedBy->name }}
                                            <span class="text-muted small">— {{ ucfirst($appointment->last_action ?? '') }} · {{ $appointment->updated_at->translatedFormat('d.m.Y H:i') }}</span>
                                        @else
                                            —
                                        @endif
                                    </td>
                                </tr>
                                @if($appointment->request_note)
                                <tr>
                                    <th>Danışan Notu</th>
                                    <td>{{ $appointment->request_note }}</td>
                                </tr>
                                @endif
                                @if($appointment->cancel_reason)
                                <tr>
                                    <th>İptal Nedeni</th>
                                    <td>{{ $appointment->cancel_reason }}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Seans Notu (Doktor Notu)</h6>
                            <p class="text-muted small">Randevu "Tamamlandı" olarak işaretlenirken bu alan zorunludur; danışanın CRM geçmişinde saklanır.</p>
                            <form method="POST" action="/admin/randevular/{{ $appointment->id }}/durum" id="tamamla-form">
                                @csrf
                                <input type="hidden" name="status" value="tamamlandi">
                                <textarea class="form-control mb-3" name="doctor_notes" rows="6" placeholder="Seans notunu buraya yazın...">{{ old('doctor_notes', $appointment->doctor_notes) }}</textarea>
                                <button type="submit" class="btn btn-success">
                                    <ion-icon name="checkmark-done-outline"></ion-icon>
                                    {{ $appointment->isCompleted() ? 'Notu Güncelle' : 'Tamamlandı Olarak İşaretle' }}
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Randevuyu Yeniden Planla</h6>
                            <p class="text-muted small">Danışan aynı kalır, sadece gün/saat değişir. İstediğiniz saati serbestçe girebilirsiniz (sabit bir saat listesiyle sınırlı değildir); sadece gerçek bir çakışma engellenir.</p>
                            <form method="POST" action="/admin/randevular/{{ $appointment->id }}/tasi">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-md-4">
                                        <label class="form-label">Yeni Tarih</label>
                                        <input type="date" class="form-control" name="tarih" required value="{{ $appointment->starts_at->toDateString() }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Yeni Saat</label>
                                        <input type="time" class="form-control" name="saat" required value="{{ $appointment->starts_at->format('H:i') }}" step="300">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Süre (dk)</label>
                                        <input type="number" class="form-control" name="sure" min="10" max="240" step="5" value="{{ $appointment->duration_minutes }}">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-primary mt-3">Randevuyu Taşı</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Durum İşlemleri</h6>
                            <div class="d-grid gap-2">
                                @if($appointment->status !== \App\Models\Appointment::STATUS_CONFIRMED)
                                <form method="POST" action="/admin/randevular/{{ $appointment->id }}/durum">
                                    @csrf
                                    <input type="hidden" name="status" value="onaylandi">
                                    <label class="form-label small mb-1">Terapi Odası *</label>
                                    <select name="room_id" class="form-select mb-2" required>
                                        <option value="">Oda seçin...</option>
                                        @foreach(\App\Models\Room::where('is_active', true)->orderBy('name')->get() as $oda)
                                            <option value="{{ $oda->id }}" {{ $appointment->room_id == $oda->id ? 'selected' : '' }}>{{ $oda->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-outline-primary w-100">Onayla</button>
                                </form>
                                @endif

                                @if($appointment->status !== \App\Models\Appointment::STATUS_NO_SHOW)
                                <form method="POST" action="/admin/randevular/{{ $appointment->id }}/durum">
                                    @csrf
                                    <input type="hidden" name="status" value="gelmedi">
                                    <button type="submit" class="btn btn-outline-warning w-100">Danışan Gelmedi</button>
                                </form>
                                @endif

                                @if($appointment->status !== \App\Models\Appointment::STATUS_CANCELLED)
                                <form method="POST" action="/admin/randevular/{{ $appointment->id }}/durum" onsubmit="return confirmIptal(this)">
                                    @csrf
                                    <input type="hidden" name="status" value="iptal">
                                    <input type="text" name="cancel_reason" class="form-control mb-2" placeholder="İptal nedeni (opsiyonel)">
                                    <button type="submit" class="btn btn-outline-danger w-100">Randevuyu İptal Et</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h6>Bildirim Geçmişi</h6>
                            @if($appointment->notificationLogs->isEmpty())
                                <p class="text-muted small mb-0">Henüz bildirim gönderilmedi.</p>
                            @else
                                <ul class="list-group list-group-flush">
                                    @foreach($appointment->notificationLogs as $log)
                                    <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                                        <span>
                                            <strong>{{ strtoupper($log->channel) }}</strong> — {{ $log->type }}
                                            <br><small class="text-muted">{{ $log->recipient }} · {{ $log->created_at->diffForHumans() }}</small>
                                        </span>
                                        <span class="badge {{ $log->status === 'gonderildi' ? 'bg-success' : 'bg-danger' }}">{{ $log->status }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function confirmIptal(form) {
            return confirm('Bu randevuyu iptal etmek istediğinize emin misiniz?');
        }
    </script>
@endsection
