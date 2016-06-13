<?php
/**
 * Created by PhpStorm.
 * User: Dušan
 * Date: 5/17/2016
 * Time: 20:27
 */

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Funkcije{
    public static function kreirajSlug($text,$objekat){
        $slug = null;
        $tmp=strtr($text,['Š'=>'s','š'=>'s','Đ'=>'d','đ'=>'d','Č'=>'c','č'=>'c','Ć'=>'c','ć'=>'c','Ž'=>'z','ž'=>'z']);
        $tmp = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $tmp));
        if ($tmp[strlen($tmp) - 1] == '-') $tmp = substr($tmp, 0, strlen($tmp) - 1);
        $i = 0;
        while (!$slug){
            if (!$objekat->where('slug', $tmp . ($i == 0 ? '' : '-' . $i))->exists()) $slug = $tmp . ($i == 0 ? '' : '-' . $i);
            $i++;
        }
        return $slug;
    }

    public static function prosiriLogin(){
        if(Auth::user()->prava_pristupa_id==3){
            Session::put('ordinacija',
                Ordinacija::where('korisnici_id',Auth::user()->id)
                    ->get(['id','naziv','slug','logo','radno_vrijeme','rezervacija_termina',
                        'templejt_id','templejt_slug','grad_id'])->first()->toArray());
            return '/administracija';
        }
        return '/karton';
    }
    public static function ordinacijaID(){
        if(!Session::get('ordinacija.id')) Funkcije::prosiriLogin();
        return Session::get('ordinacija.id');
    }
}