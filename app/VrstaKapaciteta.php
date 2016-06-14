<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VrstaKapaciteta extends Model
{
    protected $table='vrsta_kapaciteta';
    protected $fillable=['naziv'];
}
