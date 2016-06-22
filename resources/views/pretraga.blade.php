@extends('master')
@section('body')

    @if($smestaj)
        @foreach($smestaj as $sm)
            {{$sm['naziv_objekta']}}{{$sm['naziv_smestaja']}}{{$sm['naziv_kapaciteta']}}{{$sm['dodaci']}}


            <button class="btn btn-sm btn-info m" data-toggle="modal" data-target="#rezervacija" data-id="{{$sm['id']}}"
                    data-naziv_objekta="{{$sm['naziv_objekta']}}"  data-dodaci="{{$sm['dodaci']}}" data-naziv_kapaciteta="{{$sm['naziv_kapaciteta']}}" data-naziv_smestaja"{{$sm['naziv_smestaja']}}">
            <span class="glyphicon glyphicon-check"></span> Rezervacija</button>
            @if(Auth::check())
                <button class="btn btn-sm btn-default _tooltip zelja" @if($sm['zelja'])data-zelja="{{$sm['zelja']}}" style="color:red" title="Izbaci iz liste zelja" @else data-zelja="false" title="Dodaj u listu želja"@endif
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

    <div class="modal fade" id="rezervacija" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 style="text-align:center"><i class="glyphicon glyphicon-edit" style="font-size: 100%"></i> Rezerviši smestaj</h3>
                </div>
                <div class="modal-body">
                    <div id="container-fluid">
                        <div id="forma" class="form-horizontal">
                            <div class="row">
                                <div class="col-md-6">
                                    {!!Form::hidden('id_smestaja',null,['id'=>'id_smestaja'])!!}
                                    <div class="input-group margin5">
                                        <div class="input-daterange input-group col-sm-12">
                                            {!!Form::text('datum_prijave',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Datum prijave'])!!}
                                            <span class="input-group-addon">do</span>
                                            {!!Form::text('datum_odjave',null,['class'=>'form-control','id'=>'datetimepicker2','placeholder'=>'Datum odjave'])!!}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <label for="brojosoba" class="col-sm-3 control-label">Br.osoba:</label>
                                            {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],null,['id'=>'brojosoba','class'=>'form-control'])!!}
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
                                           {!! Form::label('ime','Ime')!!}:<div id="lime">{{$korisnik[0]['ime']}}</div> <br>
                                            {!! Form::label('ime','Prezime')!!}: <div id="lprezime">{{$korisnik[0]['prezime']}}</div> <br>
                                            {!! Form::label('ime','Username')!!}: <div id="lusername">{{$korisnik[0]['username']}}</div> <br>
                                            {!! Form::label('ime','Email')!!}: <div id="lemail">{{$korisnik[0]['email']}}</div> <br>
                                        </div>
                                        @endif
                                        <div id="lulogovan" hidden>
                                            {!! Form::label('ime','Ime')!!}:<div id="lime"></div><br>
                                            {!! Form::label('ime','Prezime')!!}:<div id="lprezime"></div><br>
                                            {!! Form::label('ime','Username')!!}: <div id="lusername"></div><br>
                                            {!! Form::label('ime','Email')!!}:<div id="lemail"></div>
                                        </div>
                                    </div>
                            </div>

                            <div id="imam_nalog" hidden>
                                <div class="row">
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">E-Mail Address</label>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label class="col-md-4 control-label">Password</label>
                                        <div class="col-md-6">
                                            <input type="password" class="form-control" name="password">
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                            @endif
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
                            <script>
                                $('#login').on('click', function(event) {
                                    $('#imam_nalog').toggle('hide');
                                    $.post('/pretraga/login',
                                      {
                                          _token:'{{csrf_token()}}',
                                          email:$('input[name=email]').val(),
                                          password:$('input[name=password]').val(),
                                      },function(data){
                                                var rezultati=JSON.parse(data);
                                                console.log(rezultati);
                                                if(rezultati.validator){
                                                    errors = '<div id="poruka"  class="alert alert-danger alert-autocloseable-danger"><ul>';
                                                    $.each( rezultati.validator, function( key, value ) {
                                                        errors += '<li>' + value + '</li>';
                                                    });
                                                    errors += '</ul></div>';
                                                    $( '.modal-body' ).prepend( errors );
                                                    $(".alert-autocloseable-danger").fadeTo(5000, 500).slideUp(500, function(){
                                                        $(".alert-autocloseable-danger").alert('close');
                                                        $('#imam_nalog').toggle('show');
                                                    });
                                                }
                                                if(rezultati.uspesno){
                                                    $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">Uspešno logovanje. ..</div>');
                                                    $('#izlogovan').hide();
                                                    $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                                        $(".alert-autocloseable-success").alert('close');
                                                    });
                                                    $('#lulogovan').toggle('show');
                                                    $('#lime').text(rezultati.korisnik['ime']);
                                                    $('#lprezime').text(rezultati.korisnik['prezime']);
                                                    $('#lusername').text(rezultati.korisnik['username']);
                                                    $('#lemail').text(rezultati.korisnik['email']);
                                                }
                                            });
                                    $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                        $(".alert-autocloseable-success").alert('close');
                                    });
                                });
                            </script>
                            <div id="reg" hidden>
                                <div class="col-sm-12 ">{!!Form::label('ime', 'Ime:')!!}</div>
                                <div class="col-sm-12 form-group">{!!Form::text('ime',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                <div class="col-sm-12 ">{!!Form::label('prezime', 'Prezime:')!!}</div>
                                <div class="col-sm-12 form-group">{!!Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Unesite prezime'])!!}</div>

                                <div class="col-sm-12 ">{!!Form::label('email', 'E-mail:')!!}</div>
                                <div class="col-sm-12 form-group">{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Unesite e-mail adresu'])!!}</div>

                                <div class="col-sm-12 ">{!!Form::label('password', 'Šifra:')!!}</div>
                                <div class="col-sm-12 form-group">{!!Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=>'Unesite šifru'])!!}</div>

                                <div class="col-sm-12 ">{!!Form::label('password_confirmation', 'Potvrda šifre:')!!}</div>
                                <div class="col-sm-12 form-group">{!!Form::password('password_confirmation',['id'=>'password_confirmation','class'=>'form-control','placeholder'=>'Potvrdite šifru'])!!}</div>

                                <div class="col-sm-12 ">{!!Form::label('adresa', 'Adresa:')!!}</div>
                                <div class="col-sm-12 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu'])!!}</div>

                                <div class="col-sm-12 ">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                                <div class="col-sm-12 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon'])!!}</div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button id="register" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i>Register
                                        </button>
                                    </div>
                                </div>
                            </div>
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
                                                password_confirmation:$('input[name=password_confirmation]').val(),
                                                email:$('input[name=email]').val(),
                                                telefon:$('input[name=telefon]').val(),
                                                adresa:$('input[name=adresa]').val()
                                            },function(data){
                                                var rezultati=JSON.parse(data);
                                                console.log(rezultati);
                                                if(rezultati.validator){
                                                    errors = '<div id="poruka"  class="alert alert-danger alert-autocloseable-danger"><ul>';
                                                    $.each( rezultati.validator, function( key, value ) {
                                                        errors += '<li>' + value + '</li>';
                                                    });
                                                    errors += '</ul></div>';
                                                    $( '.modal-body' ).prepend( errors );
                                                    $(".alert-autocloseable-danger").fadeTo(5000, 500).slideUp(500, function(){
                                                        $(".alert-autocloseable-danger").alert('close');
                                                    });
                                                }
                                                if(rezultati.uspesno){
                                                    $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">Uspešno logovanje. ..</div>');
                                                    $('#izlogovan').hide();
                                                    $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                                        $(".alert-autocloseable-success").alert('close');
                                                    });
                                                    $('#lulogovan').toggle('show');
                                                    $('#lime').text(rezultati.korisnik['ime']);
                                                    $('#lprezime').text(rezultati.korisnik['prezime']);
                                                    $('#lusername').text(rezultati.korisnik['username']);
                                                    $('#lemail').text(rezultati.korisnik['email']);
                                                }
                                            }
                                    );
                                    $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                        $(".alert-autocloseable-success").alert('close');
                                    });
                                });
                            </script>
                        </div>
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
                                    datum_prijave:$('input[name=datum_prijave]').val(),
                                    datum_odjave:$('input[name=datum_odjave]').val(),
                                    broj_osoba:$('#brojosoba').val(),
                                    id_smestaja:$('#id_smestaja').val(),
                                },function(data){
                                    var rezultati=JSON.parse(data);
                                    if(rezultati.validator){
                                        $('.modal-body').prepend('<div id="poruka" class="alert alert-danger alert-autocloseable-danger">'+rezultati.validator+'</div>');
                                        $(".alert-autocloseable-danger").fadeTo(5000, 500).slideUp(500, function(){
                                            $(".alert-autocloseable-danger").alert('close');
                                        });
                                    }
                                    if(rezultati.uspesno){
                                        $('.modal-body').prepend('<div id="poruka" class="alert alert-success alert-autocloseable-success">'+rezultati.uspesno+'</div>');
                                        $('#izlogovan').hide();
                                        $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                                            $(".alert-autocloseable-success").alert('close');
                                        });
                                    }
                                }
                        );
                        $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
                            $(".alert-autocloseable-success").alert('close');
                        });
                    });
                </script>
            </div>
        </div>
    </div>
    <style>

    </style>

    <script>
        $(function () {
            $('#imam_nalog_btn').on('click', function(event) {
                $('#reg').fadeOut();
                $('#imam_nalog').toggle('show');
            });
            $('#reg_btn').on('click', function(event) {
                $('#imam_nalog').fadeOut();
                $('#reg').toggle('show');
            });
            $('#datetimepicker').datetimepicker();
            $('#datetimepicker2').datetimepicker();
            $('#datetimepicker').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
            $('#datetimepicker2').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');

        });
        $(document).ready(function(){$('button').tooltip();$('a').tooltip()});
        $('button.m').click(function(){
            $('#id_smestaja').val($(this).data('id'));
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

@endsection