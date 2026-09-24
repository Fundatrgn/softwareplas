<form class="form-contact {{ $formClass ?? '' }} effectFade fadeUp" action="{{ url('/iletisim') }}" method="POST" novalidate>
    @csrf
    <h2 class="heading h4 fw-semibold">Bana bir mesaj bırakın</h2>
    @if (session('contact_success'))
        <div class="form-alert success">{{ session('contact_success') }}</div>
    @endif
    @if ($errors->any())
        <div class="form-alert error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    {{-- Spam botları için gizli alan (gerçek ziyaretçiler görmez) --}}
    <div class="hp-field" aria-hidden="true">
        <label>Web siteniz <input type="text" name="website" tabindex="-1" autocomplete="off"></label>
    </div>
    <fieldset class="mb-21">
        <label for="c-name" class="fw-semibold text-body-3 mb-20">Adınız Soyadınız *</label>
        <input id="c-name" type="text" name="name" value="{{ old('name') }}" placeholder="Adınızı ve soyadınızı yazın" required maxlength="120">
    </fieldset>
    <fieldset class="mb-21">
        <label for="c-email" class="fw-semibold text-body-3 mb-20">E-posta Adresiniz *</label>
        <input id="c-email" type="email" name="email" value="{{ old('email') }}" placeholder="ornek@eposta.com" required maxlength="190">
    </fieldset>
    <fieldset class="mb-21">
        <label for="c-phone" class="fw-semibold text-body-3 mb-20">Telefon (isteğe bağlı)</label>
        <input id="c-phone" type="tel" name="phone" value="{{ old('phone') }}" placeholder="05xx xxx xx xx" maxlength="40">
    </fieldset>
    <fieldset class="mb-21">
        <label for="c-type" class="fw-semibold text-body-3 mb-20">Konu</label>
        <input id="c-type" type="text" name="type" value="{{ old('type') }}" placeholder="Web sitesi, iş birliği, röportaj..." maxlength="120">
    </fieldset>
    <fieldset class="mb-18">
        <label for="c-content" class="fw-semibold text-body-3 mb-0">Mesajınız *</label>
        <textarea id="c-content" name="content" required maxlength="5000">{{ old('content') }}</textarea>
    </fieldset>
    <label class="kvkk-check">
        <input type="checkbox" name="kvkk" value="1" {{ old('kvkk') ? 'checked' : '' }} required>
        <span><a href="{{ url('/kvkk') }}" target="_blank" class="link1">KVKK Aydınlatma Metni</a>'ni okudum, kişisel verilerimin iletişim amacıyla işlenmesini kabul ediyorum.</span>
    </label>
    <button type="submit" class="tf-btn w-100">Mesajı Gönder</button>
</form>
