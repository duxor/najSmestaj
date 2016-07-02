<?php

/*
 * Kontroller ManagerC sadrži funkcije koje se koriste za rad poslovodje
 * Kontroler u prvoj veryiji neće biti razvijan, a koristiće se za ograničene
 * mogućnosti upravljanja određenim poslovima; rezervacija, potvrda rezervacije,
 * prijava i odjava korisnika...
 *
 * */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManagerC extends Controller{
    public function getIndex(){
        return view('errors.503');
    }
}
