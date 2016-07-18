@extends('firmolog.master')
@section('container')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 align="center">Podaci o smestajima</h3>
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
                            {!! Form::model($smestaj, ['class'=>'form-horizontal', 'files'=>'true']) !!}

                                {!! Form::hidden('id',$smestaj?$smestaj->id : null) !!}

                                <div class="col-sm-2 ">{!! Form::label('objekat_id',"Objekat:") !!}</div>
                                <div class="col-sm-10 form-group">{!!Form::select('objekat_id',$objekat,$smestaj?$smestaj->objekat_id:1,['class'=>'form-control', 'id'=>'objekti'])!!}</div>

                                <div class="col-sm-2 ">{!!Form::label('naziv', 'Naziv smeštaja:')!!}</div>
                                <div class="col-sm-10 form-group">{!!Form::text('naziv',null,['class'=>'form-control','placeholder'=>'Unesite naziv smeštaja'])!!}</div>


                                <div class="col-sm-2 ">{!! Form::label('vrsta_smestaja_id' ,"Vrsta smeštaja:") !!}</div>
                                <div class="col-sm-10 form-group">{!!Form::select('vrsta_smestaja_id',$vrsta_smestaja,$smestaj?$smestaj->vrsta_smestaja_id:1,['class'=>'form-control'])!!}</div>

                                <div class="col-sm-2 ">{!! Form::label('vrsta_kapaciteta_id',"Vrsta kapaciteta:") !!}</div>
                                <div class="col-sm-10 form-group">{!!Form::select('vrsta_kapaciteta_id',$vrsta_kapaciteta,$smestaj?$smestaj->vrsta_kapaciteta_id:1,['class'=>'form-control'])!!}</div>
                            
                               <div class="col-sm-12" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>

                            {!! Form::close() !!}

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
           $('#objekti').change(function () {
               var objekat_id = $(this).val();
               $.get('/administration/prikazi-dodatke', {objekat_id: objekat_id, _token: '{{csrf_token()}}'}, function (data) {
                   console.log(data);

               });
           });
        });
    </script>
@endsection