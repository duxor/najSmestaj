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
            ['ime'=>'BlokiranIme','prezime'=>'BlokiranPrezume','password'=>bcrypt('admin'),'prava_pristupa_id'=>'1','grad_id'=>'1','email'=>'blokiran@test.com'],
            ['ime'=>'KorisnikSmestajaIme','prezime'=>'KorisnikSmestajaPrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'2','grad_id'=>'2','email'=>'korisnik@test.com'],
            ['ime'=>'PoslovodjaIme','prezime'=>'PoslovodjaPrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'3','grad_id'=>'3','email'=>'poslovodja@test.com'],
            ['ime'=>'VlasnikPrivatnogSmestajaIme','prezime'=>'VlasnikPrivatnogSmestajaPrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'4','grad_id'=>'1','email'=>'vlasniksmestaja@test.com'],
            ['ime'=>'VlasnikFirmeIme','prezime'=>'VlasnikFirmePrezime','password'=>bcrypt('admin'),'prava_pristupa_id'=>'5','grad_id'=>'2','email'=>'vlasnikfirme@test.com'],
            ['ime'=>'Aleksandar','prezime'=>'Jović','password'=>bcrypt('admin'),'prava_pristupa_id'=>'1','email'=>'aleksandar.jovic@test.com',
                'adresa'=>'Leskovac','telefon'=>'06512345670','confirmed'=>1],
            ['ime'=>'Dušan','prezime'=>'Perišić','password'=>bcrypt('admin'),'prava_pristupa_id'=>'2','email'=>'dusan.perisic@test.com',
                'adresa'=>'Kraljevo','telefon'=>'06512345671','confirmed'=>1],
            ['ime'=>'Saša','prezime'=>'Jović','password'=>bcrypt('admin'),'prava_pristupa_id'=>'3','email'=>'sasa.jovic@test.com',
                'adresa'=>'Beograd','telefon'=>'06512345672','confirmed'=>1],
            ['ime'=>'Miloš','prezime'=>'Milošević','password'=>bcrypt('admin'),'prava_pristupa_id'=>'4','email'=>'milos.milosevic@test.com',
                'adresa'=>'Beograd','telefon'=>'06512345673','confirmed'=>1],
            ['ime'=>'Marko','prezime'=>'Marković','password'=>bcrypt('admin'),'prava_pristupa_id'=>'5','email'=>'marko.markovic@test.com',
                'adresa'=>'Kraljevo','telefon'=>'06512345674','confirmed'=>1],
        ]);
    }
}




