<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\Backend\HomeController;

Route::get('/welcome', function () {
    return view('welcome');
});

Route::namespace('Backend')->group(function () {
    Route::prefix('nedmin')->group(function () {

        Route::get('/dashboard', [\App\Http\Controllers\Backend\HomeController::class, 'index'])->name('nedmin.Index');
        Route::get('/login', [\App\Http\Controllers\Backend\HomeController::class, 'giris'])->name('nedmin.giris');
        Route::get('/cikis', [\App\Http\Controllers\Backend\HomeController::class, 'cikis'])->name('nedmin.cikis');
        Route::post('/giris', [\App\Http\Controllers\Backend\HomeController::class, 'authenticate'])->name('nedmin.Authenticate');
    });
});





Route::get('/users/profil/{id}',  [\App\Http\Controllers\Backend\UserController::class,'profil'])->name('users.profil');
Route::get('/users/edit/{id}',  [\App\Http\Controllers\Backend\UserController::class,'edit'])->name('users.edit');
Route::resource('/users', \App\Http\Controllers\Backend\UserController::class);


//Route::resource('/', \App\Http\Controllers\Backend\HomeController::class);
Route::any('/', [\App\Http\Controllers\Backend\HomeController::class, 'index'])->name('home.index');
Route::resource('/news', \App\Http\Controllers\Backend\NewController::class);


/*
Route::get('/news',[\App\Http\Controllers\Backend\NewController::class,'index'])->name('news.index');
Route::get('/news/create',[\App\Http\Controllers\Backend\NewController::class,'create'])->name('news.create');
Route::get('news/edit/{id}',[\App\Http\Controllers\Backend\NewController::class,'edit'])->name('news.edit');
Route::get('news/update/{id}',[\App\Http\Controllers\Backend\NewController::class,'update'])->name('news.update');
Route::get('/news/store',[\App\Http\Controllers\Backend\NewController::class,'store'])->name('news.store');
*/

//Route::delete('edit/{id}', [\App\Http\Controllers\Backend\NewController::class,'delete'])->name('news.delete');
Route::get('news/delete/{id}',  [\App\Http\Controllers\Backend\NewController::class,'delete'])->name('news.delete');
Route::post('news/sortable/{id}', [\App\Http\Controllers\Backend\NewController::class,'sortable'])->name('news.Sortable');

Route::resource('/categories', \App\Http\Controllers\Backend\CategoryController::class);
Route::resource('/enguncelhaber', \App\Http\Controllers\Frontend\HomeController::class);
//Kategoriler
Route::get('/haberler', [\App\Http\Controllers\Frontend\Categories\HaberlerController::class, 'index'])->name('haberler.index');

Route::resource('/sondakika', \App\Http\Controllers\Frontend\Categories\SondakikaController::class);
//Route::get('/sondakika', [\App\Http\Controllers\Frontend\Categories\SondakikaController::class, 'index'])->name('sondakika.index');

Route::resource('/spor', \App\Http\Controllers\Frontend\Categories\SporController::class);
//Route::get('/spor', [\App\Http\Controllers\Frontend\Categories\SporController::class, 'index'])->name('spor.index');

Route::resource('/ekonomi', \App\Http\Controllers\Frontend\Categories\EkonomiController::class);
//Route::get('/ekonomi', [\App\Http\Controllers\Frontend\Categories\EkonomiController::class, 'index'])->name('ekonomi.index');

Route::resource('/teknoloji', \App\Http\Controllers\Frontend\Categories\TeknolojiController::class);
//Route::get('/teknoloji', [\App\Http\Controllers\Frontend\Categories\TeknolojiController::class, 'index'])->name('teknoloji.index');

Route::resource('/otomobil', \App\Http\Controllers\Frontend\Categories\OtomobilController::class);
//Route::get('/otomobil', [\App\Http\Controllers\Frontend\Categories\OtomobilController::class, 'index'])->name('otomobil.index');

Route::resource('/saglik', \App\Http\Controllers\Frontend\Categories\SaglikController::class);
//Route::get('/saglik', [\App\Http\Controllers\Frontend\Categories\SaglikController::class, 'index'])->name('saglik.index');

Route::resource('/egitim', \App\Http\Controllers\Frontend\Categories\EgitimController::class);
//Route::get('/egitim', [\App\Http\Controllers\Frontend\Categories\EgitimController::class, 'index'])->name('egitim.index');

Route::resource('/tarih', \App\Http\Controllers\Frontend\Categories\TarihController::class);
//Route::get('/tarih', [\App\Http\Controllers\Frontend\Categories\TarihController::class, 'index'])->name('tarih.index');

Route::resource('/magazin', \App\Http\Controllers\Frontend\Categories\MagazinController::class);
//Route::get('/magazin', [\App\Http\Controllers\Frontend\Categories\MagazinController::class, 'index'])->name('magazin.index');

Route::resource('/dunya', \App\Http\Controllers\Frontend\Categories\DunyaController::class);
//Route::get('/dunya', [\App\Http\Controllers\Frontend\Categories\DunyaController::class, 'index'])->name('dunya.index');
//Son

Route::get('/haberler/{url}', [\App\Http\Controllers\Frontend\Categories\HaberlerController::class, 'detail'])->name('haberler.detail');





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
