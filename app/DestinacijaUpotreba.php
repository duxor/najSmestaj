<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DestinacijaUpotreba extends Model
{
    protected $table='destinacija_upotreba';
    protected $fillable=['objekat_id','grad_id'];
}
