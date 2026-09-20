@extends('dashboard.layout.template')
@section('content')
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                <div class="breadcrumb-title pe-3">E-posta Ayarları</div>
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0 align-items-center">
                            <li class="breadcrumb-item"><a href="javascript:;"><ion-icon name="home-outline"></ion-icon></a></li>
                            <li class="breadcrumb-item active" aria-current="page">E-posta Ayarları</li>
                        </ol>
                    </nav>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="/admin/email-ayarlar">
                @csrf
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" role="switch" id="notify_email_enabled" name="notify_email_enabled" value="1" {{ ($data->notify_email_enabled ?? true) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold" for="notify_email_enabled">E-posta Bildirimleri Açık</label>
                                </div>
                                <p class="text-muted small mb-0">Kapatırsanız, aşağıdaki hiçbir otomatik e-posta gönderilmez (SMS ayarları etkilenmez — bkz. Site Ayarları &gt; Randevu Bildirimleri).</p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <ion-icon name="checkmark-circle-outline" style="font-size:22px; color:#5b8def;"></ion-icon>
                                    <h6 class="mb-0">Randevu Onay E-postası</h6>
                                    <span class="badge bg-success ms-auto">Otomatik</span>
                                </div>
                                <p class="text-muted small mb-0">Bir randevu oluşturulduğunda veya durumu değiştiğinde (onaylandı / iptal edildi / tamamlandı), danışana otomatik olarak bilgilendirme e-postası gönderilir. Ayrıca bekleyen randevularda e-postaya bir "Randevuyu İptal Et" bağlantısı eklenir.</p>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <ion-icon name="time-outline" style="font-size:22px; color:#e39b3b;"></ion-icon>
                                    <h6 class="mb-0">Randevu Hatırlatma E-postaları</h6>
                                </div>
                                <p class="text-muted small">Randevu tarihinden kaç gün önce hatırlatma e-postası gönderilsin? Birden fazla seçebilirsiniz — örneğin hem "7 gün kala" hem "1 gün kala" işaretlerseniz danışan iki ayrı hatırlatma alır.</p>
                                <div class="d-flex flex-wrap gap-3">
                                    @php $secilenler = $data->reminder_intervals_days ?? [1]; @endphp
                                    @foreach($hatirlatmaSecenekleri as $gun => $etiket)
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="reminder_intervals_days[]" id="hatirlatma_{{ $gun }}" value="{{ $gun }}" {{ in_array($gun, $secilenler) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="hatirlatma_{{ $gun }}">{{ $etiket }}</label>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="alert alert-info small mt-3 mb-0">
                                    Hatırlatma e-postalarının gerçekten gönderilmesi için sunucuda Laravel zamanlayıcısının (<code>schedule:run</code>) her dakika cron ile çalışıyor olması gerekir. Barındırma sağlayıcınızın cPanel/Plesk panelinden "Cron Job" ekleyip şunu tanımlayın:
                                    <br><code>* * * * * php /path/to/artisan schedule:run &gt;&gt; /dev/null 2&gt;&1</code>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary px-4">Kaydet</button>
                    </div>

                    <div class="col-lg-5">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="mb-2">Örnek E-posta Görünümü</h6>
                                <p class="text-muted small">Danışanlara gerçekte böyle bir e-posta gider (örnek veriyle):</p>
                                <iframe src="/admin/email-ayarlar/onizleme" style="width:100%; height:520px; border:1px solid #e5e5e5; border-radius:8px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
