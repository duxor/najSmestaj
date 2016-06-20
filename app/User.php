<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable{
    protected $table='korisnik';
    protected $fillable=['ime','prezime','confirmed','confirmation_code','foto','pol','email','adresa','telefon','prava_pristupa_id', 'password'];
    protected $hidden=['password', 'remember_token'];
}
