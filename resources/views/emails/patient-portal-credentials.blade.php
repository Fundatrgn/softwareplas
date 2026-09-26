<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Danışan Portalı Giriş Bilgileriniz</title>
</head>
<body style="font-family: Arial, sans-serif; background:#F7F3EA; padding:24px; color:#18212B;">
    <div style="max-width:520px; margin:0 auto; background:#FFFFFF; border-radius:12px; padding:32px; border:1px solid rgba(24,33,43,0.12);">
        <h2 style="color:#18212B; margin-top:0;">Danışan Portalı Giriş Bilgileriniz</h2>
        <p style="color:#45566B;">Merhaba {{ $patient->name }},</p>
        <p style="color:#45566B;">Randevunuz onaylandı. Size atanan formları/testleri doldurabilmeniz için danışan portalımıza aşağıdaki bilgilerle giriş yapabilirsiniz.</p>

        <table style="width:100%; border-collapse:collapse; margin-top:20px;">
            <tr>
                <td style="padding:8px 0; color:#6B7B7E;">Kullanıcı Adı</td>
                <td style="padding:8px 0; font-weight:600;">{{ $patient->username }}</td>
            </tr>
            <tr>
                <td style="padding:8px 0; color:#6B7B7E;">Şifre</td>
                <td style="padding:8px 0; font-weight:600;">{{ $plainPassword }}</td>
            </tr>
        </table>

        <div style="margin-top:28px; text-align:center;">
            <a href="{{ $loginUrl }}" style="display:inline-block; background:#223B52; color:#fff; padding:12px 22px; border-radius:8px; text-decoration:none; font-weight:600; font-size:14px;">
                Danışan Portalına Giriş Yap
            </a>
        </div>

        <p style="margin-top:28px; font-size:13px; color:#8a9599;">Şifrenizi güvenlik nedeniyle kendiniz değiştiremezsiniz; yeni bir şifreye ihtiyaç duyarsanız kliniğimizle iletişime geçmeniz yeterlidir. Bu e-posta otomatik olarak gönderilmiştir.</p>
    </div>
</body>
</html>
