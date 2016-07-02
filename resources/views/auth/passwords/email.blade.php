@extends('master')
@section('body')
<div class="container" style="padding-top:100px;padding-bottom:250px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="tabs nav nav-tabs" id="myTab">
                        <li role="presentation"><a href="/register">Registracija</a></li>
                        <li role="presentation"><a href="/login">Prijava</a></li>
                        <li class="active"><a href="#tab1default" data-toggle="tab">Oporavak šifre</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form role="form" method="POST" action="{{ url('/password/email') }}">
                            {!! csrf_field() !!}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">E-Mail adresa</label>
                                <div class="col-md-6">
                                    <div class="form-group has-icon-left form-control-email">
                                        <label class="sr-only" for="inputEmail">Email adresa</label>
                                        {!! Form::text('email',null,['class'=>'form-control form-control-lg','id'=>'inputEmail','placeholder'=>'Email adresa']) !!}
                                    </div>
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-envelope"></i>Pošalji link za oporavak
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
