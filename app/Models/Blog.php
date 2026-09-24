<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "blog_posts";

    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }

    public function url(): string
    {
        return url('/blog/' . $this->slug);
    }

    public function tagList(): array
    {
        return array_values(array_filter(array_map('trim', explode(',', (string) $this->tags))));
    }
}
