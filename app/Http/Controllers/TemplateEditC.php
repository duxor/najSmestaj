<?php

namespace App\Http\Controllers;

use App\UpotrebaTemplejta;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Ordinacija;

class TemplateEditC extends Controller{
    public function postOsnovniIzgledAzurirajLogo(){
        $imgPath='img/'.Session::get('ordinacija.slug');
        if(!is_dir($imgPath)) mkdir($imgPath);
        $imgPath.='/';
        if(!is_dir($imgPath)) mkdir($imgPath);
        $foto=null;
        if(Input::hasFile('logo'))
            if(Input::file('logo')->isValid()){
                $foto=Session::get('ordinacija.slug').'_logo.'.Input::file('logo')->getClientOriginalExtension();
                Input::file('logo')->move(
                    $imgPath,
                    $foto
                );
                $foto='/'.$imgPath.'/'.$foto;
            }
        if($foto){
            Ordinacija::where('id',Session::get('ordinacija.id'))->update(['logo'=>$foto]);
        }
        return Redirect::back();
    }
    public function postOsnovniIzgledAzurirajOnamafoto(){
        $imgPath='img/'.Session::get('ordinacija.slug');
        if(!is_dir($imgPath)) mkdir($imgPath);
        $imgPath.='/';
        if(!is_dir($imgPath)) mkdir($imgPath);
        $foto=null;
        if(Input::hasFile('onamaimg'))
            if(Input::file('onamaimg')->isValid()){
                $foto=Session::get('ordinacija.slug').'_onama.'.Input::file('onamaimg')->getClientOriginalExtension();
                Input::file('onamaimg')->move(
                    $imgPath,
                    $foto
                );
                $foto='/'.$imgPath.'/'.$foto;
            }
        if($foto){
            $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
            $templejt->o_nama->img=$foto;
            UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        }
        return Redirect::back();
    }
    public function postOsnovniIzgledAzurirajClanatimaimg(){
        $imgPath='img/'.Session::get('ordinacija.slug');
        if(!is_dir($imgPath)) mkdir($imgPath);
        $imgPath.='/';
        if(!is_dir($imgPath)) mkdir($imgPath);
        $foto=null;
        if(Input::hasFile('clantima'))
            if(Input::file('clantima')->isValid()){
                $foto=Session::get('ordinacija.slug').round(microtime(true)*1000).'_clan.'.Input::file('clantima')->getClientOriginalExtension();
                Input::file('clantima')->move(
                    $imgPath,
                    $foto
                );
                $foto='/'.$imgPath.'/'.$foto;
            }
        if($foto){
            $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
            $index=Input::get('index');
            $templejt->nas_tim->lica[$index]->img=$foto;
            UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        }
        return Redirect::back();
    }
    public function postOsnovniIzgledAzurirajSlajderimg(){
        $imgPath='img/'.Session::get('ordinacija.slug');
        if(!is_dir($imgPath)) mkdir($imgPath);
        $imgPath.='/';
        if(!is_dir($imgPath)) mkdir($imgPath);
        $foto=null;
        if(Input::hasFile('slajderFoto'))
            if(Input::file('slajderFoto')->isValid()){
                $foto=Session::get('ordinacija.slug').round(microtime(true)*1000).'_slajder.'.Input::file('slajderFoto')->getClientOriginalExtension();
                Input::file('slajderFoto')->move(
                    $imgPath,
                    $foto
                );
                $foto='/'.$imgPath.'/'.$foto;
            }
        if($foto){
            $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
            $index=Input::get('index');
            if(isset($templejt->slajder[$index])) $templejt->slajder[$index]->img=$foto;
            else $templejt->slajder[$index]=['img'=>$foto, 'title'=>'', 'subtitle'=>''];
            UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        }
        return Redirect::back();
    }
    public function postOsnovniIzgledDodajNoviSlajd(){
        $imgPath='img/'.Session::get('ordinacija.slug');
        if(!is_dir($imgPath)) mkdir($imgPath);
        $imgPath.='/';
        if(!is_dir($imgPath)) mkdir($imgPath);
        $foto=null;
        if(Input::hasFile('noviSlajdImg'))
            if(Input::file('noviSlajdImg')->isValid()){
                $foto=Session::get('ordinacija.slug').round(microtime(true)*1000).'_slajder.'.Input::file('noviSlajdImg')->getClientOriginalExtension();
                Input::file('noviSlajdImg')->move(
                    $imgPath,
                    $foto
                );
                $foto='/'.$imgPath.'/'.$foto;
            }
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        array_push($templejt->slajder,['img'=>$foto, 'title'=>Input::get('noviNaslov'), 'subtitle'=>Input::get('noviPodnaslov')]);
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return Redirect::back();
    }
    public function postOsnovniIzgledDodajNovogClanatima(){
        $imgPath='img/'.Session::get('ordinacija.slug');
        if(!is_dir($imgPath)) mkdir($imgPath);
        $imgPath.='/';
        if(!is_dir($imgPath)) mkdir($imgPath);
        $foto=null;
        if(Input::hasFile('imgNovogClana'))
            if(Input::file('imgNovogClana')->isValid()){
                $foto=Session::get('ordinacija.slug').round(microtime(true)*1000).'_clantima.'.Input::file('imgNovogClana')->getClientOriginalExtension();
                Input::file('imgNovogClana')->move(
                    $imgPath,
                    $foto
                );
                $foto='/'.$imgPath.'/'.$foto;
            }
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        array_push($templejt->nas_tim->lica,['img'=>$foto, 'ime'=>Input::get('ime')]);
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return Redirect::back();
    }


