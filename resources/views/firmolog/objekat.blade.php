<?php if(!isset($korisnik)) $korisnik=null; ?>
<?php if(!isset($objekat)) $objekat=null; ?>
@extends('firmolog.master')
@section('container')
    <script src="http://maps.google.com/maps/api/js?sensor=false%22%3E%3C/script&gt"></script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 align="center">Podaci o objektu</h3>
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
                                <div class="col-sm-12">
                                    {!! Form::model($objekat, ['class'=>'form-horizontal', 'files'=>'true']) !!}

                                    {!! Form::hidden('id',$objekat?$objekat->id : null) !!}

                                        <div class="col-sm-2 ">{!! Form::label('grad_id',"Grad:") !!}</div>
                                        <div class="col-sm-10 form-group">{!!Form::select('grad_id',$gradovi,$objekat?$objekat->grad_id:1,['class'=>'form-control'])!!}</div>

                                        <div class="col-sm-2 ">{!! Form::label('vrsta_objekta_id',"Vrsta objekta:") !!}</div>
                                        <div class="col-sm-10 form-group">{!!Form::select('vrsta_objekta_id',$vrste_objekta,$objekat?$objekat->vrsta_objekta_id:1,['class'=>'form-control'])!!}</div>

                                        <div class="col-sm-2 ">{!!Form::label('naziv', 'Naziv:')!!}</div>
                                        <div class="col-sm-10 form-group">{!!Form::text('naziv',null,['class'=>'form-control','placeholder'=>'Unesite naziv objekta'])!!}</div>

                                        <div class="col-sm-2 ">{!!Form::label('opis', 'Opis:')!!}</div>
                                        <div class="col-sm-10 form-group">{!!Form::textarea('opis',null,['class'=>'form-control','placeholder'=>'Unesite opine podatke'])!!}</div>

                                        <div class="col-sm-2 ">{!!Form::label('adresa', 'Adresa:')!!}</div>
                                        <div class="col-sm-10 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu objekta'])!!}</div>

                                        <div class="col-sm-2 ">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                                        <div class="col-sm-10 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon objekta'])!!}</div>

                                        <div class="col-sm-2 ">{!!Form::label('email', 'E-mail:')!!}</div>
                                        <div class="col-sm-10 form-group">{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Unesite e-mail objekta'])!!}</div>

                                        <div class="form-group" align="center">
                                            <label for="">Mapa (Izaberite lokaciju objekta)</label>
                                            <div id="map-canvas" style="width:500px;height:380px;"></div>
                                            {!! Form::hidden('x',$objekat?$objekat->x:44.78669522814711,['id'=>'x' ]) !!}
                                            {!! Form::hidden('y',$objekat?$objekat->y:20.450384063720662,['id'=>'y' ]) !!}
                                            {!! Form::hidden('z',$objekat?$objekat->z:6,['id'=>'z' ]) !!}
                                        </div>

                                        <h1 class="col-sm-12">Dodaci:</h1>
                                        @foreach($dodaci as $dodatak)
                                            <div class="col-sm-3">
                                                <h4><strong>{{$dodatak->naziv}}</strong></h4>
                                                {!! Form::checkbox("dodatak[]",$dodatak->id) !!}
                                            </div>
                                        @endforeach
                                        <div class="col-sm-12" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
                                    {!! Form::close() !!}
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('end-script')
    <script>
        $(document).ready(function() {

            $('[data-toggle="tooltip"]').tooltip();

            //Podesavanje mape
            var map;
            var x = $('#x').val();
            var y = $('#y').val();
            var z = parseInt($('#z').val());
            function initialize() {
                var myLatlng = new google.maps.LatLng(x, y);
                var myOptions = {
                    center: myLatlng,
                    zoom: z,
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
    </script>
@endsection