<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table='like';
    protected $fillable=['korisnik_id','smestaj_id'];

}