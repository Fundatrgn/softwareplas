<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referans extends Model
{
    use HasFactory;
    protected $table = "referanslar";
    public function category(){
        return $this->belongsTo(ReferansCategory::class,'kategori');
    }
}
