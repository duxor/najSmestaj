<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usluga extends Model{
    protected $table='usluga';
    protected $fillable=['naziv','opis','vreme_realizacije','cena','ordinacija_id'];

    public static function ucitaj($update=null){
        $ordinacijaID=Funkcije::ordinacijaID();
        if(!$update) return json_encode(Usluga::where('ordinacija_id',$ordinacijaID)->get(['id','naziv','opis','vreme_realizacije','cena']));
        $podaci=$update;
        if($podaci['id']){
            $id=$podaci['id'];
            unset($podaci['id']);
            Usluga::where('ordinacija_id',$ordinacijaID)->where('id',$id)->update($podaci);
        }else{
            $podaci=array_merge($podaci,['ordinacija_id'=>$ordinacijaID]);
            return Usluga::insertGetId($podaci);
        }
        return null;
    }
    public static function ukloni($id){
        return Usluga::where('ordinacija_id',Funkcije::ordinacijaID())->where('id',$id)->delete();
    }
}