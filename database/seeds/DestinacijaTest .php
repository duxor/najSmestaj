<?php

use App\Destinacija;
use App\DestinacijaUpotreba;
use Illuminate\Database\Seeder;

class DestinacijaTest  extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Destinacija::insert([
            ['naziv'=>'Farska ostrva','slug'=>'farska-ostrva','opis'=>'Divno mesto za odmor.','x'=>'-81.47460937','y'=>'27.52775821','z'=>'10','tagovi'=>'farska ostrva'],
            ['naziv'=>'Jamaika','slug'=>'jamaika','opis'=>'Divno mesto za odmor.','x'=>'-77.50854492','y'=>'18.18760655','z'=>'10','tagovi'=>'jamaika'],
            ['naziv'=>'Haiti','slug'=>'haiti','opis'=>'Divno mesto za odmor.','x'=>'-72.13623047','y'=>'19.05173367','z'=>'10','tagovi'=>'haiti']
        ]);
        DestinacijaUpotreba::insert([
            [destinacija_id=>1, objekat_id=>1, grad_id=>null],
            [destinacija_id=>2, objekat_id=>null, grad_id=>1],
            [destinacija_id=>3, objekat_id=>null, grad_id=>2],

           ]);

    }
}
