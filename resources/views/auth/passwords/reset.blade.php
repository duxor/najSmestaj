@extends('master-basic')
@section('body')

	<div class="col-sm-6 col-sm-offset-3" style="z-index: 9999;margin-top:10px">
		<div class="panel with-nav-tabs panel-default">
			<div class="panel-heading">
				<ul class="nav nav-tabs" id="myTab">
					<li><a href="/register">Registracija</a></li>
					<li><a href="/login">Prijava</a></li>
					<li class="active"><a>Nova šifra</a></li>
				</ul>
			</div>
			<div class="panel-body">
				<div class="tab-content">
					@if (count($errors) > 0)
						<div class="alert alert-danger alert-autocloseable-success">
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					{!! Form::open(['url' => 'password/reset', 'method' => "POST"]) !!}
						
						{{ Form::hidden('token', $token) }}

						{{ Form::label('email', 'Email adresa:') }}
						{{ Form::email('email', $email, ['class' => 'form-control']) }}

						{{ Form::label('password', 'Nova lozinka:') }}
						{{ Form::password('password', ['class' => 'form-control']) }}

						{{ Form::label('password_confirmation', 'Potvrdite lozinku:') }}
						{{ Form::password('password_confirmation', ['class' => 'form-control']) }}

						{{ Form::submit('Potvrdi', ['class' => 'btn btn-primary']) }}

					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>

@endsection