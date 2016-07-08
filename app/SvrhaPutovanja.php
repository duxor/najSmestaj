<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SvrhaPutovanja extends Model
{
    protected $table='svrha_putovanja';
    protected $fillable=['naziv','slug','prioritet','potraznja'];
   public static function dajPrioritete(){
        return SvrhaPutovanja::get(['id','naziv','slug'])->take(5);
    }
}
