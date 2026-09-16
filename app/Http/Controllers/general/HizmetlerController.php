<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use App\Models\Services;
use App\Models\ServicesCategory;
use App\Models\ServicesDetail;

class HizmetlerController extends Controller
{
    //

    public function index()
    {
        // $Services = Services::orderBy('title','ASC')->get();
        $servicesCategory = ServicesCategory::orderBy('title','ASC')->get();

        $data = [
            "title" =>  "Hizmetlerimiz",
            "services" => $servicesCategory,
            "servicesCategory" => $servicesCategory,
            "alt" => 0,
        ];
        return view('general.services', ['data' => $data]);
    }
    public function category($category_id)
    {
        $Services = Services::where('category_id',$category_id)->get();
        $servicesCategory = ServicesCategory::orderBy('title','ASC')->get();

        $data = [
            "title" =>  ServicesCategory::find($category_id)->title ?? '',
            "services" => $Services,
            "servicesCategory" => $servicesCategory,
            "alt" => 1,
        ];
        return view('general.services', ['data' => $data]);
    }
    public function detay($id,$slug)
    {
        $hizmetler =[];
        $hizmet = Services::find($id) ;
        $genelHizmetler = Services::where('category_id',$hizmet->category_id)->get();
        if ($hizmet) {
            $hizmetler = ServicesDetail::where('service_id',$hizmet->id)->orderBy('position','ASC')->get();
        }
        $data = [
            "hizmet" => $hizmet,
            "hizmetler" => $hizmetler,
            "genelHizmetler" => $genelHizmetler,
        ];
        return view('general.service-detail', ['data' => $data]);
    }
}
