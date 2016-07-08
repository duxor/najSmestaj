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
Route::get('/',function(){ return view('index')->with(['gradovi'=>\App\Grad::lists('naziv','id'),'svrha_putovanja'=>\App\SvrhaPutovanja::dajPrioritete()]); });
Route::get('/newsletter',function(){
    return json_encode(['check'=>1,'poruka'=>'Uspešno ste se prijavili na newsletter listu!']);
});
Route::get('/kontakt',function(){
    return json_encode(['check'=>1,'poruka'=>'Uspešno ste poslali poruku!']);
});
Route::get('/after-login',function(){
    switch(Auth::user()->prava_pristupa_id){
        case 2: return redirect('/profil'); break;
        case 4: return redirect('/privatni'); break;
        case 5: return redirect('/administration'); break;
        default: return redirect('/');
    }
});
Route::auth();
Route::controller('/administration','AdminC');
Route::controller('/management ','ManagerC');
Route::controller('/profil','ProfilC');
Route::controller('/privatni','PrivatnikC');
Route::controller('/pretraga','PretragaC');

Route::get('register/verify/{confirmationCode}','Auth\AuthController@confirm');

Route::get('/nepotvrdjen',function(){
    return view('errors.nepotvrdjen');
});

Route::controller('/{slug}/{slug2?}', 'PrezenterC');

