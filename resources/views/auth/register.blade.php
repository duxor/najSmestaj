<?php if(!isset($korisnik)) $korisnik=null; ?>

@extends('layouts.app')
@section('content')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <ul class="nav nav-tabs" id="myTab">
                                <li class="active"><a href="#tab1default" data-toggle="tab">Registracija korisnika</a></li>
                                <li><a href="#tab2default" data-toggle="tab">Registracija vlasnika</a></li>
                                <li role="presentation"><a href="/login">Prijava</a></li>
                                <li role="presentation"><a href="/password/reset">Oporavak šifre</a></li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                Појавио се проблем приликом покушаја регистрације, проверите следеће:<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            <div class="tab-content">

                            {{--Registracija korisnika--------------------------------------}}
                                <div class="tab-pane fade in active" id="tab1default">
                                <div class="col-sm-12">
                                    {!! Form::open(['url'=>'/register','class'=>'form-horizontal']) !!}


                                        {!! Form::hidden('prava_pristupa_id',2) !!}
                                        {!! Form::hidden('foto_pomocna',$korisnik ? $korisnik->foto : '') !!}

                                        <div class="col-sm-12 ">{!!Form::label('ime', 'Ime:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('ime',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('prezime', 'Prezime:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Unesite prezime'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('email', 'E-mail:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Unesite e-mail adresu'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('username', 'Korisničko ime:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('username',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('password', 'Šifra:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::password('password',['class'=>'form-control','placeholder'=>'Unesite šifru'])!!}</div>
                                        <div class="col-sm-12 ">{!!Form::label('password_confirmation', 'Potvrda šifre:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Potvrdite šifru'])!!}</div>

                                        <div class="col-sm-12 form-group"><h4>Pol: Muški {!! Form::radio('pol_id','1',1)!!} Ženski {!! Form::radio('pol_id','2')!!}</h4></div>

                                        <div class="col-sm-4">
                                            <img id="slika" alt="Slika" class="img-rounded"  width="250" height="250" @if(isset($takmicar['foto'])) src="{{$takmicar['foto']}}" @else src="/img/default/korisnik.jpg" @endif onclick="unesiFoto()">
                                            {!!Form::file('foto',['onchange'=>'prikaziFoto1(this)','style'=>'display:none'])!!}
                                        </div>

                                        <div class="col-sm-12 ">{!!Form::label('adresa', 'Adresa:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon'])!!}</div>

                                        <div class="col-sm-12" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
                                    {!! Form::close() !!}
                                </div>
                            </div>

                            {{--Registracija vlasnika--------------------------------------}}
                                <div class="tab-pane fade" id="tab2default">
                                    <div class="col-sm-12">
                                        {!! Form::open(['url'=>'/register','class'=>'form-horizontal']) !!}

                                            {!! Form::hidden('prava_pristupa_id',5) !!}
                                            {!! Form::hidden('foto_pomocna',$korisnik ? $korisnik->foto : '') !!}

                                            <div class="col-sm-2 ">{!!Form::label('ime', 'Ime:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('ime',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('prezime', 'Prezime:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Unesite prezime'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('email', 'E-mail:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Unesite e-mail adresu'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('username', 'Korisničko ime:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('username',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('password', 'Šifra:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::password('password',['class'=>'form-control','placeholder'=>'Unesite šifru'])!!}</div>
                                            <div class="col-sm-2 ">{!!Form::label('password_confirmation', 'Potvrda šifre:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Potvrdite šifru'])!!}</div>

                                            <div class="col-sm-6 form-group"><h4>Pol: Muški {!! Form::radio('pol_id','1',1)!!} Ženski {!! Form::radio('pol_id','2')!!}</h4></div>

                                            <div class="col-sm-6">
                                                <img id="slika" alt="Slika" class="img-rounded"  width="250" height="250" @if(isset($takmicar['foto'])) src="{{$takmicar['foto']}}" @else src="/img/default/korisnik.jpg" @endif onclick="unesiFoto()">
                                                {!!Form::file('foto',['onchange'=>'prikaziFoto1(this)','style'=>'display:none'])!!}
                                            </div>

                                            <div class="col-sm-2 ">{!!Form::label('adresa', 'Adresa:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon'])!!}</div>

                                            <h3 align="center">Podaci o objektu</h3>

                                            <div class="col-sm-2 ">{!! Form::label('grad',"Grad", ['class'=>'col-md-4 control-label']) !!}</div>
                                            <div class="col-md-10 form-group">{!!Form::select('grad_id',$gradovi,1,['class'=>'form-control'])!!}</div>

                                            <div class="col-sm-2 ">{!! Form::label('vrsta_objekta',"Vrsta objekta", ['class'=>'col-md-4 control-label']) !!}</div>
                                            <div class="col-md-10 form-group">{!!Form::select('vrsta_objektaid',$vrste_objekta,1,['class'=>'form-control'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('naziv', 'Naziv:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('naziv',null,['class'=>'form-control','placeholder'=>'Unesite naziv objekta'])!!}</div>

                                             <div class="col-sm-2 ">{!!Form::label('opis', 'Opis:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::textarea('opis',null,['class'=>'form-control','placeholder'=>'Unesite opine podatke'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('adresaO', 'Adresa:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('adresaO',null,['class'=>'form-control','placeholder'=>'Unesite adresu objekta'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('telefonO', 'Kontakt telefon:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('telefonO',null,['class'=>'form-control','placeholder'=>'Unesite telefon objekta'])!!}</div>

                                            <div class="col-sm-2 ">{!!Form::label('emailO', 'E-mail:')!!}</div>
                                            <div class="col-sm-10 form-group">{!!Form::text('emailO',null,['class'=>'form-control','placeholder'=>'Unesite e-mail objekta'])!!}</div>




                                            <div class="col-sm-12" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        //Funkcija za obradu slika
        function unesiFoto(){$('[name=foto]').click()}
        function prikaziFoto1(fotoFajl){
            if (fotoFajl.files && fotoFajl.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#slika').attr('src',e.target.result);
                }
                reader.readAsDataURL(fotoFajl.files[0]);
            }
        }

    </script>

@endsection