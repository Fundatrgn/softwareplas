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
}
