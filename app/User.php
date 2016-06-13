<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable{
    protected $table='korisnici';
    protected $fillable=['ime','prezime','password','email','pin','bio','telefon','grad_id','prava_pristupa_id','foto','galerija','confirmed','confirmation_code'];
    protected $hidden=['password', 'remember_token'];
    public static function provjeriUnos($podaci){
        $v=Validator::make(
            $podaci,
            [
                'email'=>'email|required|unique:korisnici',
                'password'=>'required|min:3'
            ],
            [
                'email.email'=>'Email adresa nije validna!',
                'email.required'=>'Email adresa je obavezna za unos!',
                'email.unique'=>'Uneseni email se već nalazi u našoj evidenciji!',
                'password.required'=>'Pristupna šifra je obavezna za unos!',
                'password.min'=>'Pristupna šifra mora da bude duža od :min!'
            ]);
        return $v->errors()->toArray();

    }
}
