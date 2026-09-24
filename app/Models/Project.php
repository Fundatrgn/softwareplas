<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = ['id'];

    protected $casts = ['is_featured' => 'boolean'];

    public function url(): string
    {
        return url('/projeler/' . $this->slug);
    }

    /** Teslim edilenler alanını virgülle ayrılmış etiket listesine çevirir. */
    public function deliverableList(): array
    {
        return array_values(array_filter(array_map('trim', explode(',', (string) $this->deliverables))));
    }
}
