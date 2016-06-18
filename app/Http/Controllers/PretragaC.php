<?php
//Kontroler PretragaC sadrži funkcije koje su potrebne za pretragu, kreiranje i prikaz liste želja korisnika
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use DateTime;
use App\Smestaj;
use App\Grad;
use App\Objekat;
use App\VrstaKapaciteta;
use App\Rezervacija;
use App\VrstaSmestaja;
use App\Like;
use App\Funkcije;

class PretragaC extends Controller
{
    public function getIndex(){

        return view('pretraga');
    }
    public function postIndex(){
        $query=Smestaj::join('objekat','objekat.id','=','smestaj.objekat_id')
            ->leftJoin('rezervacija','rezervacija.smestaj_id','=','smestaj.id')
            ->join('grad','grad.id','=','objekat.grad_id')
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
            ->leftJoin('like',function($query){
                $query->on('like.smestaj_id','=','smestaj.id')
                    ->where('like.korisnik_id','=',Session::get('id'))->where('like.aktivan','=',1);
            });
        if($_POST['naziv']!== ''){
            $query->where('objekat.naziv', 'Like','%'.$_POST["naziv"].'%');
        }
        if($_POST['grad']!== ''){
            $query->where('grad.id', '>=',$_POST["grad"]);
        }
        if($_POST['broj_osoba']){
            $query->where('vrsta_kapaciteta.id','>=',$_POST["broj_osoba"]);
        }
        if($_POST["datum_prijave"]!== ''&& $_POST["datum_odjave"]!== ''){
            $datum_prijave= $_POST['datum_prijave'];
            $datum_odjave= $_POST['datum_odjave'];
            $smestaj = $query->get(['smestaj.id','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja','vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.dodaci','like.id as zelja'])->toArray();
            $smestaj= Funkcije::dostupnostZaRezervaciju($smestaj,$datum_prijave,$datum_odjave);
            return view('pretraga')->with(['smestaj'=>$smestaj]);
        }else{
            $smestaj = $query->get(['smestaj.id','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja','vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.dodaci','like.id as zelja'])->toArray();
            return view('pretraga')->with(['smestaj'=>$smestaj]);
        }
    }
    public function postLike(){
        if($_POST['zelja'])
            if($_POST['zelja']=="false") {
                $lista=new Like();
                $lista->smestaj_id=$_POST['smestaj'];
                $lista->korisnik_id=$_POST['korisnik'];
                $lista->save();
                return $lista->id;
            }else return Like::where('korisnik_id',Session::get('id'))->where('id',$_POST['zelja'])->update(['aktivan'=>0]);
    }
    public function getLike(){
        $lista_zelja=Smestaj::where('like.korisnik_id','=',Session::get('id'))
       -> join('objekat','objekat.id','=','smestaj.objekat_id')
            ->leftJoin('rezervacija','rezervacija.smestaj_id','=','smestaj.id')
            ->join('grad','grad.id','=','objekat.grad_id')
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
            ->leftJoin('like',function($query){
                $query->on('like.smestaj_id','=','smestaj.id')
                    ->where('like.korisnik_id','=',Session::get('id'))->where('like.aktivan','=',1);
            })->get(['smestaj.id','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja','vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.dodaci','like.id as zelja'])->toArray();

        return view('korisnik.like',compact('lista_zelja'));
    }
}
