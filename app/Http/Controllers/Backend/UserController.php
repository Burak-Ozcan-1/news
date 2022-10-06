<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //return "Test";
        $data['user'] = User::all();//->sortBy('user_must');
        //$news = News::where('id', $id)->first();
        return view('backend.users.index',compact('data'));
        /*
        return view('backend.news.edit')->with([
            "news" => $news,
            "categories" => $categori,
            "images" => $images
        ]);*/
    }
    public function edit(Request $request, $id)
    {
        $user=User::where('id',$id)->first();
        return view('backend.users.edit')->with('user',$user);
    }
    public function create(Request $request)
    {
        return view('backend.users.create');
    }
    public function profil(Request $request, $id)
    {
        //return "TEST";
        $data['data']=User::where('id',$id)->first();
        return view('backend.users.profil',compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_name'=>'required',
            'password'=>'required|Min:6',
            'email'=> 'required|email'
        ]);

        if($request->hasFile('user_file')){
            $request->validate([
                'user_file'=>'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name=Uniqid().'.'.$request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'),$file_name);
        }
        else{
            $file_name=null;
        }

        $user = user::insert([
            "user_file"=>$file_name,
            "name"=>$request->user_name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
            "status"=>$request->status,
            "role"=>$request->role
        ]);
        //return "Mesaj";

        if($user){
            return redirect(route('users.index'))->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            // required // zorunlu olduğunu belirtiyoruz.
            'name'=>'required',
            'email'=> 'required|email'

        ]);
        //Dosya Gönderiyor İsek veya Göndermiyorsak
        if($request->hasFile('user_file')){

            $request->validate([
                'user_file'=>'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $file_name=Uniqid().'.'.$request->user_file->getClientOriginalExtension();
            $request->user_file->move(public_path('images/users'),$file_name);

            if(strlen($request->password)>0){
                $request->validate([
                    'password'=>'required|Min:6'
                ]);

                $user = user::Where('id',$id) ->update([
                    "user_file"=>$file_name,
                    "name"=>$request->name,
                    "email"=>$request->email,
                    "password"=>Hash::make($request->password),
                    "status"=>$request->status,
                    "role"=>$request->role
                ]);
            }
            else{
                $user = user::Where('id',$id) ->update([
                    "user_file"=>$file_name,
                    "name"=>$request->name,
                    "email"=>$request->email,
                    "status"=>$request->status,
                    "role"=>$request->role
                ]);
            }

            $path='images/users/'.$request->old_file;
            if(file_exists($path)){
                @unlink(public_path($path));
            }
        }
        else {
            if (strlen($request->password) > 0) {
                $request->validate([
                    'password' => 'required|Min:6'
                ]);

                $user = user::Where('id', $id)->update([
                    "name" => $request->name,
                    "email" => $request->email,
                    "password" => Hash::make($request->password),
                    "status" => $request->status,
                    "role"=>$request->role
                ]);
            }
            else{
                $user = user::Where('id', $id)->update([
                    "name" => $request->name,
                    "email" => $request->email,
                    "status" => $request->status,
                    "role"=>$request->role
                ]);
            }
        }

        if($user){
            return redirect(route('users.index'))->with('success','İşlem Başarılı');
        }
        return back()->with('error','İşlem Başarısız');
    }
}
