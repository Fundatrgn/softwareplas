@extends('danisan.layout')
@section('content')
    <div class="danisan-portal-card">
        <h4 class="text-center mb-1">Danışan Portalı</h4>
        <p class="text-center text-muted mb-4">Size iletilen kullanıcı adı ve şifre ile giriş yapın.</p>

        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    {{ $error }}
                @endforeach
            </div>
        @endif

        <form method="POST" action="/danisan/giris">
            @csrf
            <div class="mb-3">
                <label class="form-label">Kullanıcı Adı</label>
                <input type="text" class="form-control" name="username" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Şifre</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-marya">Giriş Yap</button>
            </div>
        </form>
        <p class="text-center text-muted small mt-4">Şifrenizi unuttuysanız kliniğimizle iletişime geçin; yeni bir şifre size e-posta ile gönderilecektir.</p>
    </div>
@endsection
