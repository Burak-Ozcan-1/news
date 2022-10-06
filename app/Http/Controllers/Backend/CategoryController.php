<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Categories::all();
        return view('backend.categories.index',compact('data'));
    }
    public function store(Request $request)
    {
        $d_url = str_replace(",","",$request->categori);
        $d_url = str_replace(" ","-",$d_url);
        $d_url = mb_strtolower($d_url,'UTF-8');

        $categori = Categories::insert([
            "description"=>$request->categori,
            "url"=>$d_url
        ]);
        if($categori){
            return redirect(route('categories.index'))->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız');
    }
}
