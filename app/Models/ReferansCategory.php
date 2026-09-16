<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferansCategory extends Model
{
    use HasFactory;

    public function referanslar()  {
        return $this->hasMany(Referans::class,'kategori','id');
    }
    
}
