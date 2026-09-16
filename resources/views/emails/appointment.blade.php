<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>{{ $heading }}</title>
</head>
<body style="font-family: Arial, sans-serif; background:#F7F5F0; padding:24px; color:#1F2D30;">
    <div style="max-width:520px; margin:0 auto; background:#FFFFFF; border-radius:12px; padding:32px; border:1px solid rgba(31,45,48,0.12);">
        <h2 style="color:#1F2D30; margin-top:0;">{{ $heading }}</h2>
        <p style="color:#4B5A5E;">{{ $intro }}</p>

        <table style="width:100%; border-collapse:collapse; margin-top:20px;">
            <tr>
                <td style="padding:8px 0; color:#6B7B7E;">Danışan</td>
                <td style="padding:8px 0; font-weight:600;">{{ $appointment->patient_name_snapshot ?? $appointment->patient?->name }}</td>
            </tr>
            <tr>
                <td style="padding:8px 0; color:#6B7B7E;">Tarih</td>
                <td style="padding:8px 0; font-weight:600;">{{ $appointment->starts_at->translatedFormat('d F Y, l') }}</td>
            </tr>
            <tr>
                <td style="padding:8px 0; color:#6B7B7E;">Saat</td>
                <td style="padding:8px 0; font-weight:600;">{{ $appointment->starts_at->format('H:i') }} - {{ $appointment->ends_at->format('H:i') }}</td>
            </tr>
            @if($appointment->service)
            <tr>
                <td style="padding:8px 0; color:#6B7B7E;">Görüşme Türü</td>
                <td style="padding:8px 0; font-weight:600;">{{ $appointment->service->title }}</td>
            </tr>
            @endif
            <tr>
                <td style="padding:8px 0; color:#6B7B7E;">Durum</td>
                <td style="padding:8px 0; font-weight:600;">{{ $appointment->statusLabel() }}</td>
            </tr>
        </table>

        @if($appointment->request_note)
        <p style="margin-top:20px; color:#4B5A5E;"><strong>Not:</strong> {{ $appointment->request_note }}</p>
        @endif

        @if(!empty($cancelUrl))
        <div style="margin-top:28px; text-align:center;">
            <a href="{{ $cancelUrl }}" style="display:inline-block; background:#f3e9e6; color:#a94442; padding:12px 22px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px;">
                Randevuyu İptal Et
            </a>
        </div>
        @endif

        <p style="margin-top:28px; font-size:13px; color:#8a9599;">Bu e-posta otomatik olarak gönderilmiştir.</p>
    </div>
</body>
</html>
