<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ordinacija extends Model{
    protected $table='ordinacija';
    protected $fillable=['naziv','slug','logo','radno_vrijeme','neradni_dani','email','telefon','fax','adresa','galerija','x','y','z','facebook','twitter','skype','rezervacija_termina','korisnici_id','templejt_id','templejt_slug','grad_id'];

    public static function dajPodatak($podatak){
        return Ordinacija::find(Funkcije::ordinacijaID(),$podatak);
    }
    public static function radnoVrijeme($update=null){
        if(!$update) return Ordinacija::dajPodatak(['radno_vrijeme'])->radno_vrijeme;
        Ordinacija::where('id',Funkcije::ordinacijaID())->update(['radno_vrijeme'=>$update]);
    }
    public static function neradniDani($update=null){
        if(!$update) return Ordinacija::dajPodatak(['neradni_dani'])->neradni_dani;
        return Ordinacija::where('id',Funkcije::ordinacijaID())->update(['neradni_dani'=>$update]);
    }
    public static function podesiTemplejt($update){
        $ordinacijaID=Funkcije::ordinacijaID();
        $id=UpotrebaTemplejta::where('ordinacija_id',$ordinacijaID)->where('templejt_id',$update)->get(['id']);
        if($id) $id=$id->first()->id;
        else UpotrebaTemplejta::generisiDefaultPodatke();
        return Ordinacija::where('id',$ordinacijaID)->update(['templejt_id'=>$update,'templejt_slug'=>Templejt::find($update,['slug'])->slug]);
    }
    public static function mojTemplejt(){
        return Ordinacija::dajPodatak(['templejt_id'])->templejt_id;
    }
}