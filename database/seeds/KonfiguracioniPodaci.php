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
       Objekat::insert([
            ['korisnik_id'=>1,'templejt_id'=>1,'grad_id'=>1,'vrsta_objekta_id'=>1,'naziv'=>'Vila promaja'],
            ['korisnik_id'=>2,'templejt_id'=>1,'grad_id'=>2,'vrsta_objekta_id'=>2,'naziv'=>'Smestaj Marković'],
            ['korisnik_id'=>3,'templejt_id'=>1,'grad_id'=>3,'vrsta_objekta_id'=>3,'naziv'=>'Smestaj Petrović'],
            ]);
        Smestaj::insert([
            ['objekat_id'=>1,'vrsta_smestaja_id'=>1,'vrsta_kapaciteta_id'=>1],
            ['objekat_id'=>2,'vrsta_smestaja_id'=>2,'vrsta_kapaciteta_id'=>2],
            ['objekat_id'=>3,'vrsta_smestaja_id'=>2,'vrsta_kapaciteta_id'=>3]
        ]);
        Rezervacija::insert([
            ['korisnik_id'=>1,'smestaj_id'=>1,'datum_prijave'=>'2016-06-16','datum_odjave'=>'2016-06-18'],
            ['korisnik_id'=>2,'smestaj_id'=>2,'datum_prijave'=>'2016-06-20','datum_odjave'=>'2016-06-22'],
            ['korisnik_id'=>3,'smestaj_id'=>3,'datum_prijave'=>'2016-06-24','datum_odjave'=>'2016-06-26']
        ]);
        Like::insert([
            ['korisnik_id'=>1,'smestaj_id'=>1],
            ['korisnik_id'=>2,'smestaj_id'=>2],
            ['korisnik_id'=>3,'smestaj_id'=>3]

        ]);
    }
}
