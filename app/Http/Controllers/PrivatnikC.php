<?php
/*
 * Kontroller PrivatnikC sadrži metode koje se koriste za funkcionalnosti
 * koje sprovode vlasnici privatnih smještaja (kuća, stanova)
 *
 * */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;


use Session;
use File;
use App\Grad;
use App\Dodaci;
use App\Objekat;
use App\VrstaObjekta;
use App\Poruke;

class PrivatnikC extends Controller{
    public function __construct(){
        $this->middleware('PravaPristupaMid:4,1');
    }
    public function getIndex(){
        $this->makeDir('vila-promaja');
        $slike=[];
        $filesInFolder= \File::Files(public_path().'/galerija/privatnik/vila-promaja');
        $slug=Objekat::where('korisnik_id', Auth::user()->id)->pluck('slug')->first();
        foreach($filesInFolder as $path)
        {
            $infopath = pathinfo($path);
            $slike[]='/galerija/privatnik/'.$slug.'/'.$infopath['basename'];
        }
        $dodaci = Dodaci::all();
        $gradovi=Grad::lists('naziv','id');
        $vrste_objekta=VrstaObjekta::lists('naziv','id');
        $objekat = Objekat::where('korisnik_id', Auth::user()->id)->get()->first();

        //funkcije za obradu poruke
        $poruke['primljenje']=Poruke::join('korisnik as primalac','primalac.id','=','poruke.korisnik_id')
                        ->join('korisnik as sender','sender.id','=','poruke.sender_id')
                       ->where('poruke.korisnik_id',Auth::user()->id)
                       ->orderBy('created_at','DESC')
        ->get(['poruke.id','primalac.ime as primalac_ime','primalac.prezime as primalac_prezime','primalac.id as id_primaoca',
            'sender.ime as sender_ime','sender.prezime as sender_prezime','sender.id as id_sender','poruke.poruka','poruke.procitano','poruke.created_at'])->toArray();
        $arr=[];
        foreach($poruke['primljenje'] as $key =>$value){
            $arr[$value['id_sender']][$value['id']]=$value;
        }
        ksort($arr,SORT_NUMERIC);
        //////////////////////////
        $poruke['poslate']=Poruke::join('korisnik as primalac','primalac.id','=','poruke.korisnik_id')
            ->join('korisnik as sender','sender.id','=','poruke.sender_id')
            ->where('poruke.sender_id',Auth::user()->id)
            ->orderBy('created_at','DESC')
            ->get(['poruke.id','primalac.ime as primalac_ime','primalac.prezime as primalac_prezime','primalac.id as id_primaoca',
                'sender.ime as sender_ime','sender.prezime as sender_prezime','sender.id as id_sender','poruke.poruka','poruke.procitano','poruke.created_at'])->toArray();
        $arr2=[];
        foreach($poruke['poslate'] as $key =>$value){
            $arr2[$value['id_primaoca']][$value['id']]=$value;
        }
        ksort($arr2,SORT_NUMERIC);
        $array=$this->MergeArrays($arr,$arr2);
        ksort($array,SORT_NUMERIC);
        //dd($array);
        //kraj funkcije za obradu poruka
        return view('privatnik.index')->with(['gradovi'=>$gradovi])->with('vrste_objekta',$vrste_objekta)
            ->with('objekat',$objekat)->with('dodaci',$dodaci)->with('slike',$slike)->with('poruke',$array);
    }

    public function MergeArrays($array1, $array2)
    {
        foreach($array2 as $key => $Value)
        {
            if(array_key_exists($key, $array1) && is_array($Value))
                $array1[$key] = $this->MergeArrays($array1[$key], $array2[$key]);
            else
                $array1[$key] = $Value;
        }
        return $array1;
    }

    public function postIndex(Request $request){
        $objekat = $request->id?Objekat::where('id', $request->id)->get()->first():new Objekat();
        if(!$request->id)$slug = Funkcije::kreirajSlug($request->naziv,new Objekat());
        $objekat->korisnik_id = Auth::user()->id;
        $objekat->grad_id = $request->grad_id;
        $objekat->vrsta_objekta_id = $request->vrsta_objekta_id;
        $objekat->naziv = $request->naziv;
        $objekat->opis = $request->opis;
        $objekat->adresa = $request->adresa;
        $objekat->galerija = 'uradi kanije';
        $objekat->telefon = $request->telefon;
        $objekat->email = $request->email;
        $objekat->x = $request->x;
        $objekat->y = $request->y;
        $objekat->z = $request->z;
        $request->id?$objekat->update():$objekat->save();
        return $this->getIndex();
    }
    public function postStatus(Request $request){
        $objekat= Objekat::where('korisnik_id', Auth::user()->id)->get()->first();
        $objekat->aktivan=$request->status;
        $objekat->update();
       return;
    }
    // Funkcija kreira folder za smestaj galerija privatnika.Funkciju pozvati prilikom kreiranja naloga
    public function makeDir($slug){
        $path = public_path().'/galerija/privatnik/'.$slug.'/';
        File::makeDirectory($path, $mode = 0777, true, true);
    }
    public function postDodajSliku(){
        if(File::exists(Input::file('image'))){
            if (Input::file('image')->isValid()) {
                $extension = Input::file('image')->getClientOriginalExtension();
                $fileName = rand(11111,99999).'.'.$extension;
                $dest=base_path() . '/public/galerija/privatnik/vila-promaja';
                Input::file('image')->move($dest, $fileName);
                Session::flash('success', 'Uspešno dodavanje fotografije!');
                return Redirect::back();
            }else {
                Session::flash('error', 'Fajl nije validan!');
                return Redirect::back();
            }
        }else{
            Session::flash('success', 'Izaberite sliku!');
            return Redirect::back();
        }
    }
    public function postSendPrivate(Request $request){
        Poruke::create(['korisnik_id'=>Auth::user()->id,'sender_id'=>$request->id_primaoca,'poruka'=>$request->message]);
        return Redirect::back();
    }
}
