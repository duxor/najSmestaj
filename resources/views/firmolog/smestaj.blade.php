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

                                <div class="col-sm-2 ">{!! Form::label('objekat_id',"Objekat:") !!}</div>
                                <div class="col-sm-10 form-group">{!!Form::select('grad_id',$objekat,1,['class'=>'form-control'])!!}</div>

                                <div class="col-sm-2 ">{!! Form::label('soba_id',"Vrsta smeštaja:") !!}</div>
                                <div class="col-sm-10 form-group">{!!Form::select('grad_id',$vrsta_smestaja,1,['class'=>'form-control'])!!}</div>

                                <div class="col-sm-2 ">{!! Form::label('vrsta_kapaciteta_id',"Vrsta kapaciteta:") !!}</div>
                                <div class="col-sm-10 form-group">{!!Form::select('grad_id',$vrsta_kapaciteta,1,['class'=>'form-control'])!!}</div>

                               <div class="col-sm-12" align="center">{!!Form::button('<i class="glyphicon glyphicon-floppy-disk"></i> Sačuvaj',['type'=>'submit', 'class'=>'btn btn-lg btn-primary ','data-toggle'=>'tooltip','title'=>'Preporuka: proverite da li ste uneli sve podatke.'])!!}</div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection