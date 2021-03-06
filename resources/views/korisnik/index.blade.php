@extends('korisnik.master')
@section('container')
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="/templejt/admin-lte-v233/plugins/datepicker/datepicker3.css">

    <?php $korisnik=Auth::user(); ?>
    <div class="row">
        {{---PROFILE::START--}}
        <div class="col-md-3">
            {{---BASIC-PROFILE::START--}}
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{$korisnik->foto?$korisnik->foto:'/img/default/korisnik.jpg'}}" alt="Fotografija korisnika">
                    <h3 class="profile-username text-center">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</h3>
                    <p class="text-muted text-center">Registrovan od {{date('d.m.Y. H:i',strtotime($korisnik->created_at))}}</p>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Aktivne rezervacije</b> <a class="pull-right" href="/profil/rezervacije">0</a>
                        </li>
                        <li class="list-group-item">
                            <b>Lista želja</b> <a class="pull-right" href="/profil/lista-zelja">7</a>
                        </li>
                        <li class="list-group-item">
                            <b>Rezervacije</b> <a class="pull-right" href="/profil/rezervacije">3</a>
                        </li>
                        <li class="list-group-item">
                            <b>Posećene destinacije</b> <a class="pull-right" href="/profil/destinacije">2</a>
                        </li>
                    </ul>
                </div>
            </div>
            {{---basic-profile::end--}}

            {{---ABOUT::START--}}
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">O meni</h3>
                </div>
                <div class="box-body">
                    <strong><i class="fa fa-calendar margin-r-5"></i> Datum rođenja</strong>
                    <p class="text-muted">14.04.1988.</p>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Lokacija</strong>
                    <p class="text-muted">Beograd, Srbija</p>
                    <hr>
                    <strong><i class="fa fa-pencil margin-r-5"></i> Interesovanja</strong>
                    <p>
                        <span class="label label-danger">#posao</span>
                        <span class="label label-success">#priroda</span>
                        <span class="label label-info">#plaža</span>
                        <span class="label label-warning">#reka</span>
                        <span class="label label-primary">#planina</span>
                    </p>
                    <hr>
                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Ukratko</strong>
                    <p>Ovde ću upisati ukratko o meni da bi vlasnik smeštaja znao o kome se radi.</p>
                </div>
            </div>
            {{---about::end--}}
        </div>
        {{---profile::end--}}

        {{---ACTIVITY-TABS::START--}}
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                {{---NAV-TAB::START--}}
                <ul class="nav nav-tabs">
                    <li{!!isset($tab)?($tab=='activity'?' class="active"':''):' class="active"'!!}><a href="#activity" data-toggle="tab">Aktivnosti</a></li>
                    <li{!!isset($tab)?($tab=='timeline'?' class="active"':''):''!!}><a href="#timeline" data-toggle="tab">Vremenska linija</a></li>
                    <li{!!isset($tab)?($tab=='settings'?' class="active"':''):''!!}><a href="#settings" data-toggle="tab">Osnovni podaci</a></li>
                </ul>
                {{---nav-tab::end--}}
                <div class="tab-content">
                    {{---AKTIVNOSTI::START--}}
                    <div class="{{isset($tab)?($tab=='activity'?'active ':''):'active '}}tab-pane" id="activity">
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/img/default/korisnik.jpg" alt="Fotografija vlasnika smeštaja">
                                <span class="username">
                                  <a href="#">Milan Perić</a>
                                </span>
                                <span class="description">Objavljeno 02.07.2016. godine</span>
                            </div>
                            <p>
                                Naš stalni gost, izuzetna saradnja i ove godine, rezervacija odrađena i ispoštovana putem web-a, svaka preporuka.
                            </p>
                        </div>
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/img/default/korisnik.jpg" alt="Fotografija vlasnika smeštaja">
                                <span class="username">
                                    <a href="#">Milan Perić</a>
                                </span>
                                <span class="description">Objavljeno 15.06.2015. godine</span>
                            </div>
                            <p>
                                Izuzetna saradnja sa našim gostom, rezervacija odrađena i ispoštovana putem web-a.
                            </p>
                        </div>
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="/img/default/korisnik.jpg" alt="Fotografija vlasnika smeštaja">
                                <span class="username">
                                    <a href="#">Petar Radić</a>
                                </span>
                                <span class="description">Objavljeno 11.02.2015. godine</span>
                            </div>
                            <p>
                                Gost ispoštovao sve dogovore po pitanju rezervacije, prijave i odjave sa naše lokacije.
                            </p>
                        </div>
                    </div>
                    {{---aktivnosti::end--}}

                    {{---VREMENSKA-LINIJA::START--}}
                    <div class="{{isset($tab)?($tab=='timeline'?'active ':''):''}}tab-pane" id="timeline">
                        <ul class="timeline timeline-inverse">
                            <li class="time-label">
                                <span class="bg-red">02.07.2016.</span>
                            </li>
                            <li>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 09:17</span>
                                    <h3 class="timeline-header"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> postavili ste nove fotografije</h3>
                                    <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                                    <h3 class="timeline-header"><a href="#">Milan Perić</a> vas je odjavio iz <a href="#">smeštaja</a></h3>
                                    <div class="timeline-body">
                                        Naš stalni gost, izuzetna saradnja i ove godine, rezervacija odrađena i ispoštovana putem web-a, svaka preporuka.
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-green">20.06.2016.</span>
                            </li>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 18:30</span>
                                    <h3 class="timeline-header no-border"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> prijavili ste se na <a href="#">smeštaj</a>
                                    </h3>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-blue">05.06.2016.</span>
                            </li>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 22:30</span>
                                    <h3 class="timeline-header no-border"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> uspešno ste rezervisali <a href="#">smeštaj</a>
                                    </h3>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-red">15.06.2015.</span>
                            </li>
                            {{---DODAJ-NOVE-FOTOGRAFIJE--}}
                            <li>
                                <i class="fa fa-camera bg-gray"></i>
                                <div class="timeline-item col-sm-4">
                                    <span class="time"><button class="btn btn-circle btn-xs bg-gray"><i class="fa fa-plus"></i></button></span>
                                    <h3 class="timeline-header"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a></h3>
                                    <div class="timeline-body">Dodaj nove fotografije</div>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 11:25</span>
                                    <h3 class="timeline-header"><a href="#">Milan Perić</a> vas je odjavio iz <a href="#">smeštaja</a></h3>
                                    <div class="timeline-body">
                                        Izuzetna saradnja sa našim gostom, rezervacija odrađena i ispoštovana putem web-a.
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-green">10.06.2015.</span>
                            </li>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 17:15</span>
                                    <h3 class="timeline-header no-border"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> prijavili ste se na <a href="#">smeštaj</a>
                                    </h3>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-blue">01.06.2015.</span>
                            </li>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 11:14</span>
                                    <h3 class="timeline-header no-border"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> uspešno ste rezervisali <a href="#">smeštaj</a>
                                    </h3>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-red">11.02.2015.</span>
                            </li>
                            <li>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 17:42</span>
                                    <h3 class="timeline-header"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> postavili ste nove fotografije</h3>
                                    <div class="timeline-body">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                        <img src="http://placehold.it/150x100" alt="..." class="margin">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-envelope bg-blue"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 09:09</span>
                                    <h3 class="timeline-header"><a href="#">Petar Radić</a> vas je odjavio iz <a href="#">smeštaja</a></h3>
                                    <div class="timeline-body">
                                        Gost ispoštovao sve dogovore po pitanju rezervacije, prijave i odjave sa naše lokacije.
                                    </div>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-green">09.02.2015.</span>
                            </li>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 16:35</span>
                                    <h3 class="timeline-header no-border"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> prijavili ste se na <a href="#">smeštaj</a>
                                    </h3>
                                </div>
                            </li>
                            <li class="time-label">
                                <span class="bg-blue">07.02.2015.</span>
                            </li>
                            <li>
                                <i class="fa fa-user bg-aqua"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> 01:12</span>
                                    <h3 class="timeline-header no-border"><a href="#">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</a> uspešno ste rezervisali <a href="#">smeštaj</a>
                                    </h3>
                                </div>
                            </li>
                            <li>
                                <i class="fa fa-clock-o bg-gray"></i>
                            </li>
                        </ul>
                    </div>
                    {{---vremenska-linija::end--}}

                    {{---OSNOVNI-PODACI-EDIT::START--}}
                    <div class="{{isset($tab)?($tab=='settings'?'active ':''):''}}tab-pane" id="settings">
                        {!! Form::model($omeni,['class'=>'form-horizontal']) !!}
                        {{csrf_field()}}
                        <div class="form-group">
                            <label for="inputName" class="col-sm-2 control-label">Ime</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                {!! Form::text('ime',null,['class'=>'form-control','id'=>'inputName','placeholder'=>'Ime']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputSurname" class="col-sm-2 control-label">Prezime</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                {!! Form::text('prezime',null,['class'=>'form-control','id'=>'inputSurname','placeholder'=>'Prezime']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputAbout" class="col-sm-2 control-label">Ukratko o meni</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-sticky-note-o"></i>
                                </div>
                                {!! Form::textarea('bio',null,['class'=>'form-control','id'=>'inputAbout','placeholder'=>'Ukratko o meni']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Rođendan</label>
                            <div class="input-group date col-sm-9">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTags" class="col-sm-2 control-label">Tagovi</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-tags"></i>
                                </div>
                                {!! Form::text('tagovi',null,['class'=>'form-control','id'=>'inputTags','placeholder'=>'Tagovi']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTags" class="col-sm-2 control-label">Šifra</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </div>
                                {!! Form::password('password',['class'=>'form-control','id'=>'inputTags','placeholder'=>'Nova šifra']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassConfirm" class="col-sm-2 control-label">Potvrda šifre</label>
                            <div class="col-sm-9 input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-key"></i>
                                </div>
                                {!! Form::password('password_confirmation',['class'=>'form-control','id'=>'inputPassConfirm','placeholder'=>'Potvrda nove šifre']) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-danger">Sačuvaj</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {{---osnovni-podaci-edit::end--}}
                </div>
            </div>
        </div>
        {{---activity-tabs::end--}}
    </div>
@endsection
@section('end-script')
    <!-- bootstrap datepicker -->
    <script src="/templejt/admin-lte-v233/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script>
        //Date picker
        $('#datepicker').datepicker({
            format:'yyyy-mm-dd',
            autoclose: true
        });
    </script>
@endsection