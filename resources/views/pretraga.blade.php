<?php
    if(!isset($korisnik['ime']))$korisnik['ime']=null;
    if(!isset($korisnik['prezime']))$korisnik['prezime']=null;
    if(!isset($korisnik['email']))$korisnik['email']=null;
    if(!isset($pretraga)) $pretraga=[];
?>
@extends('master')
@section('body')
<div class="container-fluid">
    <div class=" col-sm-3">
        {!!Form::open(['url'=>'/pretraga','class'=>'form-horizontal pretragaForm'])!!}
        <div class="row">
            <div class="form-group has-icon-left form-control-name">
                <label class="sr-only" for="inputNaziv">Naziv</label>
                <input type="text" class="form-control form-control-lg" id="inputNaziv" placeholder="Naziv" name="naziv" value="{{isset($pretraga['naziv'])?$pretraga['naziv']:null}}">
            </div>
            {{---GRAD--}}
            <div class="form-group has-icon-left form-control-email">
                <label class="sr-only" for="inputGrad">Grad</label>
                {!!Form::select('grad', $gradovi, isset($pretraga['grad'])?$pretraga['grad']:null, ['id'=>'inputGrad','class'=>'form-control form-control-lg','placeholder'=>'Izaberi grad'])!!}
            </div>
            {{---DATUM-PRIJAVE--}}
            <div class="form-group has-icon-left form-control-email">
                <label class="sr-only" for="inputPrijava">Datum prijave</label>
                <input type="text" class="form-control form-control-lg datepicker" id="inputPrijava" placeholder="Datum prijave" name="datum_prijave1" value="{{isset($pretraga['datum_prijave'])?$pretraga['datum_prijave']:null}}">
            </div>
            {{---DATUM-ODJAVE--}}
            <div class="form-group has-icon-left form-control-email">
                <label class="sr-only" for="inputOdjava">Datum odjave</label>
                <input type="text" class="form-control form-control-lg datepicker" id="inputOdjava" placeholder="Datum odjave" name="datum_odjave1" value="{{isset($pretraga['datum_odjave'])?$pretraga['datum_odjave']:null}}">
            </div>
            {{---BOJ-OSOBA--}}
            <div class="form-group has-icon-left form-control-name">
                <label class="sr-only" for="inputBrojosoba">Broj osoba</label>
                {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],isset($pretraga['broj_osoba'])?$pretraga['broj_osoba']:null,['id'=>'inputBrojosoba','class'=>'form-control form-control-lg','placeholder'=>'Broj osoba'])!!}
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <h2>Svrha</h2>
                @foreach($svrha_putovanja as $svrha)
                    <div class="form-group">
                        <label class="c-input c-checkbox">
                            <input type="checkbox" data-tag="{{$svrha['id']}}">
                            <span class="c-indicator"></span> {{$svrha['naziv']}}</a>
                        </label>
                    </div>
                @endforeach
            </div>
            <div class="col-sm-6">
                <h2>Dodaci</h2>
                <div class="form-group">
                    <label class="c-input c-checkbox">
                        <input type="checkbox" data-dodatak="bazen">
                        <span class="c-indicator"></span> Bazen</a>
                    </label>
                </div>
                <div class="form-group">
                    <label class="c-input c-checkbox">
                        <input type="checkbox" data-dodatak="restoran">
                        <span class="c-indicator"></span> Restoran</a>
                    </label>
                </div>
                <div class="form-group">
                    <label class="c-input c-checkbox">
                        <input type="checkbox" data-dodatak="teretana">
                        <span class="c-indicator"></span> Teretana</a>
                    </label>
                </div>
                <div class="form-group">
                    <label class="c-input c-checkbox">
                        <input type="checkbox" data-dodatak="fitnes">
                        <span class="c-indicator"></span> Fitnes</a>
                    </label>
                </div>
            </div>
        </div>
        <br clear="all">
        <br clear="all">
        {!!Form::hidden('tagovi')!!}
        {!!Form::hidden('dodaci')!!}
        <button class="btn btn-secondary-outline m-b-2" role="button"><span class="pull-xs-left icon-search"></span>Pronađi!</button>
        {!!Form::close()!!}
    </div>
    {!! Html::style('/css/datetimepicker.css') !!}
    <div class="col-sm-9">
        @if(isset($smestaj))
            @foreach($smestaj as $sm)
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="/img/default/smestaj.jpg" alt="{{$sm['naziv_smestaja']}}">
                        <div class="caption">
                            <h3><a href="/{{$sm['slug_objekat']}}/{{$sm['slug_smestaj']}}">{{$sm['naziv_smestaja']}}</a></h3>
                            <p>
                                Objekat: <a href="/{{$sm['slug_objekat']}}">{{$sm['naziv_objekta']}}</a><br>
                                Grad: {{$sm['naziv_grada']}}<br>
                                Kapacitet: {{$sm['naziv_kapaciteta']}}
                                @if($sm['dodaci']) <br>Dodaci: {{$sm['dodaci']}} @endif
                            </p>
                            <p>
                                <button
                                        class="btn btn-info m"
                                        data-toggle="modal"
                                        data-target="#rezervacija"
                                        data-id="{{$sm['id']}}"
                                        data-naziv_objekta="{{$sm['naziv_objekta']}}"
                                        data-dodaci="{{$sm['dodaci']}}"
                                        data-broj_osoba="{{$sm['broj_osoba']}}"
                                        data-naziv_kapaciteta="{{$sm['naziv_kapaciteta']}}"
                                        data-naziv_smestaja="{{$sm['naziv_smestaja']}}">
                                    <span class="glyphicon glyphicon-check"></span> Rezerviši!
                                </button>
                                @if(Auth::check())
                                    <button type="button" class="btn btn-{{$sm['zelja']?'danger':'info'}} _tooltip zelja" @if($sm['zelja']) data-zelja="{{$sm['zelja']}}" title="Izbaci iz liste zelja" @else data-zelja="false" title="Dodaj u listu želja" @endif
                                    data-zid="{{$sm['id']}}" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></button>
                                @else
                                    <a  href="/login" class="btn btn-info _tooltip" title="Dodaj u listu želja" data-toggle="tooltip" data-placement="bottom">
                                        <i class="glyphicon glyphicon-heart"></i>
                                    </a>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h3>Nema rezultata za dati upit</h3>
        @endif
            <div class="modal fade" id="uspesna_rezervacija" tabindex="-1" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-bodya">
                            <br>
                            <h3 style="text-align:center"><i class="glyphicon glyphicon-edit" style="font-size: 100%"></i> Uspešno izvršena rezervacija</h3>
                        </div>
                        <div class="modal-footer">
                            <div id="foot" class="form-group">
                                {!! Form::button('<span class="glyphicon glyphicon-remove"></span> Zatvori',['class'=>'btn btn-lg btn-warning','data-dismiss'=>'modal']) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="rezervacija" tabindex="-1" role="dialog" >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <span class="close" data-dismiss="modal" style="position: absolute;right: 20px;cursor:
pointer;font-weight: bold;font-size:40px;top:-10px">&times;</span>
                            <h3 style="text-align:center"><i class="glyphicon glyphicon-edit" style="font-size: 100%"></i> Rezerviši smestaj</h3>
                        </div>
                        <div class="modal-body">
                            <div id="container-fluid">
                                <div id="forma" class="form-horizontal">
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!!Form::hidden('id_smestaja',null,['id'=>'id_smestaja'])!!}
                                            {{---DATUM-PRIJAVE--}}
                                            <div class="form-group has-icon-left form-control-email">
                                                <label class="sr-only" for="inputPrijava">Datum prijave</label>
                                                <input type="text" class="form-control form-control-lg datepicker" id="inputPrijava1" placeholder="Datum prijave" name="datum_prijave" value="{{isset($pretraga['datum_prijave'])?$pretraga['datum_prijave']:null}}">
                                            </div>
                                            {{---DATUM-ODJAVE--}}
                                            <div class="form-group has-icon-left form-control-email">
                                                <label class="sr-only" for="inputOdjava">Datum prijave</label>
                                                <input type="text" class="form-control form-control-lg datepicker" id="inputOdjava1" placeholder="Datum odjave" name="datum_odjave" value="{{isset($pretraga['datum_odjave'])?$pretraga['datum_odjave']:null}}">
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <label for="brojosoba" class="col-sm-3 control-label">Br.osoba:</label>
                                                    {!!Form::select('broj_osoba',[],null,['id'=>'brojosoba','class'=>'form-control'])!!}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if(!Auth::check())
                                                <div id="izlogovan">
                                                    <a id="imam_nalog_btn" value='hide/show' class="btn btn-lg btn-default _tooltip" title="Ulogujte se" data-toggle="tooltip" ><i class="glyphicon glyphicon-user"></i>&nbsp Imam nalog</a>
                                                    <a id="reg_btn" value='hide/show' class="btn btn-lg btn-default _tooltip" title="Registrujte se" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-registration-mark"></i>&nbsp Nisam registrovan</a>
                                                </div>
                                            @else
                                                <div id="ulogovan">
                                                    {!! Form::label('imel','Ime')!!}: <span id="lime">{{$korisnik['ime']}}</span> <br>
                                                    {!! Form::label('prezimel','Prezime')!!}: <span id="lprezime">{{$korisnik['prezime']}}</span> <br>
                                                    {!! Form::label('emaill','Email')!!}: <span id="lemail">{{$korisnik['email']}}</span> <br>
                                                </div>
                                            @endif
                                            <div id="lulogovan">
                                                {!! Form::label('ime','Ime')!!}: <span id="lime"></span><br>
                                                {!! Form::label('ime','Prezime')!!}: <span id="lprezime"></span><br>
                                                {!! Form::label('ime','Email')!!}: <span id="lemail"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div id="imam_nalog">
                                        <div class="col-sm-12 form-horizontal mt30">
                                            <div id="greskaLogin"></div>
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">E-Mail Adresa</label>
                                                <div class="col-md-6">
                                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Password</label>
                                                <div class="col-md-6">
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <div class="checkbox">
                                                        <label>
                                                            <input type="checkbox" name="remember"> Zapamti me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button id="login" class="btn btn-primary">
                                                        <i class="fa fa-btn fa-sign-in"></i>Prijava
                                                    </button>
                                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Zaboravili ste password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="reg" class="col-sm-12 mt30 form-horizontal">
                                        <div class="col-sm-4">{!!Form::label('ime', 'Ime:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::text('ime',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                        <div class="col-sm-4">{!!Form::label('prezime', 'Prezime:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Unesite prezime'])!!}</div>

                                        <div class="col-sm-4">{!!Form::label('email', 'E-mail:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::email('email1',null,['class'=>'form-control','placeholder'=>'Unesite e-mail adresu'])!!}</div>

                                        <div class="col-sm-4">{!!Form::label('password', 'Šifra:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'Unesite šifru'])!!}</div>

                                        <div class="col-sm-4">{!!Form::label('password_confirmation', 'Potvrda šifre:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::password('password_confirmation',['id'=>'password_confirmation','class'=>'form-control','placeholder'=>'Potvrdite šifru'])!!}</div>

                                        <div class="col-sm-4">{!!Form::label('adresa', 'Adresa:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu'])!!}</div>

                                        <div class="col-sm-4">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon'])!!}</div>

                                        <div class="col-sm-4">{!!Form::label('grad','Grad:')!!}</div>
                                        <div class="col-sm-8 form-group">{!!Form::select('grad',$gradovi,1,['id'=>'gradr','class'=>'form-control','placeholder'=>'Izaberite grad'])!!}</div>

                                        <div class="col-sm-12"><div id="poruka_neuspesna_reg"></div></div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button id="register" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-sign-in"></i>Register
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="foot" class="form-group">
                                {!! Form::button('<span class="glyphicon glyphicon-remove"></span> Otkaži',['class'=>'btn btn-lg btn-warning','data-dismiss'=>'modal']) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-ok"></span> Rezerviši',['id'=>'rezervisi','class'=>'btn btn-lg btn-success' ]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<figure id="demo_video" hidden></figure>
@endsection
@section('end-script')

    <style>
        #imam_nalog,#reg,#lulogovan{display:none}
        .mt30{margin-top:30px}
    </style>
    <script>
        var __token='{{csrf_token()}}';
    </script>
    <script src="/templejt/master/js/min/pretraga.js"></script>
@endsection