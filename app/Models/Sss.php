<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sss extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = "sss";
    public function category(){
        return $this->belongsTo(SssCategory::class,'category_id');
    }
}
