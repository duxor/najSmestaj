<?php

namespace App\Http\Controllers;
/*
|--------------------------------------------------------------------------
| Kontroler administracija sajta
|--------------------------------------------------------------------------
|
| Sadrži sve metode koje se koriste za administriranje pojedinačnih
| sajtova tj. ličnih prezentacija pojedine zubarske ordinacije. Ne
| sadrži metode za prikaz elemenata sajta.
|
| Session::get('ordinacija.id')
|
*/
use App\Funkcije;
use App\Ordinacija;
use App\UpotrebaTemplejta;
use App\User as Korisnici;
use App\Rezervacija;
use App\Usluga;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Templejt;
use Illuminate\Support\Facades\Session;

class AdministracijaSajtaC extends Controller{
    public function __construct(){
        $this->middleware('PravaPristupaMid:3,1');//ZA ZUBARE 3
        $this->middleware('auth');
    }
    public function getIndex(){
        /*foreach(Ordinacija::get(['id','x','y','z']) as $ordinacija)
            Ordinacija::where('id',$ordinacija->id)->update(['x'=>'44.'.rand(0,999),'y'=>'20.'.rand(0,999),'z'=>12]);*/

        $usluge=Usluga::where('ordinacija_id',Funkcije::ordinacijaID())->lists('naziv','id');
        $izgled=Templejt::lists('naziv','id');
        $mojTemplejt=Ordinacija::mojTemplejt();
        return view('zubar.index')->with(compact('usluge','izgled','mojTemplejt'));
    }
    public function postIndexInit(){
        return Ordinacija::radnoVrijeme();
    }
    public function anyNeradniDani(){
        if(Input::has('neradni_dani')) Ordinacija::neradniDani(Input::get('neradni_dani'));
        return view('zubar.neradni-dani')->with('neradni_dani',Ordinacija::neradniDani());
    }
    public function postRadnoVrijemeSacuvaj(){
        return Ordinacija::radnoVrijeme(Input::get('radno_vrijeme'));
    }
    public function anyUsluge(Request $request){
        if(Input::has('podaci')) return Usluga::ucitaj(Input::get('podaci'));
        if ($request->ajax() || $request->wantsJson()) return Usluga::ucitaj();
        return view('zubar.usluge');
    }
    public function postUslugaUkloni(){
        return Usluga::ukloni(Input::get('id'));
    }
    public function postRezervacijeUcitaj(){
        return Rezervacija::ucitaj();
    }
    /*
     * pacijent:{
     *      id: ?int,
     *      ime: 'string',
     *      prezime: 'string',
     *      email: 'string',
     *      password: 'string',
     *      telefon: 'string'
     * },
     * rezervacija:{
     *      usluga_idevi: array(),
     *      termin: 'string'
     * }
     *
     * */
    public function postRezervacija(){
        $id=Input::get('idPacijenta');
        if(!$id){
            $pacijent=Input::get('pacijent');
            $test=Korisnici::provjeriUnos($pacijent);
            if(sizeof($test)) return json_encode($test);
            $pacijent['password']=bcrypt($pacijent['password']);
            $pacijent['prava_pristupa_id']=2;
            $pacijent['grad_id']=Session::get('ordinacija.grad_id');
            $id=Korisnici::insertGetId($pacijent);
        }
        $rezervacija=Input::get('rezervacija');
        $rezervacija['korisnici_id']=$id;
        $rezervacija['usluga_idevi']=json_encode($rezervacija['usluga_idevi']);
        $rezervacija['ordinacija_id']=Session::get('ordinacija.id');
        return Rezervacija::insertGetId($rezervacija);
    }
    /*
     * @ulaz
     * ::id (rezervacije)
     * */
    public function postRezervacijaPonisti(){
        Rezervacija::
            where('id',Input::get('id'))
            ->whereNull('dijagnoza')
            ->update(['dijagnoza'=>'Rezervacija je otkazana od strane zubara','ocena'=>-1]);
        return;
    }
    /*
     * @ulaz
     * ::id (rezervacije)
     * ::termin
     * */
    public function postRezervacijaPromijeniTermin(){
        Rezervacija::
            where('id',Input::get('id'))
            ->update(['termin'=>Input::get('termin')]);
        return;
    }
    /*
     * @ulaz
     * ::id (rezervacije)
     * ::dijagnoza
     * */
    public function postRezervacijaDijagnoza(){
        Rezervacija::
            where('id',Input::get('id'))
            ->update(['dijagnoza'=>Input::get('dijagnoza'),'ocena'=>1]);
        return;
    }
    /*
     * @ulaz
     * ::email
     * ::pin
     * */
    public function postRezervacijaPronadjiPacijenta(){
        return json_encode(Korisnici::where('email',Input::get('email'))->where('pin',Input::get('pin'))->get(['id','prezime','ime'])->first());
    }
    public function getGalerija(){
        return view('zubar.galerija');
    }
    public function postGalerijaUcitajFoto(){
        return Ordinacija::find(Session::get('ordinacija.id'),['galerija'])->galerija;
    }
    public function postGalerijaUkloniFoto(){
        $galerija=json_decode(Ordinacija::find(Session::get('ordinacija.id'),['galerija'])->galerija);
        $novaGalerija=[];
        foreach($galerija as $foto){
            $test=true;
            foreach(json_decode(Input::get('fotosi')) as $i=>$f){
                if($f==$foto){
                    $test=false;
                    unlink(substr($foto, 1));
                    break;
                }
            }
            if($test) array_push($novaGalerija,$foto);
        }
        Ordinacija::where('id',Session::get('ordinacija.id'))->update(['galerija'=>json_encode($novaGalerija)]);
        return json_encode($novaGalerija);
    }
    public function postGalerijaDodajFoto(){
        $ordinacijaSlug='slug';
        $imgPath='img/galerija';
        if(!is_dir($imgPath)) mkdir($imgPath);
        $imgPath.='/'.$ordinacijaSlug;
        if(!is_dir($imgPath)) mkdir($imgPath);
        $foto=null;
        if(Input::hasFile('slike'))
            if(Input::file('slike')[0]->isValid()){
                $foto=round(microtime(true)*1000).'_galerijska_'.$ordinacijaSlug.'.'.Input::file('slike')[0]->getClientOriginalExtension();
                Input::file('slike')[0]->move(
                    $imgPath,
                    $foto
                );
                $foto='/'.$imgPath.'/'.$foto;
            }
        if($foto){
            $galerija=Ordinacija::find(Session::get('ordinacija.id'),['galerija'])->galerija;////////ID
            $galerija=json_decode($galerija)!=null?json_decode($galerija):[];
            array_push($galerija, $foto);
            Ordinacija::where('id',Session::get('ordinacija.id'))->update(['galerija'=>json_encode($galerija)]);
        }
        return ['ok'];
    }
    /*
     * @out
     * ::zarada:[
     *      ::period['01.2016','02.2016',...],
     *      ::zarada[15600,19852,24001,...],
     * ]
     *
     * */
    public function getFinansijskiPregled(){
        $ordinacijaID=Session::get('ordinacija.id');
        $termini=Rezervacija::where('ordinacija_id',$ordinacijaID)
            ->whereNotNull('dijagnoza')
            ->where('ocena',1)
            ->groupBy('mjesec')
            ->groupBy('godina')
            ->orderBy('godina')
            ->orderBy('mjesec')
            ->get([DB::raw('MONTH(termin) as mjesec'),DB::raw('YEAR(termin) as godina')]);
        $usluge=Usluga::where('ordinacija_id',$ordinacijaID)->lists('cena','id')->toArray();
        $zarada=['period'=>[],'zarada'=>[]];
        foreach($termini as $termin){
            $zaradaTmp=0;
            $rezervacije=Rezervacija::where('ordinacija_id',$ordinacijaID)
                ->whereNotNull('dijagnoza')
                ->where('ocena',1)
                ->where('termin','LIKE',$termin['godina'].'-'.str_pad($termin['mjesec'], 2, '0',STR_PAD_LEFT).'-%')
                ->get(['usluga_idevi']);
            foreach($rezervacije as $rezervacija)
                if(json_decode($rezervacija->usluga_idevi)!=null)
                    foreach(json_decode($rezervacija->usluga_idevi) as $uslugaId)
                        $zaradaTmp+=$usluge[$uslugaId];
            array_push($zarada['period'], str_pad($termin['mjesec'], 2, '0',STR_PAD_LEFT).'.'.$termin['godina'].'.');
            array_push($zarada['zarada'], $zaradaTmp);
        }
        $zarada=['period'=>json_encode($zarada['period']),'zarada'=>json_encode($zarada['zarada'])];
        return view('zubar.zarada')->with(compact('zarada'));
    }
    public function postDizajn(){
        return Ordinacija::podesiTemplejt(Input::get('dizajn'));
    }
    public function getEditTemplejt(){
        $ordinacija=Ordinacija::join('grad as g','g.id','=','grad_id')
            ->where('ordinacija.id',Funkcije::ordinacijaID())
            ->get(['ordinacija.id','ordinacija.naziv','slug','logo','radno_vrijeme','neradni_dani','email','telefon','fax','adresa','galerija','ordinacija.x','ordinacija.y','ordinacija.z','facebook','twitter','skype','rezervacija_termina','templejt_id','templejt_slug','g.naziv as grad'])->first();
        $usluge=Usluga::where('ordinacija_id',1)->lists('naziv','id');
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',$ordinacija->id)->where('templejt_id',$ordinacija->templejt_id)->get(['podaci'])->first()->podaci);
        if(isset($templejt->galerija->img)){
            $templejt->galerija->img=[];
            if($ordinacija->galerija)
                foreach(json_decode($ordinacija->galerija) as $img)
                    array_push($templejt->galerija->img, $img);
        }
        $edit=1;
        return view('prezenter.'.$ordinacija->templejt_slug)->with(compact('slug','usluge','ordinacija','templejt','edit'));
    }
    public function postDrustveneMreze(){
        return Ordinacija::where('id',Funkcije::ordinacijaID())->update([Input::get('koja_mreza')=>Input::get('url')]);
    }
    public function postMapaSacuvajLokaciju(){
        return Ordinacija::where('id',Funkcije::ordinacijaID())->update(['x'=>Input::get('x'),'y'=>Input::get('y'),'z'=>Input::get('z')]);
    }
    public function getIzgledSajta(){
        return view('zubar.izgled-sajta');
    }
    public function getOsnovnaPodesavanja(){
        $ordinacija=Ordinacija::find(Session::get('ordinacija.id'),['logo','email','telefon','fax','adresa','x','y','z','facebook','twitter','skype','rezervacija_termina','grad_id']);
        return view('zubar.osnovna-podesavanja')->with(compact('ordinacija'));
    }
}
