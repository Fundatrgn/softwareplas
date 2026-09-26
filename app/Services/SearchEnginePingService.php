<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * Yeni/güncellenen bir sayfa (ör. blog yazısı) yayınlandığında arama
 * motorlarına haber verir:
 *  - IndexNow protokolü (Bing ve Yandex tarafından ortaklaşa
 *    desteklenir) — anında, gerçek bir bildirim.
 *  - Google için ise artık (Haziran 2023'ten beri) basit bir "ping"
 *    uç noktası desteklenmiyor; Google Search Console API + OAuth
 *    gerektiriyor. Burada yalnızca site haritasını yeniden tarasın diye
 *    en iyi çaba (best-effort) ile eski sitemap ping uç noktasına da
 *    istek atılır, ama bunun Google'da garanti bir etkisi yoktur.
 */
class SearchEnginePingService
{
    public static function urlYayinlandi(string $url): void
    {
        $settings = Setting::first();
        if (! $settings || ! ($settings->search_ping_enabled ?? true)) {
            return;
        }

        $key = $settings->indexnow_key;
        if (empty($key)) {
            return;
        }

        $host = parse_url($url, PHP_URL_HOST);
        if (empty($host)) {
            return;
        }

        try {
            Http::timeout(4)->get('https://api.indexnow.org/indexnow', [
                'url' => $url,
                'key' => $key,
                'keyLocation' => "https://{$host}/{$key}.txt",
            ]);
        } catch (Throwable $e) {
            Log::info('IndexNow bildirimi gönderilemedi: ' . $e->getMessage());
        }

        try {
            $sitemapUrl = "https://{$host}/sitemap.xml";
            Http::timeout(4)->get('https://www.google.com/ping', ['sitemap' => $sitemapUrl]);
        } catch (Throwable $e) {
            Log::info('Google sitemap ping gönderilemedi: ' . $e->getMessage());
        }
    }
}
