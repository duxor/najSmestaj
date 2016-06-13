<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rezervacija extends Model{
    protected $table='rezervacija';
    protected $fillable=['termin','dijagnoza','dijagnoza_usluge_idevi','ocena','korisnici_id','usluga_idevi','ordinacija_id'];

    public static function ucitaj(){
        $ordinacijaID=Funkcije::ordinacijaID();
        $rezervacije=Rezervacija::join('korisnici as k','k.id','=','rezervacija.korisnici_id')
            ->where('rezervacija.ordinacija_id',$ordinacijaID)
            ->where(function($query){
                $query->whereNull('ocena')->orWhere('ocena','>',-1);
            })
            ->get(['rezervacija.id','ime','prezime','usluga_idevi as usluga','termin','dijagnoza'])->toArray();
        $usluge=Usluga::where('ordinacija_id',$ordinacijaID)
            ->lists('naziv','id')->toArray();
        foreach($rezervacije as $i=>$rezervacija){
            $rezervacije[$i]['dijagnoza']=$rezervacije[$i]['dijagnoza']?1:0;
            $rezervacije[$i]['usluga']='';
            foreach(json_decode($rezervacija['usluga']) as $uslugaID)
                $rezervacije[$i]['usluga'].=(strlen($rezervacije[$i]['usluga'])>0?',':'').(array_key_exists($uslugaID, $usluge)?$usluge[$uslugaID]:'');
        }
        return json_encode($rezervacije);
    }
}