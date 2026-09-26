<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Danışan Raporu - {{ $patient->name }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #1F2D30; }
        h1 { font-size: 20px; margin-bottom: 4px; }
        .alt-baslik { color: #6B7B7E; margin-bottom: 20px; }
        table.bilgi { width: 100%; margin-bottom: 24px; border-collapse: collapse; }
        table.bilgi td { padding: 4px 8px; vertical-align: top; }
        table.bilgi td.etiket { color: #6B7B7E; width: 140px; }
        .ozet-kutu { background: #F7F5F0; border: 1px solid #ddd; border-radius: 6px; padding: 12px 16px; margin-bottom: 20px; }
        .seans { border: 1px solid #ddd; border-radius: 6px; padding: 12px 16px; margin-bottom: 12px; page-break-inside: avoid; }
        .seans .baslik { font-weight: bold; font-size: 13px; margin-bottom: 4px; }
        .durum { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 10px; background: #eee; }
        .not-alani { margin-top: 8px; background: #fafafa; border-left: 3px solid #D9784B; padding: 8px 10px; }
        .altbilgi { margin-top: 30px; font-size: 10px; color: #999; text-align: center; }
    </style>
</head>
<body>
    <h1>Danışan Raporu</h1>
    <div class="alt-baslik">Oluşturulma tarihi: {{ now()->translatedFormat('d F Y, H:i') }}</div>

    <table class="bilgi">
        <tr><td class="etiket">Ad Soyad</td><td><strong>{{ $patient->name }}</strong></td></tr>
        <tr><td class="etiket">Telefon</td><td>{{ $patient->phone }}</td></tr>
        <tr><td class="etiket">E-posta</td><td>{{ $patient->email ?? '—' }}</td></tr>
        <tr><td class="etiket">Doğum Tarihi</td><td>{{ $patient->birth_date?->format('d.m.Y') ?? '—' }}</td></tr>
        <tr><td class="etiket">Kayıt Tarihi</td><td>{{ $patient->created_at->format('d.m.Y') }}</td></tr>
        @if($patient->notes)
        <tr><td class="etiket">Genel Not</td><td>{{ $patient->notes }}</td></tr>
        @endif
    </table>

    <div class="ozet-kutu">
        Toplam randevu: <strong>{{ $appointments->count() }}</strong> ·
        Tamamlanan: <strong>{{ $appointments->where('status', 'tamamlandi')->count() }}</strong> ·
        Gelmedi: <strong>{{ $appointments->where('status', 'gelmedi')->count() }}</strong> ·
        İptal: <strong>{{ $appointments->where('status', 'iptal')->count() }}</strong>
    </div>

    <h3>Randevu / Seans Geçmişi</h3>

    @forelse($appointments as $a)
        <div class="seans">
            <div class="baslik">
                {{ $a->starts_at->translatedFormat('d F Y, H:i') }}
                <span class="durum">{{ $a->statusLabel() }}</span>
            </div>
            <div>
                {{ $a->service?->title ?? 'Görüşme türü belirtilmemiş' }}
                @if($a->psychologist) · {{ $a->psychologist->name }} @endif
                · {{ $a->sourceLabel() }}
            </div>
            @if($a->request_note)
                <div class="not-alani"><strong>Danışan Notu:</strong> {{ $a->request_note }}</div>
            @endif
            @if($a->doctor_notes)
                <div class="not-alani"><strong>Seans Notu:</strong> {{ $a->doctor_notes }}</div>
            @endif
        </div>
    @empty
        <p>Bu danışanın kayıtlı bir randevu geçmişi yok.</p>
    @endforelse

    <h3>Öz-Değerlendirme Testleri</h3>
    @forelse($testAssignments as $ta)
        <div class="seans">
            <div class="baslik">
                {{ $ta->test->name }}
                <span class="durum">{{ $ta->isCompleted() ? 'Tamamlandı' : 'Bekliyor' }}</span>
            </div>
            <div>
                Atanma: {{ $ta->created_at->format('d.m.Y') }}
                @if($ta->isCompleted())
                    · Tamamlanma: {{ $ta->completed_at->format('d.m.Y') }}
                    · Puan: <strong>{{ $ta->score }} ({{ $ta->severityLabel() }})</strong>
                @endif
            </div>
        </div>
    @empty
        <p>Bu danışana henüz bir test atanmadı.</p>
    @endforelse

    <div class="altbilgi">Bu rapor gizlilik ilkesi çerçevesinde sadece yetkili personel tarafından kullanılmak üzere oluşturulmuştur.</div>
</body>
</html>
