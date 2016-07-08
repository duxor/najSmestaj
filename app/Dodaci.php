<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dodaci extends Model
{
    protected $table='dodaci';
    protected $fillable=['naziv','tag','slug','prioritet','potraznja'];
}
