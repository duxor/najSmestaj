<?php
/*Kontroller ProfilC sadrži funkcije potrebne za korisnika koji traži smještaj */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfilC extends Controller
{
    public function __construct(){
        $this->middleware('PravaPristupaMid:5,1');
    }
    
    public function getIndex(){
        return view('korisnik.index');
    }

    public function getListaZelja(){
        $liste_zelja =  DB::table('like')
            ->join('smestaj', 'like.smestaj_id','=','smestaj.id')
            ->join('objekat','smestaj.objekat_id','=','objekat.id')
            ->join('vrsta_smestaja','smestaj.vrsta_smestaja_id','=','vrsta_smestaja.id')
            ->join('vrsta_kapaciteta','smestaj.vrsta_kapaciteta_id','=','vrsta_kapaciteta.id')
            ->where('like.korisnik_id','=',Auth::user()->id)
            ->select('smestaj.naziv as naziv_smestaja','vrsta_smestaja.naziv as vrsta_smestaja','vrsta_kapaciteta.naziv as vrsta_kapaciteta',
                'objekat.naziv as naziv_objekta','aktivan')
            ->get();
        return view('korisnik.lista-zelja')->with('liste_zelja', $liste_zelja);
    }
    public function getRezervacije(){
        $rezervacije =  DB::table('rezervacija')
            ->join('smestaj', 'rezervacija.smestaj_id','=','smestaj.id')
            ->join('objekat','smestaj.objekat_id','=','objekat.id')
            ->join('vrsta_smestaja','smestaj.vrsta_smestaja_id','=','vrsta_smestaja.id')
            ->join('vrsta_kapaciteta','smestaj.vrsta_kapaciteta_id','=','vrsta_kapaciteta.id')
            ->where('rezervacija.korisnik_id','=',Auth::user()->id)
            ->select('smestaj.naziv as naziv_smestaja','vrsta_smestaja.naziv as vrsta_smestaja','vrsta_kapaciteta.naziv as vrsta_kapaciteta',
                'objekat.naziv as naziv_objekta', 'rezervacija.broj_osoba as broj_osoba',
                'datum_prijave', 'datum_odjave')
            ->get();
        return view('korisnik.rezervacije')->with('rezervacije', $rezervacije);
    }
}
