@extends('privatnik.master')
@section('container')
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
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Fotografije</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool"><i class="fa fa-plus"></i></button>
                </div>
            </div>
            <div class="box-body no-padding img100">
                <div class="col-sm-4 no-padding"><img src="/img/default/smestaj.jpg"></div>
                <div class="col-sm-4 no-padding"><img src="/img/default/smestaj.jpg"></div>
                <div class="col-sm-4 no-padding"><img src="/img/default/smestaj.jpg"></div>
                <div class="col-sm-4 no-padding"><img src="/img/default/smestaj.jpg"></div>
                <div class="col-sm-4 no-padding"><img src="/img/default/smestaj.jpg"></div>
            </div>
        </div>
    </div>

    {{---OSNOVNI-PODACI::START--}}
    <div class="col-sm-5">
        <div class="box box-success">
            <div class="box-header">
                <h3 class="box-title">Osnovni podaci</h3>
            </div>
            <div class="box-body no-padding">
                <span class="label label-success">Slobodan</span>
                {!! Form::select('status',['Slobodan','Izdat'],0,['class'=>'form-control']) !!}
                <button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button>
                Ubaciti input, textarea i druge elemente za izmjenu osnovnih podataka: naziv, adresa, opis...
            </div>
        </div>
    </div>
    {{---osnovni-podaci::end--}}

    {{---KONTAKTI::START--}}
    <div class="col-sm-12">
        <div class="col-sm-4">
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
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">Milan Milic</span>
                            <span class="direct-chat-timestamp pull-right">15.07.2016. 12:55</span>
                        </div>
                        <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                        <div class="direct-chat-text">
                            Da li može još koja fotografija?
                        </div>
                    </div>
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">{{Auth::user()->ime}} {{Auth::user()->prezime}}</span>
                            <span class="direct-chat-timestamp pull-left">15.07.2016. 15:23</span>
                        </div>
                        <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                        <div class="direct-chat-text">
                            Postavljene su nove!
                        </div>
                    </div>
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">Milan Milic</span>
                            <span class="direct-chat-timestamp pull-right">19.07.2016. 20:33</span>
                        </div>
                        <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                        <div class="direct-chat-text">
                            Postavljene su nove!
                        </div>
                    </div>
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
                <form action="#" method="post">
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
        <div class="col-sm-4">
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
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">Petar Peric</span>
                            <span class="direct-chat-timestamp pull-right">15.07.2016. 12:55</span>
                        </div>
                        <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                        <div class="direct-chat-text">
                            Da li je centralno?
                        </div>
                    </div>
                    <div class="direct-chat-msg right">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-right">{{Auth::user()->ime}} {{Auth::user()->prezime}}</span>
                            <span class="direct-chat-timestamp pull-left">15.07.2016. 15:23</span>
                        </div>
                        <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                        <div class="direct-chat-text">
                            Nije!
                        </div>
                    </div>
                    <div class="direct-chat-msg">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name pull-left">Petar Peric</span>
                            <span class="direct-chat-timestamp pull-right">19.07.2016. 20:33</span>
                        </div>
                        <img class="direct-chat-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                        <div class="direct-chat-text">
                            Zasto?
                        </div>
                    </div>
                </div>
                <div class="direct-chat-contacts">
                    <ul class="contacts-list">
                        <li>
                            <a href="#">
                                <img class="contacts-list-img" src="/img/default/korisnik.jpg" alt="Fotografija korisnika">
                                <div class="contacts-list-info">
                                        <span class="contacts-list-name">
                                            Petar Peric
                                            <small class="contacts-list-date pull-right">Registrovan od: 01.07.2016. 21:01</small>
                                        </span>
                                    <span class="contacts-list-msg">Poslednja poruka: Zasto?</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-footer">
                <form action="#" method="post">
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
    </div>
    {{---kontakti::end--}}

@endsection
@section('end-script')
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

@endsection
