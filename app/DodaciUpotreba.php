<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DodaciUpotreba extends Model
{
    protected $table='dodaci_upotreba';
    protected $fillable=['objekat_id','smestaj_id','dodaci_id','napomena'];
}
