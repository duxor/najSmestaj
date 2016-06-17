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
Route::get('/',function(){ return view('index')->with(['gradovi'=>\App\Grad::lists('naziv','id')->prepend('Izaberite grad','')]); });
Route::auth();
Route::get('/home', 'HomeController@index');
Route::get('/proba', function(){
    return view('proba');
});
Route::controller('/administration','AdminC');
Route::controller('/management ','ManagerC');
Route::controller('/profil','ProfilC');
Route::controller('/pretraga','PretragaC');
