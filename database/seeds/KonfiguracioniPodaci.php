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
        PravaPristupa::insert([
            ['naziv'=>'Blokiran'],
            ['naziv'=>'Korisnik smeštaja'],
            ['naziv'=>'Poslovođa'],
            ['naziv'=>'Vlasnik privatnog smeštaja'],
            ['naziv'=>'Vlasnik firme']
        ]);
         VrstaObjekta::insert([
            ['naziv'=>'Privatni smeštaj'],
            ['naziv'=>'Motel'],
            ['naziv'=>'Hostel'],
            ['naziv'=>'Hotel']
        ]);
           VrstaSmestaja::insert([
            ['naziv'=>'Soba'],
            ['naziv'=>'Apartman'],
            ['naziv'=>'Stan']
        ]);
        VrstaKapaciteta::insert([
            ['naziv'=>'Za jednu osobu'],
            ['naziv'=>'Za dve osobe'],
            ['naziv'=>'Za tri osobe'],
            ['naziv'=>'Za četiri osobe'],
            ['naziv'=>'Za pet osoba'],
            ['naziv'=>'Za šest osoba'],
            ['naziv'=>'Za sedam osoba'],
            ['naziv'=>'Za osam osoba'],
            ['naziv'=>'Za devet osoba'],
            ['naziv'=>'Za deset osoba'],
            ['naziv'=>'Za jedanaest osoba'],
            ['naziv'=>'Za dvanaest osoba']
        ]);
      
    }
}
