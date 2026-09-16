<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statics extends Model
{
    use HasFactory;
    protected $table ="statics";

    protected function shareStaticData()
    {
        view()->share('statics', Statics::get());
        view()->share('statics_header', Statics::find(1));
        view()->share('statics_contact', Statics::find(2));
        view()->share('statics_hizmet', Statics::find(3));
        view()->share('statics_referans', Statics::find(4));
        view()->share('statics_tarihce', Statics::find(5));
        view()->share('statics_video', Statics::find(6));
        view()->share('statics_takim', Statics::find(7));
        view()->share('statics_blog', Statics::find(8));
        view()->share('statics_slogan', Statics::find(9));
        view()->share('statics_ozelTeklif', Statics::find(10));
    }
}