    public function postOsnovniIzgledAzurirajNaslov(){
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        $naslov=Input::get('koji_naslov');
        $templejt->$naslov->title=Input::get('naslov');
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return;
    }
    public function postOsnovniIzgledAzurirajTekst(){
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        $naslov=Input::get('koji_content');
        $templejt->$naslov->content=Input::get('content');
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return;
    }
    public function postOsnovniIzgledAzurirajClanatimaime(){
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        $index=Input::get('index');
        if(!sizeof($templejt->nas_tim->lica)){
            $templejt->nas_tim->lica[$index]=['img'=>'','ime'=>Input::get('ime')];
        }else
            $templejt->nas_tim->lica[$index]->ime=Input::get('ime');
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return;
    }
    public function postOsnovniIzgledAzurirajKontaktNaslov(){
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        $naslov=Input::get('koji_naslov')==1?'informacije':'ostavite_poruku';
        $templejt->kontakt->$naslov=Input::get('naslov');
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return;
    }
    public function postOsnovniIzgledAzurirajSlajderTxt(){
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        $naslov=Input::get('koji_naslov')==1?'title':'subtitle';
        $index=Input::get('index');
        $templejt->slajder[$index]->$naslov=Input::get('naslov');
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return;
    }


    public function postOsnovniIzgledUkloniSlajd(){
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        $index=Input::get('index');
        $slajdovi=[];
        foreach($templejt->slajder as $i=>$slajd)
            if($i!=$index) array_push($slajdovi,$slajd);
        $templejt->slajder=$slajdovi;
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return;
    }
    public function postOsnovniIzgledUkloniClanatima(){
        $templejt=json_decode(UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->get(['podaci'])->first()->podaci);
        $index=Input::get('index');
        $clanovi=[];
        foreach($templejt->nas_tim->lica as $i=>$clan)
            if($i!=$index) array_push($clanovi,$clan);
        $templejt->nas_tim->lica=$clanovi;
        UpotrebaTemplejta::where('ordinacija_id',Session::get('ordinacija.id'))->where('templejt_id',Session::get('ordinacija.templejt_id'))->update(['podaci'=>json_encode($templejt)]);
        return;
    }
}
