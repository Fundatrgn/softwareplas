<form method="POST" action="{{ $action }}">
    @csrf
    <div class="mb-3">
        <label class="form-label">Soru Metni *</label>
        <textarea class="form-control" name="text" rows="2" required>{{ old('text', $question->text ?? '') }}</textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Cevap Tipi *</label>
        <select class="form-select soru-tip-secim" name="type" required>
            @foreach(\App\Models\TestQuestion::TYPES as $key => $label)
                <option value="{{ $key }}" {{ old('type', $question->type ?? 'single_choice') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <div class="form-text">Tek Seçim: danışan sadece bir seçenek işaretler. Çoklu Seçim: birden fazla seçenek işaretleyebilir. Açık Uçlu: danışan serbest metin yazar (puanlamaya dahil edilmez).</div>
    </div>

    <div class="secenekler-alani mb-3">
        <label class="form-label">Seçenekler (etiket ve puan değeri)</label>
        <div class="secenek-satirlari">
            @php $mevcutSecenekler = old('option_label') ? collect(old('option_label'))->map(fn($l, $i) => ['label' => $l, 'value' => old('option_value')[$i] ?? 0]) : ($question->options ?? collect()); @endphp
            @forelse($mevcutSecenekler as $opt)
                <div class="row g-2 mb-2 secenek-satiri">
                    <div class="col-7">
                        <input type="text" class="form-control form-control-sm" name="option_label[]" placeholder="Seçenek metni" value="{{ is_array($opt) ? $opt['label'] : $opt->label }}">
                    </div>
                    <div class="col-3">
                        <input type="number" class="form-control form-control-sm" name="option_value[]" placeholder="Puan" value="{{ is_array($opt) ? $opt['value'] : $opt->value }}">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-outline-danger btn-sm secenek-sil">&times;</button>
                    </div>
                </div>
            @empty
            @endforelse
        </div>
        <button type="button" class="btn btn-outline-secondary btn-sm secenek-ekle">+ Seçenek Ekle</button>
    </div>

    <button type="submit" class="btn btn-primary px-4">Kaydet</button>
</form>

<script>
(function () {
    document.querySelectorAll('.soru-tip-secim').forEach(function (select) {
        function guncelle() {
            var form = select.closest('form');
            var alan = form.querySelector('.secenekler-alani');
            alan.style.display = (select.value === 'text') ? 'none' : 'block';
        }
        select.addEventListener('change', guncelle);
        guncelle();
    });

    document.querySelectorAll('.secenek-ekle').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var form = btn.closest('form');
            var satirlar = form.querySelector('.secenek-satirlari');
            var yeni = document.createElement('div');
            yeni.className = 'row g-2 mb-2 secenek-satiri';
            yeni.innerHTML = '<div class="col-7"><input type="text" class="form-control form-control-sm" name="option_label[]" placeholder="Seçenek metni"></div>' +
                '<div class="col-3"><input type="number" class="form-control form-control-sm" name="option_value[]" placeholder="Puan"></div>' +
                '<div class="col-2"><button type="button" class="btn btn-outline-danger btn-sm secenek-sil">&times;</button></div>';
            satirlar.appendChild(yeni);
        });
    });

    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('secenek-sil')) {
            e.target.closest('.secenek-satiri').remove();
        }
    });
})();
</script>
