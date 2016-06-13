<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UpotrebaTemplejta extends Model{
    protected $table='upotreba_templejta';
    protected $fillable=['podaci','templejt_id','ordinacija_id'];

    public static function generisiDefaultPodatke($target_templejt_id=1,$ordinacija_id=null){
        if(!$ordinacija_id) $ordinacija_id=\App\Funkcije::ordinacijaID();
        if($target_templejt_id==1)
            $podaci=json_encode([
                'slajder'=>[
                    ['img'=>'/templejt/osnovni-izgled/img/slide-one.jpg', 'title'=>'jer smo najbolji', 'subtitle'=>'Sačuvaj svoj osmeh'],
                    ['img'=>'/templejt/osnovni-izgled/img/slide-two.jpg', 'title'=>'jer smo najbolji', 'subtitle'=>'Sačuvaj svoj osmeh'],
                    ['img'=>'/templejt/osnovni-izgled/img/slide-three.jpg', 'title'=>'jer smo najbolji', 'subtitle'=>'Sačuvaj svoj osmeh'],
                    ['img'=>'/templejt/osnovni-izgled/img/slide-four.jpg', 'title'=>'jer smo najbolji', 'subtitle'=>'Sačuvaj svoj osmeh'],
                ],
                'o_nama'=>['title'=>'', 'content'=>'', 'img'=>''],
                'galerija'=>['title'=>'', 'content'=>'', 'img'=>[]],
                'nas_tim'=>['title'=>'', 'content'=>'', 'lica'=>[
                    ['img'=>'/templejt/osnovni-izgled/img/galerija/member1.jpg','ime'=>'Ime Prezime'],
                    ['img'=>'/templejt/osnovni-izgled/img/galerija/member2.jpg','ime'=>'Ime Prezime'],
                    ['img'=>'/templejt/osnovni-izgled/img/galerija/member3.jpg','ime'=>'Ime Prezime'],
                    ['img'=>'/templejt/osnovni-izgled/img/galerija/member4.jpg','ime'=>'Ime Prezime'],
                ] ],
                'kontakt'=>['title'=>'', 'content'=>'', 'informacije'=>'', 'ostavite_poruku'=>'']
            ]);
        else $podaci=json_encode([]);
        return UpotrebaTemplejta::insert([
            ['podaci'=>$podaci,'templejt_id'=>$target_templejt_id,'ordinacija_id'=>$ordinacija_id]
        ]);
    }
}