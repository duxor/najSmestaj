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
            ['ime'=>'BlokiranIme','prezime'=>'BlokiranPrezume','email'=>'email1@gmail.com','password'=>bcrypt('admin'),'prava_pristupa_id'=>'1'],
            ['ime'=>'KorisnikSmestajaIme','prezime'=>'KorisnikSmestajaPrezime','email'=>'email2@gmail.com','password'=>bcrypt('admin'),'prava_pristupa_id'=>'2'],
            ['ime'=>'PoslovodjaIme','prezime'=>'PoslovodjaPrezime','email'=>'email3@gmail.com','password'=>bcrypt('admin'),'prava_pristupa_id'=>'3'],
            ['ime'=>'VlasnikPrivatnogSmestajaIme','prezime'=>'VlasnikPrivatnogSmestajaPrezime','email'=>'email4@gmail.com','password'=>bcrypt('admin'),'prava_pristupa_id'=>'4'],
            ['ime'=>'VlasnikFirmeIme','prezime'=>'VlasnikFirmePrezime','email'=>'email5@gmail.com','password'=>bcrypt('admin'),'prava_pristupa_id'=>'5'],
        ]);
    }
}




