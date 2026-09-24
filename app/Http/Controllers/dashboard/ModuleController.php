<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Support\AdminModules;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * AdminModules'ta tanımlanan içerik bölümleri için ortak listele /
 * ekle / düzenle / sil kontrolcüsü. Görünüm olarak panelin diğer
 * sayfalarıyla aynı tasarımı kullanan dashboard/module/*.blade.php
 * dosyaları kullanılır.
 */
class ModuleController extends Controller
{
    public function index(string $module)
    {
        $config = $this->config($module);
        [$column, $direction] = $config['order_by'] ?? ['id', 'desc'];
        $data = $config['model']::orderBy($column, $direction)->orderBy('id', 'desc')->get();

        return view('dashboard.module.index', compact('module', 'config', 'data'));
    }

    public function add(string $module)
    {
        $config = $this->config($module);

        return view('dashboard.module.form', ['module' => $module, 'config' => $config, 'data' => null]);
    }

    public function edit(string $module, int $id)
    {
        $config = $this->config($module);
        $data = $config['model']::findOrFail($id);

        return view('dashboard.module.form', compact('module', 'config', 'data'));
    }

    public function store(Request $request, string $module)
    {
        $config = $this->config($module);
        $model = $config['model'];

        $rules = [];
        foreach ($config['fields'] as $field) {
            if (! empty($field['required']) && $field['type'] !== 'image') {
                $rules[$field['name']] = 'required';
            }
        }
        $request->validate($rules, ['required' => '":attribute" alanı zorunludur.']);

        $item = $request->id ? $model::findOrFail($request->id) : new $model();

        try {
            foreach ($config['fields'] as $field) {
                $name = $field['name'];
                switch ($field['type']) {
                    case 'image':
                        if ($request->boolean($name . '_remove')) {
                            $item->{$name} = null;
                        }
                        $imageName = $this->uploadImage($request, $name);
                        if ($imageName) {
                            $item->{$name} = $imageName;
                            if (! empty($field['crop'])) {
                                $this->resizeAndCropImage(public_path('images/' . $imageName), ...$field['crop']);
                            }
                        }
                        break;
                    case 'checkbox':
                        $item->{$name} = $request->boolean($name);
                        break;
                    case 'number':
                        $item->{$name} = (int) $request->input($name, 0);
                        break;
                    default:
                        $item->{$name} = $request->input($name);
                }
            }
        } catch (\RuntimeException $e) {
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }

        if (! empty($config['slug_from'])) {
            $item->slug = $this->uniqueSlug($model, $item->{$config['slug_from']}, $item->id);
        }

        $item->save();

        return redirect('/admin/' . $module)->with('success', 'Kayıt başarıyla kaydedildi.');
    }

    public function del(string $module, int $id)
    {
        $config = $this->config($module);
        $config['model']::destroy($id);

        return redirect('/admin/' . $module)->with('success', 'Kayıt başarıyla silindi.');
    }

    private function config(string $module): array
    {
        $config = AdminModules::get($module);
        abort_if(! $config, 404);

        return $config;
    }

    private function uniqueSlug(string $model, ?string $title, ?int $ignoreId): string
    {
        $base = Str::slug((string) $title) ?: 'kayit';
        $slug = $base;
        $i = 2;
        while ($model::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }
}
