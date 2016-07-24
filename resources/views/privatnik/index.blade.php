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
            <span class="info-box-icon bg-green"><i class="fa fa-flag-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Rezervacije</span>
                <span class="info-box-number">410</span>
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

{{---TRENUTNO-STANJE-SMJEŠTAJA::START--}}
{{---$stanje=['slobodan','rezervisan','zauzet']--}}
<div class="col-sm-7">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Status smeštaja</h3>
        </div>
        <div class="box-body no-padding">
            <table class="table text-center">
                <tbody>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Naziv</th>
                    <th>Kapacitet</th>
                    <th style="width: 40px">Status</th>
                    <th>Datum promene</th>
                    <th></th>
                </tr>
                <tr>
                    <td>1.</td>
                    <td>Soba Nina</td>
                    <td>2</td>
                    <td><span class="label label-success">Slobodan</span></td>
                    <td>10.11.2016.</td>
                    <td><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Soba Ultimate</td>
                    <td>3</td>
                    <td><span class="label label-warning">Rezervisan</span></td>
                    <td>10.11.2016.</td>
                    <td><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Soba Mileva</td>
                    <td>1</td>
                    <td><span class="label label-danger">Zauzet</span></td>
                    <td>10.11.2016.</td>
                    <td><button class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Pregled slobodnih smeštaja</h3>
            <div class="form-group">
                <label>Date range:</label>

                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right active" id="reservation">
                </div>
            </div>
            <button id="pretraga_za_rezervaciju" type="submit" class="btn btn-primary">Submit</button>
        </div>
        <div id="lista_smestaja"></div>
    </div>
</div>
{{---trenutno-stanje-smještaja::end--}}

{{--MODAL ZA REZERVACIJU--}}
<div class=" modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div style="width:100%; border-top:5px solid #269ABC; opacity: 0.9;" class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove"></span></button>
                <h3 style="text-align:center"><i class="glyphicon glyphicon-edit"></i> Rezerviši smestaj</h3>
            </div>
            <div class="modal-body">
                <div class="col-sm-12"><div id="poruka_neuspesna_reg"></div></div>
                <div id="forma" class="form-horizontal">
                    {!! Form::hidden('_token',csrf_token()) !!}
                    <input type="hidden" name="smestajID" id="smestajID" value="" />
                    <input type="hidden" name="datum_prijave" id="datum_prijave" value="" />
                    <input type="hidden" name="datum_odjave" id="datum_odjave" value="" />

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

                    <div class="col-sm-12">{!!Form::label('grad','Grad:')!!}</div>
                    <div class="col-sm-12 form-group">{!!Form::select('grad',$gradovi,1,['id'=>'grad','class'=>'form-control','placeholder'=>'Izaberite grad'])!!}</div>

                </div>
            </div>
            <div class="modal-footer">
                <div class="col-sm-12 form-group">
                    {!! Form::button('<span class="glyphicon glyphicon-remove"></span>&nbsp Otkaži',['class'=>'btn btn-lg btn-warning','data-dismiss'=>'modal']) !!}
                    <button id="register" class="btn btn-lg btn-primary">
                        <i class="fa fa-btn fa-sign-in"></i>Rezerviši
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{{--Kraj modal rezervacija--}}

{{--MODAL USPEŠNA REZERVACIJA--}}
<div class="modal fade" id="uspesna_rezervacija" tabindex="-1" role="dialog" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-bodya">
                <br>
                <h3 style="text-align:center"><i class="glyphicon glyphicon-edit" style="font-size: 100%"></i> Uspešno izvršena registracija korisnika i rezervacija</h3>
            </div>
            <div class="modal-footer">
                <div id="foot" class="form-group">
                    {!! Form::button('<span class="glyphicon glyphicon-remove"></span> Zatvori',['class'=>'btn btn-lg btn-warning','data-dismiss'=>'modal']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{{--Kraj modal uspešna rezervacija--}}
{{---ZARADA::START--}}
<div class="col-sm-5">
    <div class="box box-solid bg-teal-gradient">
        <div class="box-header">
            <i class="fa fa-th"></i>
            <h3 class="box-title">Zarada</h3>
        </div>
        <div class="box-body border-radius-none">
            <div class="chart" id="line-chart" style="height: 250px;"></div>
        </div>
        <div class="box-footer no-border">
            <div class="row">
                <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgColor="#39CCCC">
                    <div class="knob-label">Telefonska narudžba</div>
                </div>
                <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                    <input type="text" class="knob" data-readonly="true" value="15" data-width="60" data-height="60" data-fgColor="#39CCCC">
                    <div class="knob-label">Mail narudžba</div>
                </div>
                <div class="col-xs-3 text-center" style="border-right: 1px solid #f4f4f4">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgColor="#39CCCC">
                    <div class="knob-label">Na sajtu</div>
                </div>
                <div class="col-xs-3 text-center">
                    <input type="text" class="knob" data-readonly="true" value="5" data-width="60" data-height="60" data-fgColor="#39CCCC">
                    <div class="knob-label">Lično</div>
                </div>
            </div>
        </div>
    </div>
</div>
{{---zarada::end--}}
@endsection
@section('end-script')
        <!-- jQuery Knob Chart -->
<script src="/templejt/admin-lte-v233/plugins/knob/jquery.knob.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/templejt/admin-lte-v233/plugins/morris/morris.min.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/templejt/admin-lte-v233/plugins/daterangepicker/daterangepicker.js"></script>
<script>
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id =button.data('id');
        $(".modal-body #smestajID").val( id );
        var prijava = button.data('prijava');
        $(".modal-body #datum_prijave").val( prijava );
        var odjava = button.data('odjava');
        $(".modal-body #datum_odjave").val( odjava );
    });
