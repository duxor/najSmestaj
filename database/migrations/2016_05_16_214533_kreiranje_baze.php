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

        Schema::create('korisnik', function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('ime', 45)->nullable();
            $table->string('prezime', 45)->nullable();
            $table->string('username', 45)->unique();
            $table->string('password', 150)->default('P@ssw0rd');
            $table->string('foto',250)->nullable();
            $table->string('pol',45)->nullable();
            $table->string('email', 80)->nullable();
            $table->string('adresa', 250)->nullable();
            $table->string('telefon',45)->nullable();
            $table->unsignedBigInteger('prava_pristupa_id')->default(2);
            $table->foreign('prava_pristupa_id')->references('id')->on('prava_pristupa');
            $table->rememberToken();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();
        });
    }


    public function down(){
        Schema::drop('prava_pristupa');
        Schema::drop('korisnik');
    }
}
