﻿<?php

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
Route::get('/',function(){ return view('index')->with(['gradovi'=>\App\Grad::lists('naziv','id')]); });
Route::get('/newsletter',function(){
    return json_encode(['check'=>1,'poruka'=>'Uspešno ste se prijavili na newsletter listu!']);
});
Route::get('/kontakt',function(){
    return json_encode(['check'=>1,'poruka'=>'Uspešno ste poslali poruku!']);
});
Route::auth();
Route::controller('/administration','AdminC');
Route::controller('/management ','ManagerC');
Route::controller('/profil','ProfilC');
Route::controller('/pretraga','PretragaC');

Route::get('register/verify/{confirmationCode}','Auth\AuthController@confirm');

Route::controller('/{slug}/{slug2?}', 'PrezenterC');
Route::get('/nepotvrdjen',function(){
    return view('errors.nepotvrdjen');
});

