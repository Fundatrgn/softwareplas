<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * Admin panelindeki tüm görsel yükleme formları için ortak, güvenli
     * yükleme yardımcısı. Öncesinde: her kontrolcü kendi başına
     * $image->move(...) çağırıyordu; hedef klasör yoksa, dosya izinleri
     * uygun değilse ya da (.jfif gibi) beklenmedik bir uzantı gelirse
     * bu, kullanıcıya hiçbir açıklama vermeden ham bir 500 hatası olarak
     * dönüyordu. Bu yardımcı; klasörü gerekirse oluşturur, geçerli bir
     * görsel uzantısı olup olmadığını kontrol eder ve olası bir yazma
     * hatasını yakalayıp okunabilir bir istisna olarak fırlatır.
     *
     * @param  Request  $request
     * @param  string   $field  Formdaki input adı (varsayılan: "image")
     * @return string|null      Kaydedilen dosya adı, dosya yoksa null
     *
     * @throws \RuntimeException  Yükleme başarısız olursa, gösterilebilir bir mesajla
     */
    protected function uploadImage(Request $request, string $field = 'image'): ?string
    {
        if (!$request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);

        if (!$file->isValid()) {
            // Genellikle sunucudaki upload_max_filesize/post_max_size
            // limitinden büyük bir dosya seçildiğinde oluşur.
            throw new \RuntimeException('Görsel yüklenemedi. Dosya boyutu sunucu limitini aşıyor olabilir (genellikle 2-8MB arası).');
        }

        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'jfif', 'bmp'];
        $extension = strtolower($file->getClientOriginalExtension());
        // .jfif pratikte bir JPEG dosyasıdır; sunucuların çoğu bu uzantıyı
        // doğru şekilde sunmayabildiği için diskte .jpg olarak saklıyoruz.
        if ($extension === 'jfif') {
            $extension = 'jpg';
        }
        if (!in_array($extension, $allowedExtensions, true)) {
            throw new \RuntimeException('Desteklenmeyen dosya türü (' . $extension . '). Lütfen jpg, png, webp, gif veya svg formatında bir görsel seçin.');
        }

        $destination = public_path('images');
        if (!File::exists($destination)) {
            File::makeDirectory($destination, 0755, true);
        }

        $imageName = time() . '_' . uniqid() . '.' . $extension;

        try {
            $file->move($destination, $imageName);
        } catch (\Throwable $e) {
            Log::error('Görsel yükleme hatası: ' . $e->getMessage());
            throw new \RuntimeException('Görsel sunucuya kaydedilemedi. "images" klasörünün yazma izni olduğundan emin olun.');
        }

        return $imageName;
    }

    /**
     * Yüklenen bir görseli, verilen genişlik/yükseklik oranına göre
     * ortadan kırpıp yeniden boyutlandırır (CSS "object-fit: cover" ile
     * aynı mantık). Blog/Hizmetler gibi kart görünümlerinde, danışan
     * hangi boyutta/oranda bir fotoğraf yüklerse yüklesin, kartların
     * hepsi sitede aynı boyutta ve düzgün görünsün diye kullanılır.
     * Orijinal dosya boyutu ne olursa olsun sonuç her zaman
     * $targetWidth x $targetHeight olur.
     */
    protected function resizeAndCropImage(string $absolutePath, int $targetWidth, int $targetHeight): void
    {
        if (! extension_loaded('gd') || ! File::exists($absolutePath)) {
            return;
        }

        $info = @getimagesize($absolutePath);
        if (! $info) {
            return;
        }

        [$width, $height, $type] = $info;

        try {
            $source = match ($type) {
                IMAGETYPE_JPEG => imagecreatefromjpeg($absolutePath),
                IMAGETYPE_PNG => imagecreatefrompng($absolutePath),
                IMAGETYPE_GIF => imagecreatefromgif($absolutePath),
                IMAGETYPE_WEBP => function_exists('imagecreatefromwebp') ? imagecreatefromwebp($absolutePath) : null,
                default => null, // svg ve desteklenmeyen türler kırpılmadan bırakılır
            };
        } catch (\Throwable $e) {
            $source = null;
        }

        if (! $source) {
            return;
        }

        // Kaynak üzerinde, hedef oranla eşleşen en büyük merkezi alanı seç.
        $sourceRatio = $width / $height;
        $targetRatio = $targetWidth / $targetHeight;

        if ($sourceRatio > $targetRatio) {
            $cropHeight = $height;
            $cropWidth = (int) round($height * $targetRatio);
        } else {
            $cropWidth = $width;
            $cropHeight = (int) round($width / $targetRatio);
        }

        $srcX = (int) round(($width - $cropWidth) / 2);
        $srcY = (int) round(($height - $cropHeight) / 2);

        $canvas = imagecreatetruecolor($targetWidth, $targetHeight);

        if ($type === IMAGETYPE_PNG || $type === IMAGETYPE_GIF) {
            imagealphablending($canvas, false);
            imagesavealpha($canvas, true);
            $transparent = imagecolorallocatealpha($canvas, 0, 0, 0, 127);
            imagefilledrectangle($canvas, 0, 0, $targetWidth, $targetHeight, $transparent);
        }

        imagecopyresampled($canvas, $source, 0, 0, $srcX, $srcY, $targetWidth, $targetHeight, $cropWidth, $cropHeight);

        match ($type) {
            IMAGETYPE_JPEG => imagejpeg($canvas, $absolutePath, 88),
            IMAGETYPE_PNG => imagepng($canvas, $absolutePath),
            IMAGETYPE_GIF => imagegif($canvas, $absolutePath),
            IMAGETYPE_WEBP => function_exists('imagewebp') ? imagewebp($canvas, $absolutePath, 88) : null,
            default => null,
        };

        imagedestroy($source);
        imagedestroy($canvas);
    }
}
