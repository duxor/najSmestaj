<?php if(!isset($korisnik)) $korisnik=null; ?>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">  <ul class="nav nav-tabs" role="tablist" id="myTabs">
                            <li role="presentation" class="active"><a href="#home" aria-controls="korisnik" role="tab" data-toggle="tab">Korisnik</a></li>
                            <li role="presentation"><a href="#profile" aria-controls="vlasnik" role="tab" data-toggle="tab">Vlasnik</a></li>
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
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="col-sm-12">
                                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                                        {!! csrf_field() !!}

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
                                    </form>
                                </div>
                            </div>

                            {{--Registracija vlasnika--------------------------------------}}
                            <div role="tabpanel" class="tab-pane" id="profile">..asda.
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
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