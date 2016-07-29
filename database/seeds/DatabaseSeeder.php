<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        $this->call(KonfiguracioniPodaci::class);
        $this->call(KorisniciTestPodaci::class);
        $this->call(ObjektiTestPodaci::class);
        $this->call(SmestajiTestPodaci::class);
        $this->call(DestinacijaTest::class);
        $this->call(PorukeTestPodaci::class);

    }
}
