<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
///DEMO::START
Route::post('/demo-daj-korisnika',function(){
    return json_encode(\App\User::where('prava_pristupa_id',\Illuminate\Support\Facades\Input::get('vrsta_korisnika')==3?3:2)->orderByRaw("RAND()")->take(1)->get(['email','confirmation_code as pass'])->first()->toArray());
});
///demo::end


Route::auth();
Route::get('/after-login',function(){
    return redirect(\App\Funkcije::prosiriLogin());
});
Route::get('/after-logout',function(){
    Session::forget('ordinacija');
    return redirect('/');
});
Route::get('/registracija',function(){
    return redirect('/register');
});
Route::get('/nepotvrdjen',function(){
    return view('errors.nepotvrdjen');
});
Route::get('/prijava',function(){
    return redirect('/login');
});
Route::get('register/verify/{confirmationCode}', function($code){
    if(!$code) return view('errors.503');
    $korisnik=\App\User::whereConfirmationCode($code)->first();
    if(!$korisnik) return view('errors.nepotvrdjen');
    $korisnik->confirmed = 1;
    $korisnik->confirmation_code = null;
    $korisnik->save();
    return Redirect::to('/login')->withErrors('Uspešno ste potvrdili svoj email! Možete nastaviti sa upotrebom platforme.');
});

Route::controller('/administracija','AdministracijaSajtaC');
Route::controller('/template','TemplateEditC');
//Route::controller('/super-administracija','SuperAdministracijaC');
Route::controller('/karton/{slug?}','KartonPrezenterC');
Route::controller('/kontakt','OsnovniPrezenterC');
Route::any('/pretraga','OsnovniPrezenterC@pretraga');
Route::post('/kontaktiraj-me','OsnovniPrezenterC@kontaktirajMe');
Route::post('/mejling-prijava','OsnovniPrezenterC@mejlingPrijava');
Route::controller('/{slug}','PrezenterSajtaC');
Route::controller('/','OsnovniPrezenterC');
