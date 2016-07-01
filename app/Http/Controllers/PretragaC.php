<?php
//Kontroler PretragaC sadrži funkcije koje su potrebne za pretragu, 
//kreiranje i prikaz liste želja korisnika
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Validator;
use DateTime;
use Illuminate\Support\Facades\Input;
use App\Smestaj;
use App\User;
use App\Grad;
use App\Objekat;
use App\VrstaKapaciteta;
use App\Rezervacija;
use App\VrstaSmestaja;
use App\Like;
use App\Funkcije;

class PretragaC extends Controller
{
    
    public function getIndex(){

        return view('pretraga');
    }
    public function postIndex(){
        if(Auth::check()){
            $korisnik=User::where('id',Session::get('id'))->get()->toArray();
        }else $korisnik=null;
        //return $korisnik;
        $query=Smestaj::join('objekat','objekat.id','=','smestaj.objekat_id')
            //->leftJoin('rezervacija','rezervacija.smestaj_id','=','smestaj.id')
            ->join('grad','grad.id','=','objekat.grad_id')
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
            ->leftJoin('like',function($query){
                $query->on('like.smestaj_id','=','smestaj.id')
                    ->where('like.korisnik_id','=',Session::get('id'))->where('like.aktivan','=',1);
            });
        if(Input::get('naziv')!== ''){
            $query->where('objekat.naziv', 'Like','%'.Input::get("naziv").'%');
        }
        if(Input::get('grad')!== ''){
            $query->where('grad.id', '=',Input::get('grad'));
        }
        if(Input::get('broj_osoba')){
            $query->where('vrsta_kapaciteta.id','>=',Input::get('broj_osoba'));
        }
        if(Input::get('datum_prijave')!== ''&& Input::get('datum_odjave')!== ''){
            $datum_prijave= Input::get('datum_prijave');
            $datum_odjave= Input::get('datum_odjave');
            $smestaj = $query->get(['smestaj.id','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja','vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.dodaci','like.id as zelja'])->toArray();
            $smestaj= Funkcije::dostupnostZaRezervaciju($smestaj,$datum_prijave,$datum_odjave);
            return view('pretraga')->with(['smestaj'=>$smestaj])->with(['korisnik'=>$korisnik]);
        }else{
            $smestaj = $query->get(['smestaj.id','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja',
                'vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.dodaci','like.id as zelja'])->toArray();
            return view('pretraga')->with(['smestaj'=>$smestaj,'korisnik'=>$korisnik]);
        }
    }
    public function postLike(){
        if(Input::get('zelja'))
            if(Input::get('zelja')=="false") {
                $lista=new Like();
                $lista->smestaj_id=Input::get('smestaj');
                $lista->korisnik_id=Session::get('id');
                $lista->save();
                return $lista->id;
            }else return Like::where('id',Input::get('zelja'))->update(['aktivan'=>0]);
    }
    public function getLike(){
        $lista_zelja=Smestaj::where('like.korisnik_id','=',Session::get('id'))
       -> join('objekat','objekat.id','=','smestaj.objekat_id')
            //->join('rezervacija','rezervacija.smestaj_id','=','smestaj.id')
            ->join('grad','grad.id','=','objekat.grad_id')
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
            ->leftJoin('like',function($query){
                $query->on('like.smestaj_id','=','smestaj.id')
                    ->where('like.korisnik_id','=',Session::get('id'))->where('like.aktivan','=',1);
            })->get(['smestaj.id','objekat.naziv as naziv_objekta','vrsta_smestaja.naziv as naziv_smestaja','vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.dodaci','like.id as zelja'])->toArray();

        return view('korisnik.like',compact('lista_zelja'));
    }
    public function postLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required'
        ],
            [
                'email.required'=>'E-mail je obavezan za unos.',
                'email.email'=>'Pogrešno unesen e-mail.',
                'password.required'=>'Korisnička šifra je obavezna za unos.',
            ]
        );
        if($validator->fails()){
            return json_encode(['neuspesno'=>'Neuspešna prijava!','validator'=>$validator->errors()->all()]);
        }
        else{
            $credentials = [
            'email' => $request['email'],
            'password' => $request['password']
            ];
            if(!Auth::attempt($credentials)){
                return json_encode(['validator'=>['Neuspešna prijava! Proverite korisničke podatke!']]);
            }
            $user = Auth::user();
            Session::put('id',Auth::user()->getId());
            $pravo_pristupa = $user->prava->id;

            switch($pravo_pristupa ){
                case '2':
                    return  json_encode(['uspesno'=>'Usešna prijava!','korisnik'=>$user]);
                    break;
            }
        }
    }
    public function postRegister(Request $request){
        $validator = Validator::make($request->all(), [
            'ime' => 'required|min:3|max:255',
            'prezime' => 'required|min:3|max:255',
            'password' => 'required|confirmed|min:6|max:255',
            'password_confirmation' => 'required|min:3',
            'email' => 'required|email|max:255|unique:korisnik',
            'telefon'=>'required'
        ],
            [
                'ime.required'=>'Ime je obavezno za unos.',
                'ime.min'=>'Minimalna dužina je :min.',
                'ime.max'=>'Maksimalna dužina je :max.',

                'prezime.required'=>'Ime je obavezno za unos.',
                'prezime.min'=>'Minimalna dužina je :min.',
                'prezime.max'=>'Maksimalna dužina je :max.',
                //password
                'password.required'=>'Korisnička šifra je obavezna za unos.',
                'password.min'=>'Minimalna dužina korisničke šifre je :min.',
                'password.max'=>'Maksimalna dužina korisničke šifre je :max.',
                'password.confirmed'=>'Unesene šifre se ne poklapaju.',
                //pass_conf
                'password_confirmation.required'=>'Korisnička šifra je obavezna za unos.',
                'password_confirmation.min'=>'Minimalna dužina korisničke šifre je :min.',
                //email
                'email.required'=>'E-mail je obavezan za unos.',
                'email.email'=>'Pogrešno unesen e-mail.',
                'email.unique'=>'Navedeni e-mail je u upotrebi.',
                'email.max'=>'Maksimalna dužina e-mail-a je :max.',
                //
                'telefon.required'=>'Telefon je obavezan za unos.',
            ]);
        if($validator->fails()){
            return json_encode(['neuspesno'=>'Neuspešna registracija!','validator'=>$validator->errors()->all()]);
        } else{
            $user=User::create([
                'ime'=>$request['prezime'],
                'prezime'=>$request['ime'],
                'username' => $request['username'],
                'password' => bcrypt($request['password']),
                'email' => $request['email'],
                'adresa'=>$request['adresa'],
                'telefon'=>$request['telefon'],
                'prava_pristupa_id'=>2,
            ]);

            $korisnik=User::where('id', $user->id)->get()->toArray();
            return  json_encode(['uspesno'=>'Usešna prijava!','korisnik'=>$korisnik]);
        }

    }
    public function postRezervisi(Request $request){
        if(!Auth::check()){
            return  json_encode(['validator'=>'Prvo se ulogujte!!!']);
        }
        if($request['datum_prijave']=='' || $request['datum_odjave']==''){
            return  json_encode(['validator'=>'Izaberite datum prijave i odjave!']);
        }else{
            $rezervacija=Rezervacija::create([
                'korisnik_id'=>Session::get('id'),
                'smestaj_id'=>$request['id_smestaja'],
                'broj_osoba'=>$request['broj_osoba'],
                'datum_prijave' => $request['datum_prijave'],
                'datum_odjave' => $request['datum_odjave'],
            ]);
            return  json_encode(['uspesno'=>'Uspešna rezervacija!']);
        }


    }
}
