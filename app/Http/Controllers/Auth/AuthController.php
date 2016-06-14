<?php

namespace App\Http\Controllers\Auth;

use App\Funkcije;
use App\Ordinacija;
use App\UpotrebaTemplejta;
use App\User;
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
  /*  protected function validator(array $data){
        $validArray=[
            [
                'email' => 'required|email|max:255|unique:korisnici',
                'password' => 'required|min:6|confirmed',
            ],
            [
                'email.required' => 'Polje email je obavezno za unos!',
                'email.email' => 'Email koji ste uneli nije validan!',
                'email.max' => 'Maksimalna dužina emaila je :max!',
                'email.unique' => 'Navedeni email već postoji u evidenciji!',
                'password.required' => 'Šifra je obavezna za unos!',
                'password.min' => 'Šifra mora da ima minimum :min karaktera!',
                'password.confirmed' => 'Unesene šifre se ne poklapaju!',
            ]
        ];
        if($data['zubar_pacijent']==3){
            $validArray[0]['naziv'] = 'required|max:255';
            $validArray[1]['naziv.required'] = 'Naziv ordinacije je obavezan za unos!';
            $validArray[1]['naziv.max'] = 'Dužina naziva ne može biti iznad :max!';
        }else{
            $validArray[0]['ime'] = 'required|max:255';
            $validArray[1]['ime.required'] = 'Ime je obavezno za unos!';
            $validArray[1]['ime.max'] = 'Dužina imena ne može biti iznad :max!';
            $validArray[0]['prezime'] = 'required|max:255';
            $validArray[1]['prezime.required'] = 'Prezime je obavezno za unos!';
            $validArray[1]['prezime.max'] = 'Dužina prezimena ne može biti iznad :max!';
        }

        return Validator::make($data, $validArray[0], $validArray[1]);

    }*/

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
   /* protected function create(array $data){
        $zubar=$data['zubar_pacijent']==3;
        unset($data['_token']);
        unset($data['password_confirmation']);
        $podaci=['korisnik'=>[],'ordinacija'=>[]];
        if($zubar){
            $polja=[
                'korisnik'=>
                    ['ime','prezime','password','email','pin','bio','telefon','grad_id','prava_pristupa_id','foto','galerija','confirmed','confirmation_code'],
                'ordinacija'=>
                    ['naziv','slug','logo','radno_vrijeme','neradni_dani','email','telefon','fax','adresa','galerija','x','y','z','facebook','twitter','skype','rezervacija_termina','templejt_id','templejt_slug','grad_id']
            ];
            foreach($data as $i=>$d){
                if(in_array($i, $polja['korisnik']) && $d) $podaci['korisnik'][$i]=$d;
                if(in_array($i, $polja['ordinacija']) && $d) $podaci['ordinacija'][$i]=$d;
            }
        }else $podaci['korisnik']=$data;
        $podaci['korisnik']['prava_pristupa_id'] = $data['zubar_pacijent'];
        $podaci['korisnik']['confirmation_code'] = str_random(30);
        $podaci['korisnik']['password']=bcrypt($podaci['korisnik']['password']);

        $korisnik=User::create($podaci['korisnik']);
        if($podaci['ordinacija']){
            $podaci['ordinacija']['korisnici_id']=$korisnik->id;
            $podaci['ordinacija']['slug']=Funkcije::kreirajSlug($podaci['ordinacija']['naziv'], new Ordinacija());
            $prazan=json_encode([]);
            $podaci['ordinacija']['radno_vrijeme']=$prazan;
            $podaci['ordinacija']['neradni_dani']=$prazan;
            UpotrebaTemplejta::generisiDefaultPodatke(1,Ordinacija::insertGetId($podaci['ordinacija']));
        }
        Mail::send('auth.emails.verify', ['verification'=>$podaci['korisnik']['confirmation_code']], function($message) use($data) {
            $message->to($data['email'])
                ->subject('Verifikujte Vašu email adresu');
        });
        return $korisnik;
    }
    protected function authenticated($request,$user){
        Funkcije::prosiriLogin();
        return redirect()->intended($this->redirectPath());
    }*/
}
