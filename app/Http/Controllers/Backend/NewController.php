<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\News;
use App\Models\Images;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class NewController extends Controller
{
    public function index()
    {
        $data = News::orderBy('id','desc')->get();
        $categori = Categories::all();
        $images = Images::all();
        return view('backend.news.index')->with([
            "data" => $data,
            "categories" => $categori,
            "images" => $images
        ]);
    }

    public function store(Request $request)
    {
        $imageId = 0;
        $name = "";
        if ($request->has('images')) {
            $size = count(collect($request)->get('images'));
            if ($size > 4) {
                echo 'En Fazla 4 Adet Fotoğraf Seçebilirsiniz!';
            } else {
                //$data = Images::all();
                $image1 = null;
                $image2 = null;
                $image3 = null;
                $image4 = null;
                for ($i = 0; $i <= $size - 1; $i++) {
                    $name = Uniqid() . '.' . $request->images[$i]->getClientOriginalExtension();

                    if ($i == 0) {
                        $image1 = $name;
                        $request->images[$i]->move(public_path('images/news'), $name);
                    } elseif ($i == 1) {
                        $image2 = $name;
                        $request->images[$i]->move(public_path('images/news'), $name);
                    } elseif ($i == 2) {
                        $image3 = $name;
                        $request->images[$i]->move(public_path('images/news'), $name);
                    } elseif ($i == 3) {
                        $image4 = $name;
                        $request->images[$i]->move(public_path('images/news'), $name);
                    }
                }
                $insert = Images::insert([
                    "image1" => $image1,
                    "image2" => $image2,
                    "image3" => $image3,
                    "image4" => $image4
                ]);
                $I_Id = Images::where([
                    "image1" => $image1,
                    "image2" => $image2,
                    "image3" => $image3,
                    "image4" => $image4
                ])->first();
                $imageId = $I_Id->id;
            }
        }

        if ($request->hasFile('video')) {
            $file_name_vid = Uniqid() . '.' . $request->video->getClientOriginalExtension();
            $request->video->move(public_path('videos/news'), $file_name_vid);
        } else {
            $file_name_vid = null;
        }

        $d_url = str_replace(",", "", $request->title);
        $d_url = str_replace(" ", "-", $d_url);
        $d_url = mb_strtolower($d_url, 'UTF-8');

        /*
        $mytime = Carbon::now()->format('d-m-Y');
        echo $mytime->toDateTimeString();
        */
        $tarih = Carbon::now();

        $news = News::insert([
            "title" => $request->title,
            "content" => $request->content,
            "categori_id" => $request->categori,
            "image_id" => $imageId,
            "video" => $request->$file_name_vid,
            "durum" => $request->status,
            "url" => $d_url,
            "created_at" => $tarih,
            "konum" => $request->konum
        ]);
        if ($news) {
            return redirect(route('news.index'))->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }


    public function create()
    {
        $data = Categories::all();//News::all();
        return view('backend.news.create', compact('data'));
    }

    public function edit(Request $request, $id)
    {
        $news = News::where('id', $id)->first();
        $categori = Categories::where('id',$news->categori_id)->first();
            //Categories::all();//where('id',$news->categori_id)->first();
        $images = Images::where('id', $news->image_id)->first();
        //return view('backend.news.edit')->with('news',$news)->with('categories',$categori);
        return view('backend.news.edit')->with([
            "news" => $news,
            "categories" => $categori,
            "images" => $images
        ]);
    }

    public function update(Request $request, $id)
    {
        $tarih = Carbon::now();//->format('d-m-Y');

        $request->validate([
            // required // zorunlu olduğunu belirtiyoruz.
            'title' => 'required',
            'content' => 'required',
            'categori' => 'required'
        ]);

        if ($request->hasFile('images')) {
            $v1 = null;
            $v2 = null;
            $v3 = null;
            $v4 = null;
            $size = count(collect($request)->get('images'));
            //dd($size);
            if ($size > 4) {
                return back()->with('error','En Fazla 4 Adet Fotoğraf Seçebilirsiniz!');
            }else{
                $news = News::where('id', $id)->first();
                $images = Images::where('id', $news->image_id)->first();
                //image1 , 2 , 3 , 4
                for ($i = 1; $i <= 4; $i++) {
                    if ($i == 1) {
                        if (!empty($images->image1)) {
                            $v1 = $images->image1;
                        }
                    }
                    if ($i == 2) {
                        if (!empty($images->image2)) {
                            $v2 = $images->image2;
                        }
                    }
                    if ($i == 3) {
                        if (!empty($images->image3)) {
                            $v3 = $images->image3;
                        }
                    }
                    if ($i == 4) {
                        if (!empty($images->image4)) {
                            $v4 = $images->image4;
                        }
                    }
                }
                for ($i = 0; $i <= $size-1; $i++){
                    $name = Uniqid() . '.' . $request->images[$i]->getClientOriginalExtension();
                    if (empty($v1)){
                        $image1 = $name;
                        $request->images[$i]->move(public_path('images/news'), $name);
                        $v1 = $name;
                    }
                    else{
                        if (!empty($image1) or empty($v2) or !empty($v2)){
                            if (empty($v2)){
                                $image2 = $name;
                                $request->images[$i]->move(public_path('images/news'), $name);
                                $v2 = $name;
                            }
                            else{
                                if (!empty($image2) or empty($v3) or !empty($v3)){
                                    if (empty($v3)){
                                        $image3 = $name;
                                        $request->images[$i]->move(public_path('images/news'), $name);
                                        $v3 = $name;
                                    }
                                    else{
                                        if (!empty($image3) or empty($v4)){
                                            if (empty($v4)){
                                                $image4 = $name;
                                                $request->images[$i]->move(public_path('images/news'), $name);
                                                $v4 = $name;
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                    if (empty($images->id)){
                        $insert = Images::Insert([
                            "image1" =>
                                empty($image1) ? $v1 : $image1,
                            "image2" =>
                                empty($image2) ? $v2 : $image2,
                            "image3" =>
                                empty($image3) ? $v3 : $image3,
                            "image4" =>
                                empty($image4) ? $v4 : $image4,
                        ]);
                        $bul_id = DB::table('images')->orderBy('id', 'desc')->first();
                        $kaydet = News::Where('id', $id)->update([
                            "image_id" => $bul_id->id,
                            "updated_at" => $tarih
                        ]);
                    }
                    else{
                        $insert2 = Images::Where('id', $images->id)->update([
                            "image1" =>
                                empty($image1) ? $v1 : $image1,
                            "image2" =>
                                empty($image2) ? $v2 : $image2,
                            "image3" =>
                                empty($image3) ? $v3 : $image3,
                            "image4" =>
                                empty($image4) ? $v4 : $image4,
                        ]);
                    }
                }

            $d_url = str_replace(",", "", $request->title);
            $d_url = str_replace(" ", "-", $d_url);
            $d_url = mb_strtolower($d_url, 'UTF-8');

            $news = News::Where('id', $id)->update([
                "title" => $request->title,
                "content" => $request->content,
                "categori_id" => $request->categori,
                "durum" => $request->durum,
                "url" => $d_url,
                "updated_at" => $tarih,
                "konum" => $request->konum
            ]);

            $path = 'images/news/' . $request->old_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
        }
        if ($request->hasFile('video')) {

            $file_name_vid = Uniqid() . '.' . $request->video->getClientOriginalExtension();
            $request->video->move(public_path('videos/news'), $file_name_vid);

            $news = News::Where('id', $id)->update([
                "title" => $request->title,
                "content" => $request->content,
                "categori_id" => $request->categori,
                "durum" => $request->durum,
                "url" => $d_url,
                "video" => $file_name_vid,
                "updated_at" => $tarih,
                "konum" => $request->konum
            ]);

            $path = 'videos/news/' . $request->old_file;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
        }

        $news = News::Where('id', $id)->update([
            "title" => $request->title,
            "content" => $request->content,
            "categori_id" => $request->categori,
            "durum" => $request->durum,
            "updated_at" => $tarih,
            "konum" => $request->konum
        ]);
        return redirect(route('news.index'))->with('success', 'İşlem Başarılı');
    }

    public function destroy($id)
    {
        $news = News::find(intval($id));
        if ($news->delete()){
            echo 1;
        }
        echo 0;
    }
    public function sortable($pid)
    {
        //print_r($_POST['item']);
        foreach ($_POST['item'] as $key => $value)
        {
            $images=Images::Where('id', $pid);

            if ($key==0){
                $image1 = $value;
            }
            if ($key==1){
                $image2 = $value;
            }
            if ($key==2){
                $image3 = $value;
            }
            if ($key==3){
                $image4 = $value;
            }
        }
        $news = Images::Where('id', $pid)->update([
            "image1" => empty($image1) ? null : $image1,
            "image2" => empty($image2) ? null : $image2,
            "image3" => empty($image3) ? null : $image3,
            "image4" => empty($image4) ? null : $image4
        ]);

        echo true;
    }
    public function delete($id)
    {
        $path = 'images/news/';
        $img1 = Images::Where('image1',$id)->first();
        if(!empty($img1)){
            $images1 = Images::Where('image1', $img1->image1)->update([
                'image1' => null
            ]);
            $path = $path.$img1->image1;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
        }
        $img2 = Images::Where('image2',$id)->first();
        if(!empty($img2)) {
            $images2 = Images::Where('image2', $img2->image2)->update([
                'image2' => null
            ]);
            $path = $path.$img2->image2;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
        }
        $img3 = Images::Where('image3',$id)->first();
        if(!empty($img3)){
            $images3 = Images::Where('image3',$img3->image3)->update([
                'image3' => null
            ]);
            $path = $path.$img3->image3;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
        }
        $img4 = Images::Where('image4',$id)->first();
        if(!empty($img4)){
            $images4 = Images::Where('image4',$img4->image4)->update([
                'image4' => null
            ]);
            $path = $path.$img4->image4;
            if (file_exists($path)) {
                @unlink(public_path($path));
            }
        }
        return redirect(route('news.index'))->with('success', 'İşlem Başarılı');
    }
}
