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
        VrstaObjekta::insert([
            ['naziv'=>'Privatni smeštaj'],
            ['naziv'=>'Motel'],
            ['naziv'=>'Hostel'],
            ['naziv'=>'Hotel']
        ]);
        Objekat::insert([
            ['korisnik_id'=>1,'templejt_id'=>1,'grad_id'=>1,'vrsta_objekta_id'=>1,'naziv'=>'Vila promaja'],
            ['korisnik_id'=>2,'templejt_id'=>1,'grad_id'=>2,'vrsta_objekta_id'=>2,'naziv'=>'Smestaj Marković'],
            ['korisnik_id'=>3,'templejt_id'=>1,'grad_id'=>3,'vrsta_objekta_id'=>3,'naziv'=>'Smestaj Petrović'],
        ]);
    }
}
