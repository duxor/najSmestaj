<?php if(!isset($korisnik)) $korisnik=null; ?>
<?php if(!isset($objekat)) $objekat=null; ?>
@extends('layouts.jovic')
@section('body')
    <script src="http://maps.googleapis.com/maps/api/js"></script>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                            <ul class="tabs nav nav-tabs" id="myTab">
                                <li class="active"><a href="#tab1default" data-toggle="tab" id="drugiTab">Registracija vlasnika</a></li>
                                <li ><a href="#tab2default" data-toggle="tab" id="prviTab">Registracija korisnika</a></li>
                                <li role="presentation"><a href="/login">Prijava</a></li>
                                <li role="presentation"><a href="/password/reset">Oporavak šifre</a></li>
                            </ul>
                    </div>
                    <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                Pojavio se problem prilikom registracije, proverite sledeće:<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                            @if (isset($poruka))
                                <div class="alert alert-success">{{ $poruka }}</div>
                            @endif

                        <div class="tab-content">
                            {{--Registracija vlasnika--------------------------------------}}
                            <div class="tab-pane fade in active" id="tab1default">
                                <h3 align="center"><strong>Podaci o vlasniku</strong></h3>
                                <div class="col-sm-12" id="content1">
                                    {!! Form::open(['url'=>'/register','class'=>'form-horizontal', 'files'=>'true']) !!}

                                    {!! Form::hidden('prava_pristupa_id',5) !!}
                                    {!! Form::hidden('foto_pomocna',$korisnik ? $korisnik->foto : '') !!}

                                    <div class="col-sm-2 ">{!!Form::label('ime', 'Ime:',['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('ime',null,['class'=>'form-control','placeholder'=>'Unesite ime'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('prezime', 'Prezime:', ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('prezime',null,['class'=>'form-control','placeholder'=>'Unesite prezime'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('email', 'E-mail:', ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Unesite e-mail adresu'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('password', 'Šifra:', ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::password('password',['class'=>'form-control','placeholder'=>'Unesite šifru'])!!}</div>
                                    <div class="col-sm-2 ">{!!Form::label('password_confirmation', 'Potvrda šifre:', ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::password('password_confirmation',['class'=>'form-control','placeholder'=>'Potvrdite šifru'])!!}</div>

                                    <div class="col-sm-12 form-group"><h4><strong>Pol:</strong> Muški {!! Form::radio('pol_id','1',1)!!} Ženski {!! Form::radio('pol_id','2')!!}</h4></div>

                                    <div class="col-sm-12 form-group"  align="center">
                                        <img id="slika" alt="Slika" class="img-rounded"  width="300"  @if(isset($takmicar['foto'])) src="{{$takmicar['foto']}}" @else src="/img/default/korisnik.jpg" @endif onclick="unesiFoto()">
                                        {!!Form::file('foto',['onchange'=>'prikaziFoto(this)','style'=>'display:none'])!!}
                                    </div>

                                    <div class="col-sm-2 ">{!!Form::label('adresa', 'Adresa:')!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon'])!!}</div>

                                    <h3 align="center"><strong>Podaci o objektu</strong></h3>

                                    <div class="col-sm-2 ">{!! Form::label('grad_id',"Grad:", ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos']) !!}</div>
                                    <div class="col-md-10 form-group">{!!Form::select('grad_id',$gradovi,1,['class'=>'form-control'])!!}</div>

                                    <div class="col-sm-2 ">{!! Form::label('vrsta_objekta_id',"Vrsta objekta:", ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos']) !!}</div>
                                    <div class="col-md-10 form-group">{!!Form::select('vrsta_objekta_id',$vrste_objekta,1,['class'=>'form-control'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('naziv', 'Naziv:', ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('naziv',null,['class'=>'form-control','placeholder'=>'Unesite naziv objekta'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('opis', 'Opis:')!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::textarea('opis',null,['class'=>'form-control','placeholder'=>'Unesite opisne podatke'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('adresa', 'Adresa:', ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu objekta'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('telefon', 'Kontakt telefon:', ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon objekta'])!!}</div>

                                    <div class="col-sm-2 ">{!!Form::label('emailO', 'E-mail:')!!}</div>
                                    <div class="col-sm-10 form-group">{!!Form::text('emailO',null,['class'=>'form-control','placeholder'=>'Unesite e-mail objekta'])!!}</div>

                                    <div class="form-group" align="center">
                                        <label for=""><strong>Mapa (Izaberite lokaciju objekta)</strong></label>
                                        <div id="map-canvas" style="width:500px;height:380px;"></div>
                                        {!! Form::hidden('x',44.78669522814711,['id'=>'x' ]) !!}
                                        {!! Form::hidden('y',20.450384063720662,['id'=>'y' ]) !!}
                                        {!! Form::hidden('z',6,['id'=>'z' ]) !!}
                                    </div>

                                    <div class="col-sm-12 form-group" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                            {{--Registracija korisnika--------------------------------------}}
                            <div class="tab-pane fade"  id="tab2default">
                                <h3 align="center"><strong>Podaci o korisniku</strong></h3>
                                <div class="col-sm-12" id="content2">
                                    {!! Form::open(["url"=>"/register","class"=>"form-horizontal", "files"=>"true"]) !!}

                                    {!! Form::hidden("prava_pristupa_id",2) !!}
                                    {!! Form::hidden("foto_pomocna",$korisnik ? $korisnik->foto : "") !!}

                                    <div class="col-sm-12 ">{!!Form::label("ime", "Ime:", ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-12 form-group">{!!Form::text("ime",null,["class"=>"form-control","placeholder"=>"Unesite ime"])!!}</div>

                                    <div class="col-sm-12 ">{!!Form::label("prezime", "Prezime:", ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-12 form-group">{!!Form::text("prezime",null,["class"=>"form-control","placeholder"=>"Unesite prezime"])!!}</div>

                                    <div class="col-sm-12 ">{!!Form::label("email", "E-mail:", ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-12 form-group">{!!Form::text("email",null,["class"=>"form-control","placeholder"=>"Unesite e-mail adresu"])!!}</div>

                                    <div class="col-sm-12 ">{!!Form::label("password", "Šifra:", ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-12 form-group">{!!Form::password("password",["class"=>"form-control","placeholder"=>"Unesite šifru"])!!}</div>
                                    <div class="col-sm-12 ">{!!Form::label("password_confirmation", "Potvrda šifre:", ['data-toggle'=>'tooltip','title'=>'Polje je obavezno za unos'])!!}</div>
                                    <div class="col-sm-12 form-group">{!!Form::password("password_confirmation",["class"=>"form-control","placeholder"=>"Potvrdite šifru"])!!}</div>

                                    <div class="col-sm-12 form-group"><h4>Pol: Muški {!! Form::radio("pol_id","1",1)!!} Ženski {!! Form::radio("pol_id","2")!!}</h4></div>

                                    <div class="col-sm-4">
                                        <img id="slika1" alt="Slika" class="img-rounded"  width="300"  @if(isset($takmicar["foto1"])) src="{{$takmicar["foto1"]}}" @else src="/img/default/korisnik.jpg" @endif onclick="unesiFoto1()">
                                        {!!Form::file("foto1",["onchange"=>"prikaziFoto1(this)","style"=>"display:none"])!!}
                                    </div>

                                    <div class="col-sm-12 ">{!!Form::label("adresa", "Adresa:")!!}</div>
                                    <div class="col-sm-12 form-group">{!!Form::text("adresa",null,["class"=>"form-control","placeholder"=>"Unesite adresu"])!!}</div>

                                    <div class="col-sm-12 ">{!!Form::label("telefon", "Kontakt telefon:")!!}</div>
                                    <div class="col-sm-12 form-group">{!!Form::text("telefon",null,["class"=>"form-control","placeholder"=>"Unesite telefon"])!!}</div>

                                    <div class="col-sm-12" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',["type"=>"submit", "class"=>"btn btn-lg btn-primary ","data-toggle"=>"tooltip","title"=>"Preporuka: proverite da li ste uneli sve podatke."])!!}</div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();

            //Podesavanje mape
                var map;
                var x = $('#x').val();
                var y = $('#y').val();
                var z = $('#z').val();
            function initialize() {
                var myLatlng = new google.maps.LatLng(x, y);
                var myOptions = {
                    center: myLatlng,
                    zoom: 6,
                    scrollwheel: true,
                    draggable: true,
                    panControl: true,
                    zoomControl: true,
                    mapTypeControl: true,
                    scaleControl: true,
                    streetViewControl: true,
                    overviewMapControl: true,
                    rotateControl: true,
                    styles: [{featureType:"road",elementType:"geometry",stylers:[{lightness:100},{visibility:"simplified"}]},{"featureType":"water","elementType":"geometry","stylers":[{"visibility":"on"},{"color":"#C6E2FF",}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#C5E3BF"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"color":"#D1D1B8"}]}]
                };
                map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
             /*   jQuery('.nav-tabs a[href="#tab2default"]').on('shown.bs.tab', function(){
                    google.maps.event.trigger(map, 'resize');
                    map.setZoom(6); //You need to reset zoom
                    map.setCenter(myLatlng); //You need to reset the center
                });*/
                var marker = new google.maps.Marker({
                    draggable: true,
                    position: myLatlng,
                    map: map,
                    icon:'/img/gmap_marker.png',
                    title: "Vasa lokacija"
                });
                google.maps.event.addListener(map, 'zoom_changed', function() {
                    document.getElementById("z").value = this.getZoom();
                });
                google.maps.event.addListener(marker, 'dragend', function (event) {
                    document.getElementById("x").value = this.getPosition().lat();
                    document.getElementById("y").value = this.getPosition().lng();
                });
                google.maps.event.addListener(map, 'click', function (event) {
                    marker.setPosition(event.latLng);
                    document.getElementById("x").value = marker.getPosition().lat();
                    document.getElementById("y").value = marker.getPosition().lng();
                });
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        });
        //Funkcija za obradu slika korisnika
        function unesiFoto(){$('[name=foto]').click()}
        function prikaziFoto(fotoFajl){
            if (fotoFajl.files && fotoFajl.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#slika').attr('src',e.target.result);
                }
                reader.readAsDataURL(fotoFajl.files[0]);
            }
        }
        //Funkcija za obradu slika vlasnika
        function unesiFoto1(){$('[name=foto1]').click()}
        function prikaziFoto1(fotoFajl){
            if (fotoFajl.files && fotoFajl.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#slika1').attr('src',e.target.result);
                }
                reader.readAsDataURL(fotoFajl.files[0]);
            }
        }
    </script>
@endsection