</script>
<script>
    /* jQueryKnob */
    $(".knob").knob();
    /* Morris.js Charts */
    // Sales chart

    var line = new Morris.Line({
        element: 'line-chart',
        resize: true,
        data: [
            {y: '2014 Q1', item1: 2666},
            {y: '2014 Q2', item1: 2778},
            {y: '2014 Q3', item1: 4912},
            {y: '2014 Q4', item1: 3767},
            {y: '2015 Q1', item1: 6810},
            {y: '2015 Q2', item1: 5670},
            {y: '2015 Q3', item1: 4820},
            {y: '2015 Q4', item1: 15073},
            {y: '2016 Q1', item1: 10687},
            {y: '2016 Q2', item1: 8432}
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Item 1'],
        lineColors: ['#efefef'],
        lineWidth: 2,
        hideHover: 'auto',
        gridTextColor: "#fff",
        gridStrokeWidth: 0.4,
        pointSize: 4,
        pointStrokeColors: ["#efefef"],
        gridLineColor: "#efefef",
        gridTextFamily: "Open Sans",
        gridTextSize: 10
    });
    //Date range picker
    //$('#reservation').daterangepicker();
    $('#reservation').daterangepicker(
            {
                locale: {
                    format: 'YYYY-MM-DD'
                }
            }
    );
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            },
            function (start, end) {
                $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }
    );

</script>
<script>
    $('#pretraga_za_rezervaciju').on('click', function(event) {
        $.post('/administration/pretraga',
                {
                    _token:'{{csrf_token()}}',
                    datum:$('#reservation').val(),
                    start_date: $('#reservation').val(),
                    end_date: $('#reservation').data('daterangepicker').end

                },function(data){
                    var data=JSON.parse(data);
                    $('#lista_smestaja').empty();
                    $('#lista_smestaja').html('<h3>Izaberite datum!</h3>');

                    var ispis='<div class="box-body no-padding">'+
                            '<table class="table text-center">'+
                            '<tbody>'+
                            '<tr>'+
                            '<th style="width: 10px">#</th>'+
                            '<th>Naziv</th>'+
                            '<th>Kapacitet</th>'+
                            '<th style="width: 40px">Cena</th>'+
                            '<th></th>'+
                            '</tr>';

                    for(var i=0;i<data.smestaj.length;i++){
                        ispis+='<tr>'+
                                '<td>1.</td>'+
                                '<td>'+data.smestaj[i].naziv+'</td>'+
                                '<td>'+data.smestaj[i].broj_osoba+'</td>'+
                                '<td>'+data.smestaj[i].cena+'</td>'+
                                '<td><button data-id='+data.smestaj[i].id+'  data-prijava='+data.prijava+' data-odjava='+data.odjava+' data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></button></td>'+
                                '</tr>';
                    }
                    ispis+='</tbody>'+
                            '</table>'+
                            '</div>';
                    $('#lista_smestaja').html(ispis);
                }

        );
    });
    $('#register').on('click', function(event) {
        var password = $("#password").val();
        password  = password.replace(/./g, '*');
        var password_confirmation = $("#password_confirmation").val();
        password_confirmation  = password_confirmation.replace(/./g, '*');
        $.post('/administration/rezervacija',
                {
                    _token:'{{csrf_token()}}',
                    ime:$('input[name=ime]').val(),
                    prezime:$('input[name=prezime]').val(),
                    username:$('input[name=username]').val(),
                    password:password,
                    password_confirmation:password_confirmation,//$('input[name=password_confirmation]').val(),
                    email:$('input[name=email]').val(),
                    telefon:$('input[name=telefon]').val(),
                    adresa:$('input[name=adresa]').val(),
                    grad:$('#grad').val(),
                    smestajID:$('input[name=smestajID]').val(),
                    datum_od:$('input[name=datum_prijave]').val(),
                    datum_do:$('input[name=datum_odjave]').val(),
                },function(data){
                    var rezultati=JSON.parse(data);
                    console.log(rezultati);
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
                        $('#myModal').modal('toggle');
                        $('#uspesna_rezervacija').modal('toggle');
                    }
                }
        );
        $(".alert-autocloseable-success").fadeTo(5000, 500).slideUp(500, function(){
            $(".alert-autocloseable-success").hide();
        });
    });

</script>
@endsection
