<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "blog_categories";

    public function posts()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
