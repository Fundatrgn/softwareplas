<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\PostTooLargeException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * The register method aracılığıyla eklenen bu render kuralı,
     * "PostTooLargeException" (yüklenen dosya/form sunucunun
     * post_max_size ayarından büyükse) hatasını yakalayıp, ham bir 500
     * sayfası yerine kullanıcının anlayabileceği bir mesajla önceki
     * sayfaya geri döner. Bu hata, isteğin kontrolcülere ulaşmasından
     * ÖNCE oluştuğu için tek tek kontrolcülerdeki try/catch bloklarıyla
     * yakalanamaz; bu yüzden burada, genel seviyede ele alınıyor.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });

        $this->renderable(function (PostTooLargeException $e, $request) {
            return redirect()->back()->withInput($request->except(['image', 'password']))
                ->with('error', 'Yüklemeye çalıştığınız dosya çok büyük. Lütfen daha küçük boyutlu bir görsel seçin (tercihen 5MB\'ın altında).');
        });
    }
}
