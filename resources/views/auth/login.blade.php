@extends('master-basic')
@section('end-script')
    @include('demo.login')
@endsection
@section('body')
    <div class="col-sm-7 col-sm-offset-3" style="z-index: 9999;margin-top:10px">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs" id="myTab">
                    <li><a href="/register">Registracija</a></li>
                    <li class="active"><a>Prijava</a></li>
                    <li><a href="/password/reset">Oporavak šifre</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                        @if(Session::has('fail'))
                            <div class="alert alert-danger alert-autocloseable-success">
                                <h3>{{Session::get('fail')}}</h3>
                            </div>
                        @endif
                        <form class="form-horizontal" role="form" method="POST">
                            {!! csrf_field() !!}
                            {{---EMAIL--}}
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    {{ Form::email('email',null,['class'=>'form-control','placeholder'=>'Email']) }}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---PASSWORD--}}
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="col-md-4 control-label">Šifra</label>
                                <div class="col-md-6">
                                    {{ Form::password('password',['class'=>'form-control','placeholder'=>'Pristupna šifra']) }}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---SUBMIT-BTN--}}
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i> Prijavi se
                                    </button>
                                    <a class="btn btn-link" href="/password/reset">Zaboravili ste šifru?</a>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
    {!! Html::style('/css/login.css') !!}
@endsection