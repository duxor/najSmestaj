<?php

use App\Rezervacija;
use App\Smestaj;
use App\VrstaKapaciteta;
use App\VrstaSmestaja;
use Illuminate\Database\Seeder;

class SmestajiTestPodaci extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Smestaj::insert([
            ['objekat_id'=>1,'vrsta_smestaja_id'=>1,'vrsta_kapaciteta_id'=>1,'naziv'=>'nazvi1','slug'=>'slug1','cena'=>'2200'],
            ['objekat_id'=>2,'vrsta_smestaja_id'=>2,'vrsta_kapaciteta_id'=>2,'naziv'=>'nazvi2','slug'=>'slug2','cena'=>'3600'],
            ['objekat_id'=>3,'vrsta_smestaja_id'=>2,'vrsta_kapaciteta_id'=>3,'naziv'=>'nazvi3','slug'=>'slug3','cena'=>'1100']
        ]);
        Rezervacija::insert([
            ['korisnik_id'=>1,'smestaj_id'=>1,'broj_osoba'=>'3','datum_prijave'=>'2016-06-16','datum_odjave'=>'2016-06-18'],
            ['korisnik_id'=>2,'smestaj_id'=>2,'broj_osoba'=>'4','datum_prijave'=>'2016-06-20','datum_odjave'=>'2016-06-22'],
            ['korisnik_id'=>3,'smestaj_id'=>3,'broj_osoba'=>'5','datum_prijave'=>'2016-06-24','datum_odjave'=>'2016-06-26']
        ]);
        \App\Like::insert([
            ['korisnik_id'=>1,'smestaj_id'=>1],
            ['korisnik_id'=>2,'smestaj_id'=>2],
            ['korisnik_id'=>3,'smestaj_id'=>3]

        ]);
    }
}
