<div class="ori-kvkk-check" style="margin: 10px 0 20px;">
    <label style="display:flex; align-items:flex-start; gap:10px; cursor:pointer; color: var(--body-color); font-size:14px; font-weight:400;">
        <input type="checkbox" name="kvkk_onay" required style="margin-top:4px; flex-shrink:0; width:16px; height:16px;">
        <span>
            <a href="#" id="kvkk-ac-btn" style="color: var(--base-color-1); text-decoration:underline; font-weight:600;">KVKK Aydınlatma Metni</a>'ni okudum, anladım ve kabul ediyorum. *
        </span>
    </label>
</div>

<div id="kvkk-modal-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.65); z-index:99999; align-items:center; justify-content:center; padding:20px;">
    <div style="background: var(--dark-surface); border-radius:12px; max-width:600px; width:100%; max-height:65vh; display:flex; flex-direction:column; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.5);">
        <div style="padding:18px 24px; border-bottom:1px solid var(--surface-border); display:flex; justify-content:space-between; align-items:center; flex-shrink:0;">
            <h4 style="margin:0; color:var(--heading-color); font-size:18px;">KVKK Aydınlatma Metni</h4>
            <button type="button" id="kvkk-kapat-btn" aria-label="Kapat" style="background:none; border:none; color:var(--heading-color); font-size:26px; cursor:pointer; line-height:1; padding:0;">&times;</button>
        </div>
        <div style="padding:20px 24px; overflow-y:auto; color:var(--body-color); font-size:14px; line-height:1.8;">
            {!! $settings->kvkk_text ?? '<p>KVKK metni henüz eklenmemiş. Admin panelinden Ayarlar sayfasından ekleyebilirsiniz.</p>' !!}
        </div>
    </div>
</div>

<script>
(function () {
    var openBtn = document.getElementById('kvkk-ac-btn');
    var closeBtn = document.getElementById('kvkk-kapat-btn');
    var overlay = document.getElementById('kvkk-modal-overlay');
    if (openBtn && overlay) {
        openBtn.addEventListener('click', function (e) {
            e.preventDefault();
            overlay.style.display = 'flex';
        });
    }
    if (closeBtn && overlay) {
        closeBtn.addEventListener('click', function () {
            overlay.style.display = 'none';
        });
    }
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) overlay.style.display = 'none';
        });
    }
})();
</script>
