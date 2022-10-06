<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        //return "Test";
        //$data = User::where('email',$request->email)->first();
        //dd($data);
        //if($data){
            return view('backend.home.index');
        /*
        }
        else{
            return back();
        }
        */
    }
    public function giris(Request $request){

        return view('backend.home.login');
    }

    public function authenticate(Request $request)
    {
        //return "TEst";
        //$request->flash() geri dönersek dolu olur.
        $request->flash();
        //$request->only() sadece seçtiğimiz değerleri dahil et diyoruz.
        // Veritabanından email ve password kontrolü

        $credentials = $request->only('email', 'password', 'name');
        $remember_me = $request->has('remember_me') ? 'true' : 'false';


        if(Auth::attempt($credentials,$remember_me)){
            //return "Tets";
            return redirect()->intended(route('nedmin.Index'));
        }else{
            return back()->with('error','Hatalı Kullanıcı');
        }
    }
    public function cikis(){
        Auth::logout();
        return redirect(route('nedmin.giris'))->with('success','Güvenli Çıkış Yapıldı');
    }
}
