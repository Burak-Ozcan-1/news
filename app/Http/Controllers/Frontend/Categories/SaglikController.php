<?php

namespace App\Http\Controllers\Frontend\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaglikController extends Controller
{
    public function index()
    {
        $data1 = DB::table('news')
            ->where('durum', '=', '1')
            ->where('categori_id', '=', '6')
            ->take(5)->orderBy('id', 'desc')->get();

        $datacount = DB::table('news')
            ->where('durum','=','1')
            ->where('categori_id','=','6')
            ->get()->count();

        if($datacount>5){
            $adet = $datacount;
            $data2 = DB::table('news')
                ->where('durum', '=', '1')
                ->where('categori_id', '=', '6')
                ->take($adet-5)
                ->orderBy('id', 'asc')->get();
        }
        else{
            $adet = 0;
            $data2 = DB::table('news')
                ->where('durum', '=', '1')
                ->where('categori_id', '=', '6')
                ->take(0)
                ->orderBy('id', 'asc')->get();
        }
        return view('frontend.categories.saglik.index')->with([
            "data1" => $data1,
            "data2" => $data2
        ]);
    }
}
