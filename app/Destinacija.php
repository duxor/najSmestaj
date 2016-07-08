<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destinacija extends Model
{
    protected $table='destinacija';
    protected $fillable=['naziv','slug','opis','x','y','z','tagovi','foto'];
}
