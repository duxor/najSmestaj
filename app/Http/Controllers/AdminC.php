<?php
/*
 * Kontroller AdminC sadrži funkcije koje se koriste za administraciju platforme
 * namijenjene vlasnicima objekata i smještaja
 *
 * */
namespace App\Http\Controllers;

use App\User;
use App\Rezervacija;
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
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use DateTime;

class AdminC extends Controller
{
   public function __construct(){
        $this->middleware('PravaPristupaMid:5,1');
    }
    
    public function getIndex(){
        $gradovi=Grad::lists('naziv','id');
        return view('firmolog.index')->with(['gradovi'=>$gradovi]);
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
    public function postPretraga(Request $request){
        $query=Smestaj::join('objekat','objekat.id','=','smestaj.objekat_id')
            ->leftJoin('rezervacija','rezervacija.smestaj_id','=','smestaj.id')
            ->leftJoin('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->groupby('smestaj.id')
            ->where('objekat.korisnik_id','=',Auth::user()->id);

        $datum_od=substr($request->start_date,0,-13);
        $datum_od=Funkcije::convertDate($datum_od);
        $datum_do=substr($request->start_date,-10);
        $datum_do=Funkcije::convertDate($datum_do);

        $smestaj = $query->get(['smestaj.id','smestaj.naziv','smestaj.cena','vrsta_kapaciteta.broj_osoba','smestaj.slug as slug_smestaj','objekat.naziv as naziv_objekta'])->toArray();
        $smestaj= Funkcije::dostupnostZaRezervaciju($smestaj,$datum_od,$datum_do);
        return json_encode(['smestaj'=>$smestaj,'prijava'=>$datum_od,'odjava'=>$datum_do]);
    }
    public function postRezervacija(Request $request){
        $validator = Validator::make(Input::all(), [
            'ime' => 'required|min:3|max:255',
            'prezime' => 'required|min:3|max:255',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6|max:255',
            'password_confirmation' => 'required|min:6|max:255',
            'telefon'=>'required|numeric'
        ],
            [
                'ime.required'=>'Ime je obavezno za unos.',
                'ime.min'=>'Minimalna dužina je :min.',
                'ime.max'=>'Maksimalna dužina je :max.',
                'prezime.required'=>'Prezime je obavezno za unos.',
                'prezime.min'=>'Minimalna dužina je :min.',
                'prezime.max'=>'Maksimalna dužina je :max.',
                'password.required'=>'Korisnička šifra je obavezna za unos.',
                'password.min'=>'Minimalna dužina korisničke šifre je :min.',
                'password.max'=>'Maksimalna dužina korisničke šifre je :max.',
                'password.confirmed'=>'Unesene šifre se ne poklapaju.',
                'password.max'=>'Maksimalna dužina korisničke šifre je :max.',
                'password_confirmation.required'=>'Potvrda korisničke šifra je obavezna.',
                'email.required'=>'E-mail je obavezan za unos.',
                'email.email'=>'Unesite ispravnu E-mail adresu.',
                'telefon.required'=>'Telefon je obavezan za unos.',
                'telefon.numeric'=>'Telefon mora biti broj.',
            ]);
        if($validator->fails()){
            return json_encode(['neuspesno'=>'Neuspešna registracija i rezervacija!','validator'=>$validator->errors()->all()]);
        } else{
            $user=User::create([
                'ime'=>Input::get('prezime'),
                'prezime'=>Input::get('ime'),
                'username' => Input::get('username'),
                'password' => bcrypt(Input::get('password')),
                'email' => Input::get('email'),
                'adresa'=>Input::get('adresa'),
                'telefon'=>Input::get('telefon'),
                'prava_pristupa_id'=>2,
                'grad_id'=>Input::get('grad'),
                'confirmed'=>1
            ]);
            $korisnik_id= $user->id;
            $rezervacija=Rezervacija::create([
                'korisnik_id'=>$korisnik_id,
                'smestaj_id'=>Input::get('smestajID'),
                'broj_osoba'=>3,
                'datum_prijave' =>Funkcije::convertDate(Input::get('datum_prijave')),
                'datum_odjave' => Funkcije::convertDate(Input::get('datum_odjave'))
            ]);

            return  json_encode(['uspesno'=>'Usešna prijava i rezervacija!']);
        }
    }
}


