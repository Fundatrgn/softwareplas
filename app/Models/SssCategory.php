<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SssCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "sss_categories";
}
