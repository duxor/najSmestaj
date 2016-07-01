<?php

use App\User;
use App\PravaPristupa;
use Illuminate\Database\Seeder;

class KorisniciTestPodaci extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['ime'=>'BlokiranIme','prezime'=>'BlokiranPrezume','password'=>bcrypt('admin'),'prava_pristupa_id'=>'1','email'=>'blokiran@test.com'],
            ['ime'=>'KorisnikSmestajaIme','prezime'=>'KorisnikSmestajaPrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'2','email'=>'ph'],
            ['ime'=>'PoslovodjaIme','prezime'=>'PoslovodjaPrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'3','email'=>'poslovodja@test.com'],
            ['ime'=>'VlasnikPrivatnogSmestajaIme','prezime'=>'VlasnikPrivatnogSmestajaPrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'4','email'=>'vlasniksmestaja@test.com'],
            ['ime'=>'VlasnikFirmeIme','prezime'=>'VlasnikFirmePrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'5','email'=>'vlasnikfirme@test.com'],
        ]);
    }
}




