<?php

namespace App\Http\Controllers;

use App\Objekat;
use App\Smestaj;
use Illuminate\Http\Request;

use App\Http\Requests;

class PrezenterC extends Controller{
    public function getIndex($slug,$slug2=null){
        if($slug2){ if(!sizeof($podaci=Smestaj::where('slug',$slug2)->get()->first())) return view('errors.503'); }
        if(method_exists($this,$slug)) return $this->$slug();
        if(!sizeof($podaci=Objekat::where('slug',$slug)->get()->first())) return view('errors.503');
        return view($slug2?'smestaj':'objekat')->with(compact('podaci'));
    }
    public function test(){
        
    }
}
