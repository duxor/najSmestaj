<?php
    if(!isset($korisnik[0]['ime']))$korisnik[0]['ime']=null;
    if(!isset($korisnik[0]['prezime']))$korisnik[0]['prezime']=null;
    if(!isset($korisnik[0]['email']))$korisnik[0]['email']=null;
?>
@extends('master')
@section('body')
<div class="container-fluid">
    <div class=" col-sm-3">
        {!!Form::open(['url'=>'/pretraga','class'=>'form-horizontal pretragaForm'])!!}
        <div class="row">
            <div class="form-group has-icon-left form-control-name">
                <label class="sr-only" for="inputNaziv">Naziv</label>
                <input type="text" class="form-control form-control-lg" id="inputNaziv" placeholder="Naziv" name="naziv">
            </div>
            {{---GRAD--}}
            <div class="form-group has-icon-left form-control-email">
                <label class="sr-only" for="inputGrad">Grad</label>
                {!!Form::select('grad', $gradovi, null, ['id'=>'inputGrad','class'=>'form-control form-control-lg','placeholder'=>'Izaberi grad'])!!}
            </div>
            {{---DATUM-PRIJAVE--}}
            <div class="form-group has-icon-left form-control-email">
                <label class="sr-only" for="inputPrijava">Datum prijave</label>
                <input type="text" class="form-control form-control-lg" id="inputPrijava" placeholder="Datum prijave" name="datum_prijave1">
            </div>
            {{---DATUM-ODJAVE--}}
            <div class="form-group has-icon-left form-control-email">
                <label class="sr-only" for="inputOdjava">Datum prijave</label>
                <input type="text" class="form-control form-control-lg" id="inputOdjava" placeholder="Datum odjave" name="datum_odjave1">
            </div>
            {{---BOJ-OSOBA--}}
            <div class="form-group has-icon-left form-control-name">
                <label class="sr-only" for="inputBrojosoba">Broj osoba</label>
                {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],null,['id'=>'inputBrojosoba','class'=>'form-control form-control-lg','placeholder'=>'Broj osoba'])!!}
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
    {!!Html::script('/js/moment.js')!!}
    {!! Html::script('/js/datetimepicker.js') !!}
    <div class=" col-sm-9">
        @if(isset($smestaj))
            @foreach($smestaj as $sm)
                {{$sm['naziv_objekta']}}{{$sm['naziv_smestaja']}}{{$sm['naziv_kapaciteta']}}{{$sm['dodaci']}}
                <button class="btn btn-sm btn-info m" data-toggle="modal" data-target="#rezervacija" data-id="{{$sm['id']}}"
                        data-naziv_objekta="{{$sm['naziv_objekta']}}"  data-dodaci="{{$sm['dodaci']}}" data-broj_osoba="{{$sm['broj_osoba']}}" data-naziv_kapaciteta="{{$sm['naziv_kapaciteta']}}" data-naziv_smestaja"{{$sm['naziv_smestaja']}}">
                <span class="glyphicon glyphicon-check"></span> Rezervacija</button>
                @if(Auth::check())
                   <button type="button" class="btn btn-sm btn-default _tooltip zelja" @if($sm['zelja'])data-zelja="{{$sm['zelja']}}" style="color:red" title="Izbaci iz liste zelja" @else data-zelja="false" title="Dodaj u listu želja"@endif
                    data-zid="{{$sm['id']}}" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-heart"></i></button>
                @else
                    <a  href="/login" class="btn btn-sm btn-default _tooltip"  title="Dodaj u listu želja" data-toggle="tooltip" data-placement="bottom">
                        <i class="glyphicon glyphicon-heart"></i>
                    </a>
                @endif
                <br>
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
                                                <input type="text" class="form-control form-control-lg" id="inputPrijava1" placeholder="Datum prijave" name="datum_prijave">
                                            </div>
                                            {{---DATUM-ODJAVE--}}
                                            <div class="form-group has-icon-left form-control-email">
                                                <label class="sr-only" for="inputOdjava">Datum prijave</label>
                                                <input type="text" class="form-control form-control-lg" id="inputOdjava1" placeholder="Datum odjave" name="datum_odjave">
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
                                                    <a id="imam_nalog_btn" value='hide/show' class="btn btn-lg btn-default _tooltip"  title="Ulogujte se" data-toggle="tooltip" ><i class="glyphicon glyphicon-user"></i>&nbsp Imam nalog</a>
                                                    <a id="reg_btn"  value='hide/show'class="btn btn-lg btn-default _tooltip"  title="Registrujte se" data-toggle="tooltip" data-placement="bottom"><i class="glyphicon glyphicon-registration-mark"></i>&nbsp Nisam registrovan</a>
                                                </div>
                                            @else
                                                <div id="ulogovan">
                                                    {!! Form::label('imel','Ime')!!}:<div id="lime">{{$korisnik[0]['ime']}}</div> <br>
                                                    {!! Form::label('prezimel','Prezime')!!}: <div id="lprezime">{{$korisnik[0]['prezime']}}</div> <br>
                                                    {!! Form::label('emaill','Email')!!}: <div id="lemail">{{$korisnik[0]['email']}}</div> <br>
                                                </div>
                                            @endif
                                            <div id="lulogovan">
                                                {!! Form::label('ime','Ime')!!}:<div id="lime"></div><br>
                                                {!! Form::label('ime','Prezime')!!}:<div id="lprezime"></div><br>
                                                {!! Form::label('ime','Email')!!}:<div id="lemail"></div>
                                            </div>
                                            <style>
                                                #lulogovan{display:none;}
                                            </style>
                                            <script>
                                                $('#imam_nalog_btn').on('click', function(event) {
                                                    $('#reg').fadeOut();
                                                    $('#imam_nalog').toggle('show');
                                                });
                                                $('#reg_btn').on('click', function(event) {
                                                    $('#imam_nalog').fadeOut();
                                                    $('#reg').toggle('show');
                                                });
                                            </script>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div id="imam_nalog" >
                                        <div class="row">
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">E-Mail Address</label>
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
                                                            <input type="checkbox" name="remember"> Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <button id="login" class="btn btn-primary">
                                                        <i class="fa fa-btn fa-sign-in"></i>Login
                                                    </button>
                                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        #imam_nalog{display:none;}
                                    </style>
                                    <script>
                                        $('#login').on('click', function(event) {
                                            $.post('/pretraga/login',
                                                    {
                                                        _token:'{{csrf_token()}}',
                                                        email:$('input[name=email]').val(),
                                                        password:$('input[name=password]').val(),
                                                    },function(data){
                                                        var rezultati=JSON.parse(data);
                                                        if(rezultati.validator){
                                                            errors = '<div id="poruka"  class="alert alert-danger alert-autocloseable-danger"><ul>';
                                                            $.each( rezultati.validator, function( key, value ) {
                                                                errors += '<li>' + value + '</li>';
                                                            });
                                                            errors += '</ul></div>';
                                                            $( '#poruka_neuspesna_reg' ).html( errors );
                                                            $('#imam_nalog').show();
                                                        }
                                                        if(rezultati.uspesno){
                                                            $('#imam_nalog').hide();
                                                            $(".alert-autocloseable-danger").fadeTo(5000, 500).slideUp(500, function(){
                                                                $(".alert-autocloseable-danger").hide();
                                                            });
                                                            $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">Uspešno logovanje. ..</div>');
                                                            $('#izlogovan').hide();
                                                            $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                                                $(".alert-autocloseable-success").hide();
                                                            });
                                                            $('#lulogovan').toggle('show');
                                                            $('#lime').text(rezultati.korisnik['ime']);
                                                            $('#lprezime').text(rezultati.korisnik['prezime']);
                                                            $('#lemail').text(rezultati.korisnik['email']);
                                                        }
                                                    });
                                            $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                                $(".alert-autocloseable-success").hide();
                                            });

                                        });
                                    </script>
                                    <div id="reg">
                                        <div class="col-sm-12 ">{!!Form::label('ime', 'Ime:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('ime',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('prezime', 'Prezime:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Unesite prezime'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('email', 'E-mail:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('email1',null,['class'=>'form-control','placeholder'=>'Unesite e-mail adresu'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('password', 'Šifra:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'Unesite šifru'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('password_confirmation', 'Potvrda šifre:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::password('password_confirmation',['id'=>'password_confirmation','class'=>'form-control','placeholder'=>'Potvrdite šifru'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('adresa', 'Adresa:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu'])!!}</div>

                                        <div class="col-sm-12 ">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon'])!!}</div>

                                        <div class="col-sm-12">{!!Form::label('grad','Grad:')!!}</div>
                                        <div class="col-sm-12 form-group">{!!Form::select('grad',$gradovi,1,['id'=>'gradr','class'=>'form-control','placeholder'=>'Izaberite grad'])!!}</div>

                                        <div class="col-sm-12"><div id="poruka_neuspesna_reg"></div></div>

                                        <div class="form-group">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button id="register" class="btn btn-primary">
                                                    <i class="fa fa-btn fa-sign-in"></i>Register
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        #reg{display:none;}
                                    </style>
                                    <script>
                                        $('#register').on('click', function(event) {
                                            var password = $("#password").val();
                                            password  = password.replace(/./g, '*');
                                            var password_confirmation = $("#password_confirmation").val();
                                            password_confirmation  = password_confirmation.replace(/./g, '*');
                                            $.post('/pretraga/register',
                                                    {
                                                        _token:'{{csrf_token()}}',
                                                        ime:$('input[name=ime]').val(),
                                                        prezime:$('input[name=prezime]').val(),
                                                        username:$('input[name=username]').val(),
                                                        password:password,
                                                        password_confirmation:password_confirmation,//$('input[name=password_confirmation]').val(),
                                                        email:$('input[name=email1]').val(),
                                                        telefon:$('input[name=telefon]').val(),
                                                        adresa:$('input[name=adresa]').val(),
                                                        grad:$('#gradr').val()
                                                    },function(data){
                                                        var rezultati=JSON.parse(data);
                                                        if(rezultati.validator){
                                                            $( '#poruka_neuspesna_reg' ).empty();
                                                            errors = '<div class="alert alert-danger alert-autocloseable-danger"><ul>';
                                                            $.each( rezultati.validator, function( key, value ) {
                                                                errors += '<li>' + value + '</li>';
                                                            });
                                                            errors += '</ul></div>';
                                                            $( '#poruka_neuspesna_reg' ).append( errors );
                                                        }
                                                        if(rezultati.uspesno){
                                                            $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">Uspešna registracija ...</div>');
                                                            $('#izlogovan').hide();
                                                            $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                                                $(".alert-autocloseable-success").hide();
                                                            });
                                                            $('#reg').hide();
                                                            $('#lulogovan').toggle('show');
                                                            $('#lime').text(rezultati.korisnik[0]['ime']);
                                                            $('#lprezime').text(rezultati.korisnik[0]['prezime']);
                                                            $('#lemail').text(rezultati.korisnik[0]['email']);
                                                        }
                                                    }
                                            );
                                            $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                                $(".alert-autocloseable-success").hide();
                                            });
                                        });
                                    </script>
                                </div></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div id="foot" class="form-group">
                                {!! Form::button('<span class="glyphicon glyphicon-remove"></span> Otkaži',['class'=>'btn btn-lg btn-warning','data-dismiss'=>'modal']) !!}
                                {!! Form::button('<span class="glyphicon glyphicon-ok"></span> Rezerviši',['id'=>'rezervisi','class'=>'btn btn-lg btn-success' ]) !!}
                            </div>
                        </div>
                        <script>
                            $('#rezervisi').on('click', function(event) {
                                $.post('/pretraga/rezervisi',
                                        {
                                            _token:'{{csrf_token()}}',
                                            datum_prijave: $('#inputPrijava1').val(),
                                            datum_odjave: $('#inputOdjava1').val(),
                                            broj_osoba:$('#brojosoba').val(),
                                            id_smestaja:$('#id_smestaja').val(),
                                        },function(data){
                                            var rezultati=JSON.parse(data);
                                            if(rezultati.validator){
                                                $('.modal-body').prepend('<div id="poruka" class="alert alert-danger alert-autocloseable-danger">'+rezultati.validator+'</div>');
                                                $(".alert-autocloseable-danger").fadeTo(5000, 500).slideUp(500, function(){
                                                    $(".alert-autocloseable-danger").hide();
                                                });
                                            }
                                            if(rezultati.uspesno){
                                                $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">'+rezultati.uspesno+'</div>');
                                                $('#izlogovan').hide();
                                                $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                                    $(".alert-autocloseable-success").hide();
                                                });
                                                $('#rezervacija').modal('toggle');
                                                $('#uspesna_rezervacija').modal('toggle');
                                            }
                                        }
                                );
                                $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                    $(".alert-autocloseable-success").hide();
                                });
                            });
                        </script>
                    </div>
                </div>
            </div>
            <script>
                $('#inputPrijava1').datetimepicker();
                $('#inputOdjava1').datetimepicker();
                $('#inputPrijava1').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
                $('#inputOdjava1').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
                $('#inputPrijava').datetimepicker();
                $('#inputOdjava').datetimepicker();
                $('#inputPrijava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
                $('#inputOdjava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
            </script>
            <script>
                $('button.m').click(function(){
                    $('#id_smestaja').val($(this).data('id'));
                    var option = '';
                    for (i=1; i <= $(this).data('broj_osoba'); i++){
                        option += '<option value="'+i+'">'+i+'</option>';
                    }
                    $('#brojosoba').html(option);
                });
                $("button.zelja").click(function(){
                    $(this).css("color","black");
                    var id=$(this).data("zid");
                    $.post('/pretraga/like',
                            {
                                _token:'{{csrf_token()}}',
                                smestaj: $(this).data("zid"),
                                zelja: $(this).data("zelja")
                            },
                            function(data){
                                $('button[data-zid="'+id+'"]').html("<i class='glyphicon glyphicon-heart'></i>");
                                if($('button[data-zid="'+id+'"]').data('zelja')!=false){
                                    $('button[data-zid="'+id+'"]').data('zelja',false);
                                    $('button[data-zid="'+id+'"]').css("color","black");
                                } else{
                                    $('button[data-zid="'+id+'"]').data('zelja',data);
                                    $('button[data-zid="'+id+'"]').css("color","red");
                                }
                            }
                    );
                });
            </script>
    </div>
</div>
@endsection