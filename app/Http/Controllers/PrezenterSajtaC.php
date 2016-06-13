<?php

namespace App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Kontroler prezenter sajta
|--------------------------------------------------------------------------
|
| Sadrži sve metode koje se koriste za prikaz pojedinačnih sajtova
| tj. ličnih prezentacija pojedine zubarske ordinacije. Ne sadrži
| metode za izmenu i administriranje istih.
|
*/
use App\Ordinacija;
use App\UpotrebaTemplejta;
use Illuminate\Http\Request;
use App\Usluga;
use App\Http\Requests;
use App\Rezervacija;
use Illuminate\Support\Facades\Input;

class PrezenterSajtaC extends Controller{
    public function getIndex($slug){
        $ordinacija=Ordinacija::join('grad as g','g.id','=','grad_id')
            ->where('slug',$slug)
            ->get(['ordinacija.id','ordinacija.naziv','slug','logo','radno_vrijeme','neradni_dani','email','telefon','fax','adresa','galerija','ordinacija.x','ordinacija.y','ordinacija.z','facebook','twitter','skype','rezervacija_termina','templejt_id','templejt_slug','g.naziv as grad'])->first();
        if(!$ordinacija) return view('errors.503');
        $usluge=Usluga::where('ordinacija_id',1)->lists('naziv','id');
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',$ordinacija->id)->where('templejt_id',$ordinacija->templejt_id)->get(['podaci'])->first()->podaci);
        if(isset($templejt->galerija->img)){
            $templejt->galerija->img=[];
            if($ordinacija->galerija)
                foreach(json_decode($ordinacija->galerija) as $img)
                    array_push($templejt->galerija->img, $img);
        }
        return view('prezenter.'.$ordinacija->templejt_slug)->with(compact('slug','usluge','ordinacija','templejt'));
    }
    public function postRezervacijeUcitaj($slug){
        $rezervacije=Rezervacija::join('korisnici as k','k.id','=','rezervacija.korisnici_id')
            ->join('ordinacija as o','o.id','=','rezervacija.ordinacija_id')
            ->where('o.slug',$slug)
            ->where(function($query){
                $query->whereNull('ocena')->orWhere('ocena','>',-1);
            })
            ->get(['rezervacija.id','usluga_idevi as usluga','termin','dijagnoza'])->toArray();
        $usluge=Usluga::join('ordinacija as o','o.id','=','usluga.ordinacija_id')
            ->where('o.slug',$slug)
            ->lists('usluga.naziv','usluga.id')
            ->toArray();
        foreach($rezervacije as $i=>$rezervacija){
            $rezervacije[$i]['dijagnoza']=$rezervacije[$i]['dijagnoza']?1:0;
            $rezervacije[$i]['usluga']='';
            foreach(json_decode($rezervacija['usluga']) as $uslugaID)
                $rezervacije[$i]['usluga'].=(strlen($rezervacije[$i]['usluga'])>0?',':'').$usluge[$uslugaID];
        }
        return json_encode([
            'rezervacije'=>$rezervacije,
            'nerad'=>$this->zabranjenaRezervacijaSati()
        ]);
    }
    /*
     * JS: [Nedelja, Ponedeljak, Utorak, Srijeda, Četvrtak, Petak, Subota]
     * DS: [Ponedeljak, Utorak, Srijeda, Četvrtak, Petak, Subota, Nedelja]
     */
    private function zabranjenaRezervacijaSati(){
        $ordinacijaID=1;
        $radnoVrijeme=json_decode(Ordinacija::find($ordinacijaID,['radno_vrijeme'])->toArray()['radno_vrijeme']);
        $neradniDani=[];
        $neradniCasovi=[[],[],[],[],[],[],[]];
        for($i=0;$i<7;$i++){
            $index=($i+1)%7;
            $test=true;
            foreach($radnoVrijeme as $vrijeme){
                $vrijeme->vrijeme=[
                    explode(':', $vrijeme->vrijeme[0]),
                    explode(':', $vrijeme->vrijeme[1])
                ];
                $vrijeme->vrijeme=[
                    (int)$vrijeme->vrijeme[0][0],
                    (int)$vrijeme->vrijeme[1][0],
                ];
                if(sizeof($vrijeme->opseg)==2){
                    if($i>=$vrijeme->opseg[0] && $i<=$vrijeme->opseg[1]){
                        $neradniCasovi[$index]=$this->neradniSat($vrijeme->vrijeme);
                        $test=false;
                    }
                }
                else if($i==$vrijeme->opseg[0]){
                    $neradniCasovi[$index]=$this->neradniSat($vrijeme->vrijeme);
                    $test=false;
                }
            }
            if($test) array_push($neradniDani, $index);
        }
        return [
            'dani'=>$neradniDani,
            'casovi'=>$neradniCasovi
        ];
    }
    private function neradniSat($vrijeme){
        $neradniCasovi=[];
        for($i=0;$i<23;$i++)
            if($i<$vrijeme[0] || $i>=$vrijeme[1])
                array_push($neradniCasovi, $i);
        return $neradniCasovi;
    }
    public function postPosaljiPoruku($slug){
        if(Input::get('ime') && Input::get('email') && Input::get('telefon') && Input::get('poruka')){
            $podaci=Input::all();
            /*Mail::send('emails.kontakt-zubara', $podaci, function($message) use($podaci,$slug){
                $message->to(Ordinacija::where('slug',$slug)->get(['email'])->first()->email)
                    ->subject('Kontakt sa sajta');
            });*/
            return json_encode(['check'=>1, 'msg'=>'Poruka je uspešno poslata!']);
        }
        return json_encode(['check'=>0, 'msg'=>'Dogodila se greška! Proverite podatke i pokušajte ponovo!']);
    }
}
