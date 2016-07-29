<?php

use Illuminate\Database\Seeder;
use App\Poruke;
class PorukeTestPodaci extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Poruke::insert([
            ['korisnik_id'=>2,'sender_id'=>4,'poruka'=>'Koliko košta dnenvi najam?'],
            ['korisnik_id'=>4,'sender_id'=>2,'poruka'=>'2500 din.'],
            ['korisnik_id'=>3,'sender_id'=>4,'poruka'=>'Da li ima kablovska televiija?'],
            ['korisnik_id'=>4,'sender_id'=>3,'poruka'=>'Da.Ima SBB kablovski.'],
            ['korisnik_id'=>5,'sender_id'=>4,'poruka'=>'Da li ima klima?'],
        ]);
    }
}
