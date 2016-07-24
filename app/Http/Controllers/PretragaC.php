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
use App\SvrhaPutovanja;

class PretragaC extends Controller
{
    public function getIndex(){
        $svrha_putovanja=SvrhaPutovanja::dajPrioritete();
        $gradovi=Grad::lists('naziv','id');
        $query=Smestaj::join('objekat','objekat.id','=','smestaj.objekat_id')
            ->join('grad','grad.id','=','objekat.grad_id')
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
            ->leftJoin('like',function($query){
                $query->on('like.smestaj_id','=','smestaj.id')
                    ->where('like.korisnik_id','=',Auth::check()?Auth::user()->id:null)->where('like.aktivan','=',1);
            });
        $smestaj = $query->get(['smestaj.id','smestaj.slug as slug_smestaj','objekat.naziv as naziv_objekta','objekat.slug as slug_objekat','vrsta_smestaja.naziv as naziv_smestaja', 'vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.vrsta_kapaciteta_id as broj_osoba','smestaj.dodaci','like.id as zelja', 'grad.naziv as naziv_grada'])->toArray();

        return view('pretraga')->with([
            'smestaj'=>$smestaj,
            'korisnik'=>Auth::check()?Auth::user()->id:null,
            'gradovi'=>$gradovi,
            'svrha_putovanja'=>$svrha_putovanja
        ]);
    }
    public function postIndex(){
        $svrha_putovanja=SvrhaPutovanja::dajPrioritete();
        $query=Smestaj::join('objekat','objekat.id','=','smestaj.objekat_id')
            ->join('grad','grad.id','=','objekat.grad_id')
            ->join('vrsta_kapaciteta','vrsta_kapaciteta.id','=','smestaj.vrsta_kapaciteta_id')
            ->join('vrsta_smestaja','vrsta_smestaja.id','=','smestaj.vrsta_smestaja_id')
            ->leftJoin('like',function($query){
                $query->on('like.smestaj_id','=','smestaj.id')
                    ->where('like.korisnik_id','=',Auth::check()?Auth::user()->id:null)->where('like.aktivan','=',1);
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
        $gradovi=Grad::lists('naziv','id');
        if(Input::get('datum_prijave')!== ''&& Input::get('datum_odjave')!== ''){
            $datum_prijave= Input::get('datum_prijave');
            $datum_odjave= Input::get('datum_odjave');
            $smestaj = $query->get(['smestaj.id','smestaj.slug as slug_smestaj','objekat.naziv as naziv_objekta','objekat.slug as slug_objekat','vrsta_smestaja.naziv as naziv_smestaja','vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.vrsta_kapaciteta_id as broj_osoba','smestaj.dodaci','like.id as zelja', 'grad.naziv as naziv_grada'])->toArray();
            $smestaj= Funkcije::dostupnostZaRezervaciju($smestaj,$datum_prijave,$datum_odjave);
        }else{
            $smestaj = $query->get(['smestaj.id','smestaj.slug as slug_smestaj','objekat.naziv as naziv_objekta','objekat.slug as slug_objekat','vrsta_smestaja.naziv as naziv_smestaja', 'vrsta_kapaciteta.naziv as naziv_kapaciteta','smestaj.vrsta_kapaciteta_id as broj_osoba','smestaj.dodaci','like.id as zelja', 'grad.naziv as naziv_grada'])->toArray();
        }
        return view('pretraga')
            ->with([
                'smestaj'=>$smestaj,
                'korisnik'=>Auth::check()?Auth::user()->toArray():null,
                'gradovi'=>$gradovi,
                'svrha_putovanja'=>$svrha_putovanja,
                'pretraga'=>Input::except('_token')
            ]);
    }
    public function postLike(){
        $smestaj=Input::get('smestaj');
        $zelja=Like::where('korisnik_id',Auth::user()->id)->where('smestaj_id',$smestaj)->get(['id','aktivan'])->first();
        if($zelja){
            $zelja->aktivan=$zelja->aktivan==0?1:0;
            $zelja->save();
            return $zelja->id;
        }else return Like::insertGetId(['smestaj_id'=>$smestaj,'korisnik_id'=>Auth::user()->id]);
    }
    public function postLogin(Request $request){
        $validator = Validator::make($request->all(),
            [
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
            //$user = Auth::user();
            //$pravo_pristupa = $user->prava->id;
            return json_encode(['uspesno'=>'Usešna prijava!','korisnik'=>Auth::user()]);
            /*switch(Auth::user()->prava_pristupa_id ){
                case '2':

                    break;
            }*/
        }
    }
    public function postRegister(){
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
                'password_confirmation.required'=>'Potvrda korisničke šifra je obavezna.',
                'email.required'=>'E-mail je obavezan za unos.',
                'email.email'=>'Unesite ispravnu E-mail adresu.',
                'telefon.required'=>'Telefon je obavezan za unos.',
                'telefon.numeric'=>'Telefon mora biti broj.',
            ]);
        if($validator->fails()){
            return json_encode(['neuspesno'=>'Neuspešna registracija!','validator'=>$validator->errors()->all()]);
        } else{
            $user=User::create([
                'ime'=>Input::get('ime'),
                'prezime'=>Input::get('prezime'),
                'username' => Input::get('username'),
                'password' => bcrypt(Input::get('password')),
                'email' => Input::get('email'),
                'adresa'=>Input::get('adresa'),
                'telefon'=>Input::get('telefon'),
                'prava_pristupa_id'=>2,
                'grad_id'=>Input::get('grad'),
                'confirmed'=>1
            ]);
            $korisnik=User::where('id', $user->id)->get()->first()->toArray();
            Auth::loginUsingId($korisnik['id']);
            return json_encode(['uspesno'=>'Usešna prijava!','korisnik'=>$korisnik]);
        }
    }
    public function postRezervisi(Request $request){
        if(!Auth::check()){
            return  json_encode(['validator'=>'Prvo se ulogujte!!!']);
        }
        if(Input::get('datum_prijave')=='' || Input::get('datum_odjave')==''){
            return json_encode(['validator'=>'Izaberite datum prijave i odjave!']);
        }else{
            $rezervacija=Rezervacija::insertGetId([
                //'korisnik_id'=>Session::get('id'),
                'korisnik_id'=>Auth::user()->id,
                'smestaj_id'=>$request['id_smestaja'],
                'broj_osoba'=>$request['broj_osoba'],
                'datum_prijave' => $request['datum_prijave'],
                'datum_odjave' => $request['datum_odjave'],
            ]);
            return json_encode(['uspesno'=>'Uspešna rezervacija!']);
        }
    }
}
