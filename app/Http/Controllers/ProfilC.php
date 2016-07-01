<?php
/*Kontroller ProfilC sadrži funkcije potrebne za korisnika koji traži smještaj */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilC extends Controller
{
    public function getIndex(){
        return view('korisnik.index');
    }

    public function getListaZelja(){
        return 1;
    }
    public function getRezervacije(){
        return 1;
    }
}
