<?php

namespace App\Http\Controllers\Frontend\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HaberlerController extends Controller
{
    public function index()
    {
        $data1 = DB::table('news')
            ->where('durum', '=', '1')
            ->where('categori_id', '=', '9')
            ->take(5)->orderBy('id', 'desc')->get();

        $datacount = DB::table('news')
            ->where('durum','=','1')
            ->where('categori_id','=','9')
            ->get()->count();

        if($datacount>5){
            $adet = $datacount;
            $data2 = DB::table('news')
                ->where('durum', '=', '1')
                ->where('categori_id', '=', '9')
                ->take($adet-5)
                ->orderBy('id', 'asc')->get();
        }
        else{
            $adet = 0;
            $data2 = DB::table('news')
                ->where('durum', '=', '1')
                ->where('categori_id', '=', '9')
                ->take(0)
                ->orderBy('id', 'asc')->get();
        }
        return view('frontend.categories.haberler.index')->with([
            "data1" => $data1,
            "data2" => $data2
        ]);
    }
    public function detail($url){
        //url e göre bak listele
        //$news=News::all()->where('url',$url)->get();
        $news = DB::table('news')->where('url','=',$url)->get();
        return view('frontend.categories.haberler.detail')->with('news',$news);
    }
}
