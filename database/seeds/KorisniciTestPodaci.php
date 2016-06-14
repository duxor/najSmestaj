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
        PravaPristupa::insert([
            ['naziv'=>'Blokiran'],
            ['naziv'=>'Korisnik smeštaja'],
            ['naziv'=>'Poslovođa'],
            ['naziv'=>'Vlasnik privatnog smeštaja'],
            ['naziv'=>'Vlasnik firme']
        ]);
        User::insert([
            ['ime'=>'BlokiranIme','prezime'=>'BlokiranPrezume','username'=>'blokiranusername','password'=>bcrypt('admin'),'prava_pristupa_id'=>'1'],
            ['ime'=>'KorisnikSmestajaIme','prezime'=>'KorisnikSmestajaPrezime','username'=>'korisniksmestajausername','password'=>bcrypt('admin'),'prava_pristupa_id'=>'2'],
            ['ime'=>'PoslovodjaIme','prezime'=>'PoslovodjaPrezime','username'=>'poslovodjausername','password'=>bcrypt('admin'),'prava_pristupa_id'=>'3'],
            ['ime'=>'VlasnikPrivatnogSmestajaIme','prezime'=>'VlasnikPrivatnogSmestajaPrezime','username'=>'vlasnikprivatnogsmestajausername','password'=>bcrypt('admin'),'prava_pristupa_id'=>'4'],
            ['ime'=>'VlasnikFirmeIme','prezime'=>'VlasnikFirmePrezime','username'=>'vlasnikfirmeusername','password'=>bcrypt('admin'),'prava_pristupa_id'=>'5'],
        ]);
    }
}



