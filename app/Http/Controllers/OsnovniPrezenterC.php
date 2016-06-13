<?php

namespace App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Osnovni prezenter
|--------------------------------------------------------------------------
|
| Sadrži sve metode koje se koriste za prikaz master sajta koji
| objedinjuje sve pojedinačne zubarske ordinacije i njihove
| sajtove. Ne sadrži metode za administriranje.
|
*/
use App\Grad;
use App\Ordinacija;
use App\Rezervacija;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;

class OsnovniPrezenterC extends Controller{
    public function getIndex(){
        $grad=Grad::listaPostojecih();
        return view('index')->with(compact('grad'));
    }

    public function kontaktirajMe(){
        $podaci=Input::all();
        Mail::send('emails.kontakt', $podaci, function($message){
            $message->to('kontakt@dusanperisic.com')
                ->subject('KONTAKT SA SAJTA');
        });
        return '1';
    }
    public function postMejlingPrijava(){
        Mail::send('emails.mejling', ['email'=>Input::get('email')], function($message){
            $message->to('kontakt@dusanperisic.com')
                ->subject('MEJLING PRIJAVA');
        });
        return '1';
    }
    public function pretraga(){
        $gradovi=Grad::listaPostojecih();
        $ordinacije=null;
        $post=0;
        $naziv_pretraga=Input::get('naziv_pretraga');
        if(Input::has('grad_pretraga')){
            $ordinacije=Ordinacija::
                where('grad_id',Input::get('grad_pretraga'))
                ->where('naziv','LIKE','%'.$naziv_pretraga.'%')
                ->orderBy('naziv')->get(['naziv','slug','logo','adresa','grad_id','telefon','x','y','z']);
            $post=1;
        }
        return view('pretraga')->with(compact('ordinacije','gradovi','post','naziv_pretraga'));
    }
}
