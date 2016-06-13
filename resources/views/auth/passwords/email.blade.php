@extends('master-basic')

@section('body')

    <div class="col-sm-6 col-sm-offset-3" style="z-index: 9999;margin-top:10px">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs" id="myTab">
                    <li><a href="/register">Registracija</a></li>
                    <li><a href="/login">Prijava</a></li>
                    <li class="active"><a>Resetuj šifru</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    {!! Form::open(['url' => 'password/email', 'method' => "POST"]) !!}
                        <div class="form-group has-feedback">
                            {!! Form::label('email','Email adresa:',['class'=>'control-label col-sm-2']) !!}
                            <div class="col-sm-10">
                                {{ Form::email('email', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        </br></br></br>
                        <div class="form-group has-feedback">
                            {{ Form::submit('Resetuj šifru', ['class' => 'btn btn-primary']) }}
                        </div>
                    {{ Form::close() }}
                </div>
			</div>
		</div>
	</div>

@endsection