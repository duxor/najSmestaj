@extends('privatnik.master')
@section('container')
     <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?key=AIzaSyB_kZXGsitGBCz7XkcC8Glit-C0jIQsCPs" ></script>
    <!-- daterange picker -->
    <link rel="stylesheet" href="/templejt/admin-lte-v233/plugins/daterangepicker/daterangepicker-bs3.css">

    <div class="box" style="border:none">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-envelope-o"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Kontakt</span>
                    <span class="info-box-number">1,410</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-eye"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Posete</span>
                    <span class="info-box-number">13,648</span>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-heart"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Poželjnost</span>
                    <span class="info-box-number">93,139</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-sm-7">
        @if(Session::has('success'))
            <div class="box box-success">
                <h3>{!! Session::get('success') !!}</h3>
            </div>
        @endif
            @if(Session::has('error'))
                <div class="box box-success">
                    <p>{!! Session::get('error') !!}</p>
                </div>
            @endif
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Fotografije</h3>
                <div class="box-tools pull-right">
                    {!! Form::open(array('url'=>'/privatni/dodaj-sliku','method'=>'POST','id'=>'forma','files'=>true)) !!}
                        {!!Form::hidden('_token',csrf_token())!!}
                        <button type="button" id="get_file" class="btn btn-box-tool"><i class="fa fa-plus"></i></button>
                        {!! Form::file('image',['id'=>'my_file']) !!}
                        <style>
                            #my_file {
                                display: none;
                            }
                        </style>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="box-body no-padding img100">
                @foreach($slike as $slika)
                    <div class="col-sm-4 no-padding"><img style="max-height: 100px;" src="{{$slika}}"></div>
                @endforeach
            </div>
        </div>
        {{---KONTAKTI::START--}}
        <div class="row">
            @foreach($poruke as $key => $poruka)
                <div class="col-sm-6">
                    <div class="box box-primary direct-chat direct-chat-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Direktan kontakt</h3>
                            <div class="box-tools pull-right">
                                <span data-toggle="tooltip" title="Novih poruka: 1" class="badge bg-light-blue">1</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Kontakt" data-widget="chat-pane-toggle">
                                    <i class="fa fa-comments"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="direct-chat-messages">
                                @foreach($poruka as $p)
                                    @if($p['id_primaoca']==Auth::user()->id)
                                        <div class="direct-chat-msg right">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-right">{{Auth::user()->ime}} {{Auth::user()->prezime}}</span>
                                                <span class="direct-chat-timestamp pull-left">{{$p['created_at']}}</span>
                                            </div>
                                            <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                                            <div class="direct-chat-text">
                                                {{$p['poruka']}}
                                            </div>
                                        </div>
                                        @else
                                        <div class="direct-chat-msg">
                                            <div class="direct-chat-info clearfix">
                                                <span class="direct-chat-name pull-left">{{$p['primalac_ime']}}{{$p['primalac_prezime']}} </span>
                                                <span class="direct-chat-timestamp pull-right">{{$p['created_at']}}</span>
                                            </div>
                                            <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                                            <div class="direct-chat-text">
                                                {{$p['poruka']}}
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div class="direct-chat-contacts">
                                <ul class="contacts-list">
                                    <li>
                                        <a href="#">
                                            <img class="contacts-list-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                                            <div class="contacts-list-info">
                                            <span class="contacts-list-name">
                                                Milan Milic
                                                <small class="contacts-list-date pull-right">Registrovan od: 01.07.2016. 21:01</small>
                                            </span>
                                                <span class="contacts-list-msg">Poslednja poruka: Kada ce biti slobodan?</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="box-footer">
                            <form action="/privatni/send-private" method="post">
                                {!!Form::hidden('_token',csrf_token())!!}
                                {!!Form::hidden('id_primaoca',$key)!!}{{-- ovo resiti--}}
                                <div class="input-group">
                                    <input type="text" name="message" placeholder="Unesi poruku ..." class="form-control">
                              <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flat">Pošalji</button>
                              </span>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
        {{---kontakti::end--}}
    </div>

    {{---OSNOVNI-PODACI::START--}}
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Osnovni podaci</h3>
            </div>
            <div class="box-body no-padding">
                @if($objekat->aktivan ==1)
                    <span class="badge bg-green">Slobodan</span>
                @else
                    <span class="badge bg-red">Izdat</span></h3>
                @endif
                {!! Form::select('status',[0=>'Izdat',1=>'Slobodan'],$objekat->aktivan,['id'=>'status','class'=>'form-control']) !!}
                <div class="panel panel-default">
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
                            <div class="col-sm-3 ">{!! Form::label('grad_id',"Grad:") !!}</div>
                            <div class="col-sm-9 form-group">{!!Form::select('grad_id',$gradovi,$objekat?$objekat->grad_id:1,['class'=>'form-control'])!!}</div>

                            <div class="col-sm-3 ">{!! Form::label('vrsta_objekta_id',"Vrsta objekta:") !!}</div>
                            <div class="col-sm-9 form-group">{!!Form::select('vrsta_objekta_id',$vrste_objekta,$objekat?$objekat->vrsta_objekta_id:1,['class'=>'form-control'])!!}</div>

                            <div class="col-sm-3 ">{!!Form::label('naziv', 'Naziv:')!!}</div>
                            <div class="col-sm-9 form-group">{!!Form::text('naziv',null,['class'=>'form-control','placeholder'=>'Unesite naziv objekta'])!!}</div>

                            <div class="col-sm-3 ">{!!Form::label('opis', 'Opis:')!!}</div>
                            <div class="col-sm-9 form-group">{!!Form::textarea('opis',null,['class'=>'form-control','placeholder'=>'Unesite opine podatke'])!!}</div>

                            <div class="col-sm-3 ">{!!Form::label('adresa', 'Adresa:')!!}</div>
                            <div class="col-sm-9 form-group">{!!Form::text('adresa',null,['class'=>'form-control','placeholder'=>'Unesite adresu objekta'])!!}</div>

                            <div class="col-sm-3 ">{!!Form::label('telefon', 'Kontakt telefon:')!!}</div>
                            <div class="col-sm-9 form-group">{!!Form::text('telefon',null,['class'=>'form-control','placeholder'=>'Unesite telefon objekta'])!!}</div>

                            <div class="col-sm-3 ">{!!Form::label('email', 'E-mail:')!!}</div>
                            <div class="col-sm-9 form-group">{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Unesite e-mail objekta'])!!}</div>

                            <div class="form-group" align="center">
                                <label for="">Mapa (Izaberite lokaciju objekta)</label>
                                <div id="map-canvas" style="width:100%;height:380px;"></div>
                                {!! Form::hidden('x',$objekat?$objekat->x:44.78669522814711,['id'=>'x' ]) !!}
                                {!! Form::hidden('y',$objekat?$objekat->y:20.450384063720662,['id'=>'y' ]) !!}
                                {!! Form::hidden('z',$objekat?$objekat->z:6,['id'=>'z' ]) !!}
                            </div>
                            <div class="col-sm-12" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    {{---osnovni-podaci::end--}}
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
<style>
    .img100 img{width:100%}
</style>

        <!-- jQuery Knob Chart -->
<script src="/templejt/admin-lte-v233/plugins/knob/jquery.knob.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/templejt/admin-lte-v233/plugins/morris/morris.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/templejt/admin-lte-v233/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    $('#status').on('click', function () {
        var status = $(this).val();
        $.post("/privatni/status",
                {
                    '_token':'{{csrf_token()}}',
                    'status': status
                }, function () {
                    location.reload();
                }
        );
    });

    $('#get_file').click(function(){
        $("input[id='my_file']").click();
    });
    $("input[id='my_file']").change(function() {
        $('#forma').submit();
    });
</script>
@endsection
