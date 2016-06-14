<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Smestaj extends Model
{
    protected $table='smestaj';
    protected $fillable=['objekat_id','vrsta_smestaja_id','vrsta_kapaciteta_id','dodaci'];
}
