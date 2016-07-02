<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Validator;

class User extends Authenticatable{
    protected $table='korisnik';
    protected $fillable=['ime','prezime','confirmed','confirmation_code','foto','pol','email','adresa','telefon','prava_pristupa_id','grad_id', 'password'];
    protected $hidden=['password', 'remember_token'];
    public function prava()
    {
        return $this->belongsTo('App\PravaPristupa','prava_pristupa_id','id');
    }
    public function getId()
    {
        return $this->id;
    }
}
