<?php

use App\Dodaci;
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
use App\Funkcije;

class KonfiguracioniPodaci extends Seeder{
    public function run(){
        Grad::insert([
            ['naziv' => 'Kraljevo'],
            ['naziv' => 'Beograd'],
            ['naziv' => 'Vranje'],
        ]);
        Templejt::insert([
            ['naziv' => 'Plavi izgled', 'slug'=>Funkcije::kreirajSlug('Plavi izgled', new Templejt())]
        ]);
        PravaPristupa::insert([
            ['naziv' => 'Blokiran'],
            ['naziv' => 'Korisnik smeštaja'],
            ['naziv' => 'Poslovođa'],
            ['naziv' => 'Vlasnik privatnog smeštaja'],
            ['naziv' => 'Vlasnik firme']
        ]);
        VrstaObjekta::insert([
            ['naziv' => 'Privatni smeštaj'],
            ['naziv' => 'Motel'],
            ['naziv' => 'Hostel'],
            ['naziv' => 'Hotel']
        ]);
        VrstaSmestaja::insert([
            ['naziv' => 'Soba'],
            ['naziv' => 'Apartman'],
            ['naziv' => 'Stan']
        ]);
        VrstaKapaciteta::insert([
            ['naziv' => 'Za jednu osobu',     'broj_osoba' => 1],
            ['naziv' => 'Za dve osobe',       'broj_osoba' => 2],
            ['naziv' => 'Za tri osobe',       'broj_osoba' => 3],
            ['naziv' => 'Za četiri osobe',    'broj_osoba' => 4],
            ['naziv' => 'Za pet osoba',       'broj_osoba' => 5],
            ['naziv' => 'Za šest osoba',      'broj_osoba' => 6],
            ['naziv' => 'Za sedam osoba',     'broj_osoba' => 7],
            ['naziv' => 'Za osam osoba',      'broj_osoba' => 8],
            ['naziv' => 'Za devet osoba',     'broj_osoba' => 9],
            ['naziv' => 'Za deset osoba',     'broj_osoba' => 10],
            ['naziv' => 'Za jedanaest osoba', 'broj_osoba' => 11],
            ['naziv' => 'Za dvanaest osoba',  'broj_osoba' => 12]
        ]);
        Dodaci::insert([
            ['naziv' => 'klima uredjaj', 'tag' => 'klima uredjaj', 'slug'=>Funkcije::kreirajSlug('klima uredjaj',new Dodaci()) ],
            ['naziv' => 'bezicni internet',  'tag' => 'internet', 'slug'=>Funkcije::kreirajSlug('bezicni internet',new Dodaci())],
            ['naziv' => 'pribor za peglanje',  'tag' => 'peglanje', 'slug'=>Funkcije::kreirajSlug('pribor za peglanje',new Dodaci())],
            ['naziv' => 'telefon',  'tag' => 'telefon', 'slug'=>Funkcije::kreirajSlug('telefon',new Dodaci())],
            ['naziv' => 'cajna kuhinja',  'tag' => 'kuhinja', 'slug'=>Funkcije::kreirajSlug('cajna kuhinja',new Dodaci())],
        ]);
      
    }
}
