<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Objekat extends Model
{
    protected $table='objekat';
    protected $fillable=['korisnik_id','templejt_id','grad_id','vrsta_objekta_id','naziv','slug','opis','adresa','galerija','telefon','email','x','y','z','foto','aktivan'];
}
