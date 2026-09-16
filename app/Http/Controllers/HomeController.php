<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Services;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Not: Bu kontrolcu daha once bir "dijital ajans" temasina ait
    // referans/portfoy, tarihce ve ekip sorgularini da calistiriyordu.
    // Bu tablolarin bir kismi migration'larda hic tanimli degildi (canli
    // sitede migration disi olusturulmus olmali) ve psikolog sitesinde
    // bu bolumler (portfoy/referans gostermek gizlilik ilkesine aykiri
    // oldugu icin) kullanilmadigindan tamamen kaldirildi.
    public function index()
    {
        $hizmetler = Services::orderBy('order', 'ASC')->limit(3)->get();
        $blog = Blog::orderBy('created_at', 'DESC')->limit(10)->get();
        $slider = Slider::orderBy('sira', 'ASC')->get();

        $data = [
            "services" => $hizmetler,
            "blog" => $blog,
            "slider" => $slider,
        ];
        return view('general.home', ['data' => $data]);
    }
}
