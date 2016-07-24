<?php
/*
 * Kontroller ProfilC sadrži funkcije potrebne za korisnika koji traži smještaj 
 *
 * */
namespace App\Http\Controllers;

use App\Smestaj;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ProfilC extends Controller{
    public function __construct(){
        $this->middleware('PravaPristupaMid:2,1');
    }
    public function _tab(){
        if(Session::has('tab')){
            $tab=Session::get('tab');
            Session::forget('tab');
        }else $tab=null;
        return $tab;
    }
    public function getIndex(){
        return view('korisnik.index')->with(['tab'=>$this->_tab(),'omeni'=>Auth::user()]);
    }
    public function postIndex(){
        $podaci=Input::except(['_token','password_confirmation','password']);
        if(strlen(Input::get('password'))>5 && Input::get('password')==Input::get('password_confirmation'))
            $podaci['password']=bcrypt(Input::get('password'));
        User::where('id',Auth::user()->id)->update($podaci);
        return redirect('/profil')->with(['tab'=>'settings']);
    }
    public function getIzmeni(){
        return redirect('/profil')->with(['tab'=>'settings']);
    }
    public function getListaZelja(){
        $lista_zelja=Smestaj::where('like.korisnik_id','=',Auth::user()->id)
            -> join('objekat','objekat.id','=','smestaj.objekat_id')
            //->join('rezervacija','rezervacija.smestaj_id','=','smestaj.id')
            ->join('grad','grad.id','=','objekat.grad_id')
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
            ->leftJoin('like',function($query){
                $query->on('like.smestaj_id','=','smestaj.id')
                    ->where('like.korisnik_id','=',Auth::user()->id)
                    ->where('like.aktivan','=',1);
            })->get([
                'smestaj.id',
                'smestaj.slug as slug_smestaja',
                'objekat.naziv as naziv_objekta',
                'objekat.slug as slug_objekta',
                'vrsta_smestaja.naziv as vrsta_smestaja',
                'vrsta_kapaciteta.naziv as vrsta_kapaciteta',
                //'smestaj.dodaci',
                'like.id as zelja'
            ]);

        return view('korisnik.like',compact('lista_zelja'));

        /*$liste_zelja =  DB::table('like')
            ->join('smestaj', 'like.smestaj_id','=','smestaj.id')
            ->join('objekat','smestaj.objekat_id','=','objekat.id')
            ->join('vrsta_smestaja','smestaj.vrsta_smestaja_id','=','vrsta_smestaja.id')
            ->join('vrsta_kapaciteta','smestaj.vrsta_kapaciteta_id','=','vrsta_kapaciteta.id')
            ->where('like.korisnik_id','=',Auth::user()->id)
            ->select('smestaj.naziv as naziv_smestaja','vrsta_smestaja.naziv as vrsta_smestaja','vrsta_kapaciteta.naziv as vrsta_kapaciteta', 'objekat.naziv as naziv_objekta','like.aktivan')
            ->get();
        return view('korisnik.like')->with('liste_zelja', $liste_zelja);*/
    }
    public function getRezervacije(){
        $rezervacije = DB::table('rezervacija')
            ->join('smestaj', 'rezervacija.smestaj_id','=','smestaj.id')
            ->join('objekat','smestaj.objekat_id','=','objekat.id')
            ->join('vrsta_smestaja','smestaj.vrsta_smestaja_id','=','vrsta_smestaja.id')
            ->join('vrsta_kapaciteta','smestaj.vrsta_kapaciteta_id','=','vrsta_kapaciteta.id')
            ->where('rezervacija.korisnik_id','=',Auth::user()->id)
            ->select(
                'smestaj.naziv as naziv_smestaja',
                'smestaj.slug as slug_smestaja',
                'vrsta_smestaja.naziv as vrsta_smestaja',
                'vrsta_kapaciteta.naziv as vrsta_kapaciteta',
                'objekat.naziv as naziv_objekta',
                'objekat.slug as slug_objekta',
                'rezervacija.broj_osoba as broj_osoba',
                'datum_prijave',
                'datum_odjave'
            )
            ->get();
        return view('korisnik.rezervacije')->with('rezervacije', $rezervacije);
    }
}
