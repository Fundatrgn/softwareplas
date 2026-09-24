<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'stats' => 'array',
    ];

    /** Doldurulmuş sosyal medya hesapları: [anahtar => [etiket, ikon, url]] */
    public function socials(): array
    {
        $map = [
            'instagram' => ['Instagram', 'icon-instagram'],
            'facebook' => ['Facebook', 'icon-facebook-f'],
            'linkedin' => ['LinkedIn', 'icon-linkedin-in'],
            'twitter' => ['X / Twitter', 'icon-twitter-x'],
            'youtube' => ['YouTube', 'icon-youtube'],
            'github' => ['GitHub', 'icon-github'],
        ];

        $out = [];
        foreach ($map as $key => [$label, $icon]) {
            if (! empty($this->{$key})) {
                $out[$key] = ['label' => $label, 'icon' => $icon, 'url' => $this->{$key}];
            }
        }

        return $out;
    }

    /** schema.org "sameAs" listesi: sosyal hesaplar + panelden eklenen ek bağlantılar. */
    public function sameAsList(): array
    {
        $extra = preg_split('/[\r\n,]+/', (string) $this->same_as) ?: [];
        $urls = array_merge(array_column($this->socials(), 'url'), $extra);

        return array_values(array_unique(array_filter(array_map('trim', $urls))));
    }

    /** WhatsApp numarasını wa.me bağlantısında kullanılacak rakamlara indirger. */
    public function whatsappDigits(): ?string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->whatsapp_number);
        if (! $digits) {
            return null;
        }
        if (str_starts_with($digits, '0')) {
            $digits = '90' . substr($digits, 1);
        }

        return $digits;
    }
}
