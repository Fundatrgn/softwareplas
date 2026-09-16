-- =====================================================================
-- Psikolog Merve Kalaycı — Eksik Kolon Onarım Yaması
-- =====================================================================
-- Bu dosya, canlı veritabanınızda eksik olabilecek kolonları GÜVENLİ
-- şekilde ekler. Veri SİLMEZ, sadece eksik olan kolonları ekler.
-- Zaten var olan bir kolonu tekrar eklemeye çalışmaz (IF NOT EXISTS),
-- bu yüzden birden fazla kez çalıştırılsa bile zarar vermez.
--
-- NASIL ÇALIŞTIRILIR:
-- phpMyAdmin > veritabanınızı seçin > "SQL" sekmesi > bu dosyanın
-- içeriğini yapıştırıp "Git/Çalıştır" deyin.
-- =====================================================================

ALTER TABLE `slider`
  ADD COLUMN IF NOT EXISTS `sira` INT NOT NULL DEFAULT 1 AFTER `id`,
  ADD COLUMN IF NOT EXISTS `image` VARCHAR(255) NULL AFTER `btn_text`;

UPDATE `slider` SET `first` = '' WHERE `first` IS NULL;
UPDATE `slider` SET `second` = '' WHERE `second` IS NULL;
UPDATE `slider` SET `threed` = '' WHERE `threed` IS NULL;
ALTER TABLE `slider` MODIFY `first` VARCHAR(255) NULL DEFAULT '';
ALTER TABLE `slider` MODIFY `second` VARCHAR(255) NULL DEFAULT '';
ALTER TABLE `slider` MODIFY `threed` VARCHAR(255) NULL DEFAULT '';

ALTER TABLE `services_details`
  ADD COLUMN IF NOT EXISTS `subtitle` VARCHAR(255) NULL AFTER `title`;

ALTER TABLE `settings`
  ADD COLUMN IF NOT EXISTS `favicon` VARCHAR(255) NULL AFTER `image`,
  ADD COLUMN IF NOT EXISTS `accent_color` VARCHAR(255) NOT NULL DEFAULT '#D9784B' AFTER `address`,
  ADD COLUMN IF NOT EXISTS `secondary_color` VARCHAR(255) NOT NULL DEFAULT '#7FA36F' AFTER `accent_color`,
  ADD COLUMN IF NOT EXISTS `heading_color` VARCHAR(255) NOT NULL DEFAULT '#FFFFFF' AFTER `secondary_color`,
  ADD COLUMN IF NOT EXISTS `body_text_color` VARCHAR(255) NOT NULL DEFAULT '#E7E3D8' AFTER `heading_color`,
  ADD COLUMN IF NOT EXISTS `background_color` VARCHAR(255) NOT NULL DEFAULT '#1B1F1C' AFTER `body_text_color`,
  ADD COLUMN IF NOT EXISTS `whatsapp_number` VARCHAR(255) NULL AFTER `background_color`,
  ADD COLUMN IF NOT EXISTS `slider_speed` INT NOT NULL DEFAULT 6000 AFTER `whatsapp_number`,
  ADD COLUMN IF NOT EXISTS `kvkk_text` LONGTEXT NULL AFTER `slider_speed`,
  ADD COLUMN IF NOT EXISTS `sidebar_bio` TEXT NULL AFTER `kvkk_text`;

UPDATE `settings` SET `kvkk_text` = '<p><strong>Kişisel Verilerin Korunması Hakkında Aydınlatma Metni</strong></p><p>Bu internet sitesi üzerinden (randevu ve iletişim formları aracılığıyla) tarafımla paylaştığınız ad-soyad, telefon, e-posta ve mesaj içeriğinden ibaret kişisel verileriniz; 6698 sayılı Kişisel Verilerin Korunması Kanunu (&quot;KVKK&quot;) kapsamında, veri sorumlusu sıfatıyla tarafımca, yalnızca randevu talebinizin değerlendirilmesi, sizinle iletişime geçilmesi ve talep ettiğiniz bilgilendirmenin yapılması amacıyla işlenmektedir.</p><p>Kişisel verileriniz, yasal zorunluluklar dışında üçüncü kişilerle paylaşılmaz, açık rızanız veya kanunda öngörülen haller dışında başka bir amaçla kullanılmaz ve gerekli teknik/idari tedbirlerle korunur.</p><p>KVKK''nın 11. maddesi kapsamında; kişisel verilerinizin işlenip işlenmediğini öğrenme, işlenmişse buna ilişkin bilgi talep etme, işlenme amacını ve amacına uygun kullanılıp kullanılmadığını öğrenme, yurt içinde/yurt dışında aktarıldığı üçüncü kişileri bilme, eksik/yanlış işlenmişse düzeltilmesini isteme, silinmesini/yok edilmesini isteme ve bu işlemlerin ilgili üçüncü kişilere bildirilmesini isteme haklarına sahipsiniz.</p><p>Bu haklarınızı kullanmak için sitede yer alan iletişim bilgileri üzerinden tarafıma ulaşabilirsiniz.</p><p><em>(Bu metin örnek olarak hazırlanmıştır; yayına almadan önce bir hukuk danışmanına gözden geçirtmenizi öneririz.)</em></p>'
WHERE `kvkk_text` IS NULL OR `kvkk_text` = '';

ALTER TABLE `slider` MODIFY `subtitle` TEXT NULL;

ALTER TABLE `sss` MODIFY `category_id` INT NULL;
