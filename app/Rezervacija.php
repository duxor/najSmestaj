<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model
{
    protected $table='rezervacija';
    protected $fillable=['korisnik_id','smestaj_id','broj_osoba','datum_prijave','datum_odjave','foto','galerija'];
}
