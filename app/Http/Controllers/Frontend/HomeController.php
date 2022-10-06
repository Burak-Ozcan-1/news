<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        //$data = News::all()->sortby('id');//where('durum','1')->first();
        $data1 = DB::table('news')
            ->where('durum','=','1')
            ->where('konum','=','1')
            ->take(10)->orderBy('id','desc')->get();

        $data2 = DB::table('news')
            ->where('durum','=','1')
            ->where('konum','=','2')
            ->take(10)->orderBy('id','desc')->get();

        $data3 = DB::table('news')
            ->where('durum','=','1')
            ->where('konum','=','3')
            ->take(5)->orderBy('id','desc')->get();

        $datacount = DB::table('news')
            ->where('durum','=','1')
            ->where('konum','=','3')
            ->get()->count();

        if($datacount>5){
           $adet = $datacount;
        }
        else{
           $adet = 0;
        }
        $data4 = DB::table('news')
            ->where('durum','=','1')
            ->where('konum','=','3')
            ->take($adet) //11-5 = 6
            ->orderBy('id','desc')->get();

        $sayi = $data4->count();

        $data5 = DB::table('news')
            ->where('durum','=','1')
            ->where('konum','=','4')
            ->orderBy('id','desc')->get();

        return view('frontend.home.index')->with([
            "data1" => $data1,
            "data2" => $data2,
            "data3" => $data3,
            "data4" => $data4,
            "data5" => $data5,
            "sayi"  => $sayi
        ]);

        //return view('frontend.home.index')->with('data',$data1);
    }

    public function show($id)
    {
        //return "test";
        $sayfa = Categories::where('description',$id)->first();
        if($sayfa){
            return redirect('/haberler');
        }
        //dd($sayfa);
        //return "TEST";
    }
}
