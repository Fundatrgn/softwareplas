<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * CKEditor içindeki "Görsel yükle" düğmesinin hedefi. Sadece oturum açmış
 * panel kullanıcıları erişebilir (rota auth grubunda) ve ortak
 * uploadImage() yardımcısı sayesinde sadece görsel uzantıları kabul edilir;
 * dosyalar diğer panel görselleri gibi public/images klasörüne kaydedilir
 * (paylaşımlı hostinglerde "storage:link" gerekmez).
 */
class CkeditorController extends Controller
{
    public function upload(Request $request)
    {
        $funcNum = (int) $request->input('CKEditorFuncNum');

        try {
            $imageName = $this->uploadImage($request, 'upload');
            $url = $imageName ? asset('images/' . $imageName) : '';
            $message = $imageName ? '' : 'Dosya seçilmedi.';
        } catch (\RuntimeException $e) {
            $url = '';
            $message = $e->getMessage();
        }

        $script = sprintf(
            '<script>window.parent.CKEDITOR.tools.callFunction(%d, %s, %s)</script>',
            $funcNum,
            json_encode($url),
            json_encode($message)
        );

        return response($script)->header('Content-Type', 'text/html; charset=utf-8');
    }
}
