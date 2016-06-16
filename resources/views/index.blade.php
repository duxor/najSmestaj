@extends('master')
@section('body')
    {!! Html::style('/css/datetimepicker.css') !!}
    {!!Html::script('/js/moment.js')!!}
    {!! Html::script('/js/datetimepicker.js') !!}
    <style>
        .margin5{
            margin-right: 0px;
            margin-left: 0px;
            padding-right: 0px;
            padding-left: 0px;
        }
    </style>
    <div class="container-fluid">
        <h3 class="col-sm-12">Pretraga</h3>
        {!!Form::open(['url'=>'/pretraga','class'=>'form-inline'])!!}
        <div class="form-group">
            <div class="col-sm-12 margin5">
                {!!Form::text('naziv',null,['class'=>'form-control','id'=>'naziv','placeholder'=>'Naziv'])!!}
            </div>
        </div>
        <div class="form-group margin5">
            <div class="col-sm-12">
                {!!Form::select('grad',['1'=>'Kraljevo','2'=>'Beograd'],  (Session::has('old'))?Session::get('old'):null, ['id'=>'grad','class'=>'form-control ','placeholder'=>'Izaberi grad'])!!}
            </div>
        </div>
        <div class="input-group margin5">
            <div class="input-daterange input-group col-sm-12">
                {!!Form::text('datum_prijave',null,['class'=>'form-control','id'=>'datetimepicker','placeholder'=>'Datum prijave'])!!}
                <span class="input-group-addon">do</span>
                {!!Form::text('datum_odjave',null,['class'=>'form-control','id'=>'datetimepicker2','placeholder'=>'Datum odjave'])!!}

            </div>
        </div>
        <div class="form-group margin5">
            <div class="col-sm-12">
                <label for="brojosoba" class="col-sm-7 control-label">Br.osoba:</label>
                {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],null,['id'=>'brojosoba','class'=>'form-control'])!!}
            </div>
        </div>
        <div class="form-group margin5">
            <div class="col-sm-3">
                {!!Form::text('tagovi',null,['class'=>'form-control ','id'=>'tagovi','placeholder'=>'Tagovi'])!!}
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                {!!Form::button('<i class="glyphicon glyphicon-search"></i> Pretraga ',['id'=>'btn_search','type'=>'submit','class'=>'btn btn-sm btn-success'])!!}
            </div>
        </div>
        {!!Form::close()!!}
            <script>
                $(function () {
                    $('#datetimepicker').datetimepicker();
                    $('#datetimepicker2').datetimepicker();
                    $('#datetimepicker').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
                    $('#datetimepicker2').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');

            });
            </script>

@endsection
