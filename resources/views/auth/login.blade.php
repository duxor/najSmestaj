@extends('master')
@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <ul class="tabs nav nav-tabs" id="myTab">
                        <li role="presentation"><a href="/register">Registracija</a></li>
                        <li class="active"><a data-toggle="tab">Prijava</a></li>
                        <li role="presentation"><a href="/password/reset">Oporavak šifre</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                                {!! csrf_field() !!}
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label class="col-md-4 control-label">E-mail adresa</label>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="email" value="{{ old('email') }}">

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
                                        <input type="password" class="form-control" name="password">
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-sign-in"></i>Prijavi se
                                        </button>
                                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Zaboravili ste Vašu šifru?</a>
                                    </div>
                                </div>
                                {{---TEST-ACCESS::START--}}
                                <div class="form-group">
                                    <button type="button" onclick="podaci('dusan.perisic@test.com','admin')">Korisnik smeštaja</button>
                                    <button type="button" onclick="podaci('milos.milosevic@test.com','admin')">Vlasnik privatnog smeštaja</button>
                                    <button type="button" onclick="podaci('marko.markovic@test.com','admin')">Vlasnik firme</button>
                                    <script>
                                        function podaci(email, pass){
                                            $('[name=email]').val(email);
                                            $('[name=password]').val(pass);
                                        }
                                    </script>
                                </div>
                                {{---test-access::end--}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('end-script')
    <script async src="/templejt/master/js/min/login.js"></script>
    <script>
        function podaci(email, pass){
            $('[name=email]').val(email);
            $('[name=password]').val(pass);
        }
    </script>
@endsection