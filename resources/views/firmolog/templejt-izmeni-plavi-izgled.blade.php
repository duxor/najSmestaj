@extends('firmolog.master')
@section('container')

    <link rel="stylesheet" href="/templejt/admin-lte-v233/plugins/iCheck/all.css">

    {{--SLIDER::STRAT--}}
    <div class="col-sm-8">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Slajder</h3>
            </div>
            <div class="box-body">
                @foreach([1,2,3] as $i)
                    {{--SLAJD::START--}}
                    <div class="box box-widget collapsed-box">
                        <div class="box-header with-border collapsed-box">
                            <h4>Slajd {{$i}}</h4>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                {{--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>--}}
                            </div>
                        </div>
                        <div class="box-body">
                            <img class="img-responsive pad" src="/img/default/slider/{{$i}}.jpg" alt="Photo">
                            <div class="form-group">
                                <input name="naslov" class="form-control" id="inputNaslov" placeholder="Naslov">
                            </div>
                            <div class="form-group">
                                <input name="podnaslov" class="form-control" id="inputPodNaslov" placeholder="Podnaslov">
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Sačuvaj</button>
                        </div>
                    </div>
                    {{--slajd::end--}}
                @endforeach
            </div>
        </div>
    </div>
    {{--slider::end--}}

    {{--DRUSTVENE-MREZE::START--}}
    <div class="col-sm-4">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Društvene mreže</h3>
            </div>
            <form class="form-horizontal">
                <div class="box-body">
                    {{--FACEBOOK--}}
                    <div class="form-group">
                        <label for="inputFb" class="col-sm-2 control-label">Facebook</label>
                        <div class="col-sm-10">
                            <input name="facebook" class="form-control" id="inputFb" placeholder="Facebook">
                        </div>
                    </div>
                    {{--Instagram--}}
                    <div class="form-group">
                        <label for="inputIn" class="col-sm-2 control-label">Instagram</label>
                        <div class="col-sm-10">
                            <input name="instagram" class="form-control" id="inputIn" placeholder="Instagram">
                        </div>
                    </div>
                    {{--SKYPE--}}
                    <div class="form-group">
                        <label for="inputSk" class="col-sm-2 control-label">Skype</label>
                        <div class="col-sm-10">
                            <input name="skype" class="form-control" id="inputSk" placeholder="Skype">
                        </div>
                    </div><hr>
                    {{--EMAIL--}}
                    <div class="form-group">
                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input name="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    {{--TELEFON--}}
                    <div class="form-group">
                        <label for="inputTelefon" class="col-sm-2 control-label">Telefon</label>
                        <div class="col-sm-10">
                            <input name="telefon" class="form-control" id="inputTelefon" placeholder="Telefon">
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-info pull-right">Sačuvaj</button>
                </div>
            </form>
        </div>
    </div>
    {{--drustvene-mreze::end--}}

    {{--O-NAMA::STRAT--}}
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">O nama (<input type="checkbox" class="flat-red" checked> Prikaži sekciju na sajtu!)</h3>
            </div>
            <div class="box-body">
                EDITOR
            </div>
        </div>
    </div>
    {{--o-nama::end--}}

    {{--STA-NAS-IZDVAJA::STRAT--}}
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Šta nas izdvaja (<input type="checkbox" class="flat-red" checked> Prikaži sekciju na sajtu!)</h3>
            </div>
            <div class="box-body">
                @foreach([1,2,3] as $i)
                    <div class="box box-widget collapsed-box">
                        <div class="box-header with-border collapsed-box">
                            <h4>Stavka {{$i}}</h4>
                            <div class="box-tools">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="form-group">
                                <input name="naslov" class="form-control" id="inputNaslov" placeholder="Naslov">
                            </div>
                            <div class="form-group">
                                <textarea name="opis" class="form-control" id="inputOpis" placeholder="Opis"></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-info pull-right">Sačuvaj</button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{--sta-nas-izdvaja::end--}}

    {{--GALERIJA::STRAT--}}
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Galerija (<input type="checkbox" class="flat-red" checked> Prikaži sekciju na sajtu!)</h3>
            </div>
            <div class="box-body">
                FOTOGRAFIJE
            </div>
        </div>
    </div>
    {{--galerija::end--}}

    {{--TIM-OSOBLJE::STRAT--}}
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Tim/Osoblje (<input type="checkbox" class="flat-red" checked> Prikaži sekciju na sajtu!)</h3>
            </div>
            <div class="box-body">
                <textarea name="opis" class="form-control" id="inputOpisTima" placeholder="Opis"></textarea>
                FOTOGRAFIJE
            </div>
        </div>
    </div>
    {{--tim-osoblje::end--}}

    {{--LOKACIJA::STRAT--}}
    <div class="col-sm-12">
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Lokacija (<input type="checkbox" class="flat-red" checked> Prikaži sekciju na sajtu!)</h3>
            </div>
            <div class="box-body">
                MAP PIKER
            </div>
        </div>
    </div>
    {{--lokacija::end--}}
@endsection
@section('end-script')

    <script src="/templejt/admin-lte-v233/plugins/iCheck/icheck.min.js"></script>
    <script>
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal-blue',
            radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_flat-green'
        });
    </script>
@endsection





