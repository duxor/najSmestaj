<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DateTime;
use App\Smestaj;
use App\Grad;
use App\Objekat;
use App\VrstaKapaciteta;
use App\Rezervacija;
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
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id');
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
            $smestaj = $query->get(['smestaj.id','objekat.naziv'])->toArray();
            $smestaj= Funkcije::dostupnostZaRezervaciju($smestaj,$datum_prijave,$datum_odjave);
            return view('pretraga')->with(['smestaj'=>$smestaj]);
        }else{
            $smestaj = $query->get(['objekat.naziv'])->toArray();
            return view('pretraga')->with(['smestaj'=>$smestaj]);
        }
    }
}
