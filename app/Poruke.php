<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poruke extends Model
{
    protected $table='poruke';
    protected $fillable=['korisnik_id','sender_id','poruka','procitano'];
}
