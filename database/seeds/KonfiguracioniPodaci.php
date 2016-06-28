<?php

use Illuminate\Database\Seeder;
use App\PravaPristupa;
use App\Grad;
use App\Templejt;
use App\VrstaObjekta;
use App\VrstaSmestaja;
use App\VrstaKapaciteta;
use App\Objekat;
use App\Smestaj;
use App\Rezervacija;
use App\Like;

class KonfiguracioniPodaci extends Seeder{
    public function run(){
          Grad::insert([
              ['naziv'=>'Kraljevo'],
              ['naziv'=>'Beograd'],
              ['naziv'=>'Vranje'],
          ]);
        Templejt::insert([
            ['naziv'=>'Osnovni izgled']
        ]);
      
    }
}
