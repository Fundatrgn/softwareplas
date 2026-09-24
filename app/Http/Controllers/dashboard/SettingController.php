<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

/**
 * Sitede tek bir ayar kaydı bulunur; "Site Ayarları" menüsü doğrudan bu
 * kaydın düzenleme formunu açar (liste sayfası yoktur).
 */
class SettingController extends Controller
{
    private const TEXT_FIELDS = [
        'site_title', 'description', 'keywords', 'author', 'job_title', 'same_as',
        'google_verification', 'analytics_id',
        'phone', 'email', 'address', 'location_text', 'availability_text', 'map_embed', 'whatsapp_number',
        'instagram', 'facebook', 'linkedin', 'twitter', 'youtube', 'github',
        'quote_text', 'quote_author', 'quote_role',
        'footer_title', 'footer_copyright_text', 'footer_menu_title', 'kvkk_text',
    ];

    private const IMAGE_FIELDS = ['image', 'logo_footer', 'favicon', 'profile_image', 'og_image'];

    public function index()
    {
        $data = Setting::first() ?? Setting::create(['site_title' => 'Yunuscan ZEYBEK']);

        return view('dashboard.ayarlar.add', ['data' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate(['site_title' => 'required'], ['site_title.required' => 'Site başlığı zorunludur.']);

        $item = Setting::first() ?? new Setting();

        foreach (self::TEXT_FIELDS as $field) {
            $item->{$field} = $request->input($field);
        }

        $color = (string) $request->input('accent_color');
        $item->accent_color = preg_match('/^#[0-9a-fA-F]{6}$/', $color) ? $color : '#FD3A25';

        $stats = [];
        foreach ((array) $request->input('stats', []) as $row) {
            if (! empty($row['label']) && isset($row['value']) && $row['value'] !== '') {
                $stats[] = [
                    'label' => $row['label'],
                    'value' => (string) $row['value'],
                    'suffix' => $row['suffix'] ?? '',
                ];
            }
        }
        $item->stats = $stats;

        try {
            foreach (self::IMAGE_FIELDS as $field) {
                if ($request->boolean($field . '_remove')) {
                    $item->{$field} = null;
                }
                $imageName = $this->uploadImage($request, $field);
                if ($imageName) {
                    $item->{$field} = $imageName;
                    if ($field === 'profile_image') {
                        $this->resizeAndCropImage(public_path('images/' . $imageName), 800, 960);
                    }
                    if ($field === 'og_image') {
                        $this->resizeAndCropImage(public_path('images/' . $imageName), 1200, 630);
                    }
                }
            }
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        $item->save();

        return redirect('/admin/ayarlar')->with('success', 'Ayarlar başarıyla güncellendi.');
    }
}
