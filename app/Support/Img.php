<?php

namespace App\Support;

/**
 * Panelden görsel yüklenmemiş içerikler için markaya uygun yedek kapak
 * görseli (public/site/images/yz/cover-1..6.svg). Aynı kayıt her zaman
 * aynı kapağı alır.
 */
class Img
{
    public static function cover(?string $image, int $seed = 0): string
    {
        if ($image) {
            return asset('images/' . $image);
        }

        return asset('site/images/yz/cover-' . ((abs($seed) % 6) + 1) . '.svg');
    }
}
