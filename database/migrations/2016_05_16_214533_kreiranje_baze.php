<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class KreiranjeBaze extends Migration{
    public function up(){
        Schema::create('prava_pristupa', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->unique();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
        Schema::create('grad',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->string('x',45)->nullable();
            $table->string('y',45)->nullable();
            $table->tinyInteger('z')->nullable();
            $table->string('foto',250)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('korisnik', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('ime', 45)->nullable();
            $table->string('prezime', 45)->nullable();
            $table->string('password', 150);
            $table->string('foto',250)->nullable();
            $table->string('pol',45)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('adresa', 250)->nullable();
            $table->string('telefon',45)->nullable();
            $table->unsignedBigInteger('prava_pristupa_id')->default(2);
            $table->foreign('prava_pristupa_id')->references('id')->on('prava_pristupa');
            $table->unsignedBigInteger('grad_id')->default(1);
            $table->foreign('grad_id')->references('id')->on('grad');
            $table->boolean('confirmed')->default(0);
            $table->string('confirmation_code')->nullable();
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('templejt',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->string('slug', 128)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_objekta',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('objekat',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('korisnik_id');
            $table->foreign('korisnik_id')->references('id')->on('korisnik');
            $table->unsignedBigInteger('templejt_id')->default(1);
            $table->foreign('templejt_id')->references('id')->on('templejt');
            $table->string('templejt_slug', 250)->nullable();
            $table->unsignedBigInteger('grad_id');
            $table->foreign('grad_id')->references('id')->on('grad');
            $table->unsignedBigInteger('vrsta_objekta_id');
            $table->foreign('vrsta_objekta_id')->references('id')->on('vrsta_objekta');
            $table->string('naziv', 45);
            $table->string('slug', 128);
            $table->text('opis')->nullable();
            $table->string('adresa', 128)->nullable();
            $table->string('galerija',250)->nullable();
            $table->string('telefon',45)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('x',45)->nullable();
            $table->string('y',45)->nullable();
            $table->string('z',45)->nullable();
            $table->string('foto',250)->nullable();
            $table->tinyInteger('aktivan')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_smestaja',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('vrsta_kapaciteta',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->nullable();
            $table->tinyInteger('broj_osoba')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('dodaci',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45);
            $table->text('tag')->nullable();
            $table->string('slug', 45);
            $table->unsignedBigInteger('prioritet')->default(0);
            $table->unsignedBigInteger('potraznja')->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('dodaci_upotreba',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->bigInteger('objekat_id')->nullable();
            $table->bigInteger('smestaj_id')->nullable();
            $table->unsignedBigInteger('dodaci_id');
            $table->foreign('dodaci_id')->references('id')->on('dodaci');
            $table->string('napomena', 250)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('smestaj',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('objekat_id');
            $table->foreign('objekat_id')->references('id')->on('objekat');
            $table->unsignedBigInteger('vrsta_smestaja_id');
            $table->foreign('vrsta_smestaja_id')->references('id')->on('vrsta_smestaja');
            $table->unsignedBigInteger('vrsta_kapaciteta_id');
            $table->foreign('vrsta_kapaciteta_id')->references('id')->on('vrsta_kapaciteta');
            $table->string('dodaci', 250)->nullable();
            $table->string('naziv', 45)->nullable();
            $table->string('slug', 45)->nullable();
            $table->string('foto',250)->nullable();
            $table->string('galerija',250)->nullable();
            $table->tinyInteger('aktivan')->default(1);
            $table->float('cena')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('rezervacija',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('korisnik_id');
            $table->unsignedBigInteger('broj_osoba');
            $table->foreign('korisnik_id')->references('id')->on('korisnik');
            $table->unsignedBigInteger('smestaj_id');
            $table->foreign('smestaj_id')->references('id')->on('smestaj');
            $table->date('datum_prijave')->nullable();
            $table->date('datum_odjave')->nullable();
            $table->string('foto',250)->nullable();
            $table->string('galerija',250)->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('like', function(Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('smestaj_id');
            $table->foreign('smestaj_id')->references('id')->on('smestaj');
            $table->unsignedBigInteger('korisnik_id');
            $table->foreign('korisnik_id')->references('id')->on('korisnik');
            $table->tinyInteger('aktivan')->default(1);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
        Schema::create('svrha_putovanja',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->nullable();
            $table->string('slug', 128)->nullable();
            $table->unsignedBigInteger('prioritet')->default(0);
            $table->unsignedBigInteger('potraznja')->default(0);
        });
        Schema::create('destinacija',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('naziv', 45)->nullable();
            $table->string('slug', 45)->nullable();
            $table->text('opis')->nullable();
            $table->string('x',45)->nullable();
            $table->string('y',45)->nullable();
            $table->tinyInteger('z')->nullable();
            $table->text('tagovi')->nullable();
            $table->string('foto',250)->nullable();
        });
        Schema::create('destinacija_upotreba',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->unsignedBigInteger('destinacija_id');
            $table->unsignedBigInteger('objekat_id');
            $table->unsignedBigInteger('grad_id');
        });



    }
    public function down(){
        Schema::drop('destinacija_upotreba');
        Schema::drop('destinacija');
        Schema::drop('svrha_putovanja');
        Schema::drop('like');
        Schema::drop('rezervacija');
        Schema::drop('password_resets');
        Schema::drop('smestaj');
        Schema::drop('dodaci_upotreba');
        Schema::drop('dodaci');
        Schema::drop('vrsta_kapaciteta');
        Schema::drop('vrsta_smestaja');
        Schema::drop('objekat');
        Schema::drop('vrsta_objekta');
        Schema::drop('templejt');
        Schema::drop('korisnik');
        Schema::drop('grad');
        Schema::drop('prava_pristupa');
    }
}
