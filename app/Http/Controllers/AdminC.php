<?php
/*
 * Kontroller AdminC sadrži funkcije koje se koriste za administraciju platforme
 * namijenjene vlasnicima objekata i smještaja
 *
 * */
namespace App\Http\Controllers;

use App\Dodaci;
use App\DodaciUpotreba;
use App\Funkcije;
use App\Grad;
use App\Objekat;
use App\Smestaj;
use App\Templejt;
use App\VrstaKapaciteta;
use App\VrstaObjekta;
use App\VrstaSmestaja;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

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
        $dodaci = Dodaci::all();
        $gradovi=Grad::lists('naziv','id');
        $vrste_objekta=VrstaObjekta::lists('naziv','id');
        $slug?$objekat = Objekat::where('slug', $slug)->get()->first():$objekat = null;
        return view('firmolog.objekat')->with('gradovi',$gradovi)->with('vrste_objekta',$vrste_objekta)
            ->with('objekat',$objekat)->with('dodaci',$dodaci);
    }

    //Prikaz svuh objekata
    public function getObjekti(){
        $objekti =  DB::table('objekat')
            ->join('grad', 'objekat.grad_id','=','grad.id')
            ->join('vrsta_objekta', 'objekat.vrsta_objekta_id','=','vrsta_objekta.id')
            ->where('objekat.korisnik_id','=',Auth::user()->id)
            ->select('objekat.id as id','grad.naziv as grad', 'vrsta_objekta.naziv as vrsta_objekta','objekat.naziv',
                'objekat.opis', 'objekat.adresa','objekat.telefon', 'objekat.email','objekat.x','objekat.y','objekat.z',
                'objekat.foto','objekat.aktivan','objekat.slug')
            ->get();
        $i=0;
        foreach ($objekti as $id=>$objekat){
          $smestaji_objekta = DB::table('smestaj')
                ->join('objekat', 'smestaj.objekat_id','=', 'objekat.id')
                ->join('vrsta_smestaja', 'smestaj.vrsta_smestaja_id','=', 'vrsta_smestaja.id')
                ->join('vrsta_kapaciteta', 'smestaj.vrsta_kapaciteta_id','=', 'vrsta_kapaciteta.id')
                ->where('objekat.id', '=', $objekat->id)
                ->select('smestaj.id as id','smestaj.objekat_id as objekat_id', 'vrsta_smestaja.naziv as vrsta_smestaja',
                    'vrsta_kapaciteta.naziv as vrsta_kapaciteta', 'smestaj.slug as slug', 'smestaj.naziv as naziv')
                ->get();
            foreach ($smestaji_objekta as $id=>$smestaj){
                $smestaji[$i]['id'] = $smestaj->id;
                $smestaji[$i]['objekat_id'] = $smestaj->objekat_id;
                $smestaji[$i]['vrsta_smestaja'] =$smestaj->vrsta_smestaja;
                $smestaji[$i]['vrsta_kapaciteta'] =$smestaj->vrsta_kapaciteta;
                $smestaji[$i]['slug'] =$smestaj->slug;
                $smestaji[$i]['naziv'] =$smestaj->naziv;
                $i++;
            }
        }
        $smestaji = json_encode($smestaji);
        $smestaji =  json_decode($smestaji);
        return view('firmolog.objekti')->with('objekti', $objekti)->with('smestaji', $smestaji);
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
    //Promena statusa pbjekata
    public function postStatusObjekta(Request $request){
            if ($request->ajax()) {
                $objekat = Objekat::where('slug', $request->slug)->get()->first();
               if ($objekat->aktivan == 1) {
                   $objekat->update(['aktivan' =>0]);
                } elseif ($objekat->aktivan == 0)
                   $objekat->update(['aktivan' =>1]);
            }
        Redirect::back();
        }


    public function getPrikaziDodatke(Request $request){
        if ($request->ajax()) {
            $dodaci = DB::table('dodaci')
                ->join('dodaci_upotreba','dodaci.id','=','dodaci_upotreba.dodaci_id')
                ->where('dodaci_upotreba.objekat_id','=',$request->objekat_id)
                ->whereNull('dodaci.id')
                ->get();
            return json_encode($dodaci);
        }
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
        if(!$request->id)$slug = Funkcije::kreirajSlug($request->naziv,new Objekat());
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

        $dodaci = $request->dodatak;
        foreach ($dodaci as $dodatak) {
           if(!$dodaj_dodatak = DodaciUpotreba::where('dodaci_id',$dodatak)->where('objekat_id',$objekat->id)->first()) {
               $dodaj_dodatak = new DodaciUpotreba();
               $dodaj_dodatak->dodaci_id = $dodatak;
               $dodaj_dodatak->objekat_id = $objekat->id;
               $dodaj_dodatak->save();
           }
        }
        return $this->getObjekti();
    }

    //Dodavanje i azuriranje objekata
    public function postSmestaj(Request $request){
        $smestaj = $request->id?Smestaj::where('id', $request->id)->get()->first():new Smestaj();
        if(!$request->id)$slug = Funkcije::kreirajSlug($request->naziv,new Smestaj());
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

    public function post(){
        return $this->validatesRequestErrorBag;
    }

    public function getTemplejti(){
        return view('firmolog.templejti');
    }
    public function getTemplejt(){
        return view('firmolog.templejt');
    }
    public function getIzmeniSadrzaj($slug=null){
        $slug=Templejt::checkExist($slug);
        return view("firmolog.templejt-izmeni-{$slug}");
    }
}


