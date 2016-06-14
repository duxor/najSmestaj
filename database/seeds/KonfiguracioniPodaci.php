<?php

use Illuminate\Database\Seeder;
use App\PravaPristupa;
use App\Grad;
use App\User;
use App\Templejt;

class KonfiguracioniPodaci extends Seeder{
    public function run(){
        PravaPristupa::insert([
            ['naziv'=>'Blokiran'],
            ['naziv'=>'Korisnik smeštaja'],
            ['naziv'=>'Poslovođa'],
            ['naziv'=>'Vlasnik privatnog smeštaja'],
            ['naziv'=>'Vlasnik firme'],
        ]);
        /*  Grad::insert([
              ['naziv'=>'Kraljevo'],
              ['naziv'=>'Beograd'],
              ['naziv'=>'Vranje'],
          ]);
          Templejt::insert([
              ['naziv'=>'Osnovni izgled','slug'=>'osnovni-izgled'],
          ]);*/

    }
}
