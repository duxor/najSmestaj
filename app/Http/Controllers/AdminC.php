<?php
/*Kontroller AdminC sadrži funkcije koje se koriste za administraciju platforme*/
namespace App\Http\Controllers;

use App\Grad;
use App\Objekat;
use App\Smestaj;
use App\VrstaKapaciteta;
use App\VrstaObjekta;
use App\VrstaSmestaja;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminC extends Controller
{
   public function __construct(){
        $this->middleware('PravaPristupaMid:5,1');
    }
    
    public function getIndex(){
        return view('firmolog.index');
    }

    //Prikaz forme za dodavanje i azuriranje objekata
    public function getObjekat($slug = null){
        $objekat = null;
        $gradovi=Grad::lists('naziv','id');
        $vrste_objekta=VrstaObjekta::lists('naziv','id');
        $slug?$objekat = Objekat::where('slug', $slug)->get()->first():$objekat = null;
        return view('firmolog.objekat')->with('gradovi',$gradovi)->with('vrste_objekta',$vrste_objekta)->with('objekat',$objekat);
    }

    //Prikaz svuh objekata
    public function getObjekti(){
        $objekti =  DB::table('objekat')
            ->join('grad', 'objekat.grad_id','=','grad.id')
            ->join('vrsta_objekta', 'objekat.vrsta_objekta_id','=','vrsta_objekta.id')
            ->where('objekat.korisnik_id','=',Auth::user()->id)
            ->select('objekat.id as id','grad.naziv as grad', 'vrsta_objekta.naziv as vrsta_objekta','objekat.naziv',
                'objekat.opis', 'objekat.adresa','objekat.telefon', 'objekat.email','objekat.x','objekat.y','objekat.z')
            ->get();
        return view('firmolog.objekti')->with('objekti', $objekti);
    }

    //Prikaz forme za dodavanje i azuriranje smestaja
    public function getSmestaj($slug = null){
        $slug?$smestaj = Smestaj::where('slug', $slug)->get()->first():$smestaj = null;
        $objekat = Objekat::lists('naziv','id');
        $vrsta_smestaja = VrstaSmestaja::lists('naziv','id');
        $vrsta_kapaciteta = VrstaKapaciteta::lists('naziv','id');
        return view('firmolog.smestaj')->with('smestaj',$smestaj)->with('vrsta_smestaja',$vrsta_smestaja)
            ->with('vrsta_kapaciteta',$vrsta_kapaciteta)->with('objekat',$objekat);
    }

    //Prikaz svuh smestaja odredjenog objekta
    public function getSmestaji($slug = null){
        $objekat =  DB::table('objekat')
            ->join('grad', 'objekat.grad_id','=','grad.id')
            ->join('vrsta_objekta', 'objekat.vrsta_objekta_id','=','vrsta_objekta.id')
            ->where('objekat.slug','=',$slug)
            ->select('objekat.id as id', 'objekat.naziv as naziv','grad.naziv as grad', 'vrsta_objekta.naziv as vrsta_objekta')//dodati sta sve treba
            ->first();
        $smestaji = DB::table('smestaj')
            ->join('objekat', 'smestaj.objekat_id','=', 'objekat.id')
            ->join('vrsta_smestaja', 'smestaj.vrsta_smestaja_id','=', 'vrsta_smestaja.id')
            ->join('vrsta_kapaciteta', 'smestaj.vrsta_kapaciteta_id','=', 'vrsta_kapaciteta.id')
            ->where('objekat.slug', '=', $slug)
            ->select('smestaj.id as id', 'smestaj.slug as slug', 'vrsta_smestaja.naziv as vrsta_smestaja',
                'vrsta_kapaciteta.naziv as vrsta_kapaciteta')
           ->get();
        return view('firmolog.smestaji')->with('smestaji',$smestaji)->with('objekat', $objekat);
    }

    //Dodavanje i azuriranje objekata
    public function postObjekat(Request $request){

      $objekat = $request->id?Objekat::where('id', $request->id)->get()->first():new Objekat();

        if(!$request->id){
            $slug = null;
            $text = $request->naziv;
            $tmp=strtr($text,['Š'=>'s','š'=>'s','Đ'=>'d','đ'=>'d','Č'=>'c','č'=>'c','Ć'=>'c','ć'=>'c','Ž'=>'z','ž'=>'z']);
            $tmp = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $tmp));
            if ($tmp[strlen($tmp) - 1] == '-') $tmp = substr($tmp, 0, strlen($tmp) - 1);
            $i = 0;
            while (!$slug){
                if (!Objekat::where('slug', $tmp . ($i == 0 ? '' : '-' . $i))->exists()) $slug = $tmp . ($i == 0 ? '' : '-' . $i);
                $i++;
            }
        }

        //template defaut 1
        $objekat->korisnik_id = Auth::user()->id;
        $objekat->grad_id = $request->grad_id;
        $objekat->vrsta_objekta_id = $request->vrsta_objekta_id;
        $objekat->naziv = $request->naziv;
        if(!$request->id)$objekat->slug = $slug;
        $objekat->opis = $request->opis;
        $objekat->adresa = $request->adresa;
        $objekat->galerija = 'uradi kanije';
        $objekat->telefon = $request->telefon;
        $objekat->email = $request->email;
        $objekat->x = $request->x;
        $objekat->y = $request->y;
        $objekat->z = $request->z;

        $request->id?$objekat->update():$objekat->save();

        return $this->getObjekti();
    }

    //Dodavanje i azuriranje objekata
    public function postSmestaj(Request $request){

        $smestaj = $request->id?Smestaj::where('id', $request->id)->get()->first():new Smestaj();

        if(!$request->id){
            $slug = null;
            $text = $request->naziv;
            $tmp=strtr($text,['Š'=>'s','š'=>'s','Đ'=>'d','đ'=>'d','Č'=>'c','č'=>'c','Ć'=>'c','ć'=>'c','Ž'=>'z','ž'=>'z']);
            $tmp = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $tmp));
            if ($tmp[strlen($tmp) - 1] == '-') $tmp = substr($tmp, 0, strlen($tmp) - 1);
            $i = 0;
            while (!$slug){
                if (!Smestaj::where('slug', $tmp . ($i == 0 ? '' : '-' . $i))->exists()) $slug = $tmp . ($i == 0 ? '' : '-' . $i);
                $i++;
            }
        }

        //template defaut 1
        $smestaj->objekat_id = $request->objekat_id;
        $smestaj->vrsta_smestaja_id = $request->vrsta_smestaja_id;
        $smestaj->vrsta_kapaciteta_id = $request->vrsta_kapaciteta_id;
        $smestaj->dodaci = $request->dodaci;
        $smestaj->naziv = $request->naziv;
        if(!$request->id)$smestaj->slug = $slug;


        $request->id?$smestaj->update():$smestaj->save();

        $objekat = Objekat::where('id', $smestaj->objekat_id)->get()->first();
        return $this->getSmestaji($objekat->slug);

    }
}


