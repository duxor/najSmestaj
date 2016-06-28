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
        Smestaj::insert([
            ['objekat_id'=>1,'vrsta_smestaja_id'=>1,'vrsta_kapaciteta_id'=>1],
            ['objekat_id'=>2,'vrsta_smestaja_id'=>2,'vrsta_kapaciteta_id'=>2],
            ['objekat_id'=>3,'vrsta_smestaja_id'=>2,'vrsta_kapaciteta_id'=>3]
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
