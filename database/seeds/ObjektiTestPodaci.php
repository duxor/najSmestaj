<?php

use App\Objekat;
use App\VrstaObjekta;
use Illuminate\Database\Seeder;

class ObjektiTestPodaci extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Objekat::insert([
            [
                'korisnik_id'=>4,
                'templejt_id'=>1,
                'grad_id'=>1,
                'vrsta_objekta_id'=>2,
                'naziv'=>'Vila promaja',
                'slug'=>'vila-promaja',
                'opis'=>'opis1',
                'adresa'=>'adresa1',
                'galerija'=>'Galerija1',
                'telefon'=>'00000001516',
                'email'=>'email1@gmail.com',
                'x'=>1,
                'y'=>1,
                'z'=>1
            ],
            [
                'korisnik_id'=>5,
                'templejt_id'=>1,
                'grad_id'=>2,
                'vrsta_objekta_id'=>3,
                'naziv'=>'Smestaj Marković',
                'slug'=>'smestaj-markivic',
                'opis'=>'opis2',
                'adresa'=>'adresa2',
                'galerija'=>'Galerija2',
                'telefon'=>'00000001asdas516',
                'email'=>'email2@gmail.com',
                'x'=>2,
                'y'=>2,
                'z'=>2
            ],
            [
                'korisnik_id'=>4,
                'templejt_id'=>1,
                'grad_id'=>3,
                'vrsta_objekta_id'=>4,
                'naziv'=>'Smestaj Petrović',
                'slug'=>'smestaj-petrovic',
                'opis'=>'opis3',
                'adresa'=>'adresa3',
                'galerija'=>'Galerija3',
                'telefon'=>'00000001asadsdas516',
                'email'=>'email3@gmail.com',
                'x'=>3,
                'y'=>3,
                'z'=>3
            ],
        ]);
    }
}


