<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Project;
use App\Models\Services;

/**
 * Arama motorları için otomatik güncellenen site haritası ve robots.txt.
 * Panelden eklenen her yeni proje / hizmet / blog yazısı site haritasına
 * kendiliğinden eklenir.
 */
class SeoController extends Controller
{
    public function sitemap()
    {
        $urls = [
            ['loc' => url('/'), 'priority' => '1.0', 'lastmod' => null],
            ['loc' => url('/yunuscan-zeybek-kimdir'), 'priority' => '0.9', 'lastmod' => null],
            ['loc' => url('/projeler'), 'priority' => '0.8', 'lastmod' => null],
            ['loc' => url('/hizmetler'), 'priority' => '0.8', 'lastmod' => null],
            ['loc' => url('/blog'), 'priority' => '0.7', 'lastmod' => null],
            ['loc' => url('/sss'), 'priority' => '0.5', 'lastmod' => null],
            ['loc' => url('/iletisim'), 'priority' => '0.6', 'lastmod' => null],
        ];

        foreach (Project::orderBy('order')->get() as $p) {
            $urls[] = ['loc' => $p->url(), 'priority' => '0.7', 'lastmod' => $p->updated_at];
        }
        foreach (Services::orderBy('order')->get() as $s) {
            $urls[] = ['loc' => $s->url(), 'priority' => '0.7', 'lastmod' => $s->updated_at];
        }
        foreach (Blog::latest()->get() as $b) {
            $urls[] = ['loc' => $b->url(), 'priority' => '0.6', 'lastmod' => $b->updated_at];
        }

        return response()
            ->view('site.sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function robots()
    {
        $lines = [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /login',
            '',
            'Sitemap: ' . url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines) . "\n")->header('Content-Type', 'text/plain; charset=UTF-8');
    }
}
