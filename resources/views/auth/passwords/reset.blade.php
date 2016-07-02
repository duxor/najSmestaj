@extends('master')
@section('body')
<div class="container" style="padding-top:100px;padding-bottom:250px">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Oporavak šifre</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                        {!! csrf_field() !!}
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Addresa</label>
                            <div class="col-md-6">
                                <div class="form-group has-icon-left form-control-email">
                                    <label class="sr-only" for="inputEmail">Email adresa</label>
                                    {!! Form::text('email',$email,['class'=>'form-control form-control-lg','id'=>'inputEmail','placeholder'=>'Email adresa']) !!}
                                </div>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Šifra</label>
                            <div class="col-md-6">
                                <div class="form-group has-icon-left form-control-password">
                                    <label class="sr-only" for="inputSifra">Pristupna šifra</label>
                                    <input type="password" class="form-control form-control-lg" id="inputSifra" placeholder="Pristupna šifru" autocomplete="off" name="password">
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Ponovite šifru</label>
                            <div class="col-md-6">
                                <div class="form-group has-icon-left form-control-password">
                                    <label class="sr-only" for="inputPSifra">Ponovite šifru</label>
                                    <input type="password" class="form-control form-control-lg" id="inputPSifra" placeholder="Ponovite šifru" autocomplete="off" name="password_confirmation">
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-refresh"></i>Promenite šifru
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
