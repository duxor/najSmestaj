<?php

namespace App\Http\Controllers\Auth;

use App\Funkcije;
use App\Http\Controllers\AdminC;
use App\Objekat;
use App\Ordinacija;
use App\UpotrebaTemplejta;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Auth;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $username = 'username';
    protected $redirectTo = '/after-login';
    protected $redirectPath = '/after-login';
    protected $redirectAfterLogout = '/after-logout';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
   protected function validator(array $data){

            return Validator::make($data,
                 [
               //  'ime' => 'required|min:3|max:255',
               //  'prezime' => 'required|min:3|max:255',
                 'username' => 'required|min:4|max:255|unique:korisnik',
                 'password' => 'required|confirmed|min:6|max:255',
                 'email' => 'required|email|max:255|unique:korisnik',
             ], [
                 //ime
             /*    'ime.required'=>'Ime je obavezno za unos.',
                 'ime.min'=>'Minimalna dužina je :min.',
                 'ime.max'=>'Maksimalna dužina je :max.',
                 //prezime
                 'prezime.required'=>'Prezime je obavezno za unos.',
                 'prezime.min'=>'Minimalna dužina je :min.',
                 'prezime.max'=>'Maksimalna dužina je :max.',*/
                 //username
                 'username.required'=>'Korisničko ime je obavezno za unos.',
                 'username.min'=>'Minimalna dužina korisničkog imena je :min.',
                 'username.max'=>'МMaksimalna dužina korisničkog imena je :max.',
                 'username.unique'=>'Navedeno korisničko ime je u upotrebi.',
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
                 'email.unique'=>'Navedeni e-mail je u upotrebui.',
                 'email.max'=>'Maksimalna dužina e-mail-a je :max.',
             ]);
     }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    protected function create(array $data){

       /* $foto = isset($data['foto'])?$data['foto']:$foto = $data['foto1'];
        $foto?$naziv_slike='profilna_'.$foto->getClientOriginalExtension():$naziv_slike='/img/default/korisnik.jpg';
        $foto->move('img/korisnici', $foto);
        $putanja_slike='/img/korisnici/'.$naziv_slike;*/

        //Dodavanje novog korisnika
        $korisnik = User::create([
                'ime'=>$data['prezime'],
                'prezime'=>$data['ime'],
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'foto'=>'$putanja_slike',
                'pol'=>$data['pol_id'],
                'email' => $data['email'],
                'adresa'=>$data['adresa'],
                'telefon'=>$data['telefon'],
                'prava_pristupa_id'=>$data['prava_pristupa_id'],
            ]);
        
        if ($data['prava_pristupa_id']==5){
                //Dodavanje objekta za kreiranok korisnika
                $objekat = new Objekat();
            
                //Provera sluga
                $slug = null;
                $text = $data['naziv'];
                $tmp=strtr($text,['Š'=>'s','š'=>'s','Đ'=>'d','đ'=>'d','Č'=>'c','č'=>'c','Ć'=>'c','ć'=>'c','Ž'=>'z','ž'=>'z']);
                $tmp = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", $tmp));
                if ($tmp[strlen($tmp) - 1] == '-') $tmp = substr($tmp, 0, strlen($tmp) - 1);
                $i = 0;
                while (!$slug){
                    if (!$objekat->where('slug', $tmp . ($i == 0 ? '' : '-' . $i))->exists()) $slug = $tmp . ($i == 0 ? '' : '-' . $i);
                    $i++;
                }

                $objekat->korisnik_id=$korisnik->id;
                //template defaut 1
                $objekat->grad_id = $data['grad_id'];
                $objekat->vrsta_objekta_id = $data['vrsta_objekta_id'];
                $objekat->naziv = $data['naziv'];
                $objekat->slug = $slug;
                $objekat->opis = $data['opis'];
                $objekat->adresa = $data['adresa'];
                $objekat->galerija = 'uradi kasnije';
                $objekat->telefon =$data['telefon'];
                $objekat->email = $data['emailO'];
                $objekat->x = $data['x'];
                $objekat->y = $data['y'];
                $objekat->z = $data['z'];
                $objekat->save();
        }
                return $korisnik;

    }

}




