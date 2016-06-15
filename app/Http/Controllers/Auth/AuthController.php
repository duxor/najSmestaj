<?php

namespace App\Http\Controllers\Auth;

use App\Funkcije;
use App\Ordinacija;
use App\UpotrebaTemplejta;
use App\User;
use Illuminate\Http\Request;
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

            return Validator::make($data, [
                'ime' => 'required|min:3|max:255',
                'prezime' => 'required|min:3|max:255',
                'username' => 'required|min:4|max:255|unique:korisnik',
                'password' => 'required|confirmed|min:6|max:255',
                'email' => 'required|email|max:255|unique:korisnik',
            ], [
                //ime
                'ime.required'=>'Ime je obavezno za unos.',
                'ime.min'=>'Minimalna dužina je :min.',
                'ime.max'=>'Maksimalna dužina je :max.',
                //prezime
                'prezime.required'=>'Prezime je obavezno za unos.',
                'prezime.min'=>'Minimalna dužina je :min.',
                'prezime.max'=>'Maksimalna dužina je :max.',
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
   
        if($data['prava_pristupa_id']==2){ //Obican korisnik



       /*     //Dodavanje slika
            if(isset($data['foto'])) {
                $image = $data['foto'];
                $image_name = $image->getClientOriginalName();
                $image->move('img/korisnici', $image_name);
                $image_final = 'img/korisnici/' . $image_name;
                $int_image = Image::make($image_final);
                $int_image->resize(300, null, function ($promenljiva) {
                    $promenljiva->aspectRatio();
                });
                $int_image->save($image_final);
            }else{
                $image_final ='img/default/slika-korisnika.jpg';
            }
*/

            return User::create([
                'ime'=>$data['prezime'],
                'prezime'=>$data['ime'],
                'username' => $data['username'],
                'password' => bcrypt($data['password']),
                'foto'=>$data['foto'],
                'pol'=>$data['pol_id'],
                'email' => $data['email'],
                'adresa'=>$data['adresa'],
                'telefon'=>$data['telefon'],
                'prava_pristupa_id'=>$data['prava_pristupa_id'],
                'token'=>$data['_token']
            ]);
        }elseif($data['prava_pristupa_id']==5){ //Vlasnik fitme
            dd('vlasnik');
        }else{
            dd('svi ostali'); //Svi ostali
        }
    }
}
