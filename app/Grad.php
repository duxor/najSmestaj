<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grad extends Model{
    protected $table='grad';
    protected $fillable=['naziv','x','y','z'];

    public static function listaPostojecih(){
        return Grad::join('ordinacija as o','o.grad_id','=','grad.id')->groupBy('grad.id')->lists('grad.naziv','grad.id');
    }
}