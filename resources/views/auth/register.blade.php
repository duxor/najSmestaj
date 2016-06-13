@extends('master-basic')
@section('body')
    <div class="col-sm-8 col-sm-offset-2" style="z-index: 9999;margin-top:10px">
        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a data-target="#tab1" data-toggle="tab">Registruj ordinaciju</a></li>
                    <li><a data-target="#tab2" data-toggle="tab">Registracija pacijenta</a></li>
                    <li><a href="/login">Prijava</a></li>
                    <li><a href="/password/reset">Oporavak šifre</a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    {{---PORUKA-O-GREŠĆI--}}
                    @if (Session::has('poruka'))
                        <h3 class="alert alert-success alert-autocloseable-success" align="center">
                            {{ Session::get('poruka') }}
                        </h3>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-autocloseable-success">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    {{---ZUBAR-TAB-::START--}}
                    <div class="tab-pane active" id="tab1">
                        {!! Form::open(['class'=>'form-horizontal']) !!}
                            <input name="zubar_pacijent" style="display:none" value="3">
                            {{---NAZIV-ORDINACIJE--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('naziv_ordinacije','Naziv ordinacije*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('naziv',Request::old('naziv'),['placeholder'=>'Naziv ordinacije','class'=>'form-control','id'=>'naziv']) !!}
                                    @if ($errors->has('naziv'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('naziv') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---EMAIL--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('email','Email*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('email', Request::old('email'),['placeholder'=>'Email','class'=>'form-control']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---PASSWORD--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('password','Password*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password', ['placeholder'=>'Šifra','class'=>'form-control','id'=>'password']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---PASSWORD-CONFIRMATION--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('password_confirmation','Potvrdite Password*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password_confirmation', ['placeholder'=>'Potvrda šifre','class'=>'form-control','id'=>'password_confirmation']) !!}
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            {{---TELEFON--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('telefon','Telefon',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('telefon', Request::old('telefon'),['placeholder'=>'Telefon','class'=>'form-control']) !!}
                                    @if ($errors->has('telefon'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('telefon') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            {{---FAX--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('fax','Fax',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('fax', Request::old('telefon'),['placeholder'=>'Fax','class'=>'form-control']) !!}
                                    @if ($errors->has('fax'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('fax') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---ADRESA--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('adresa','Adresa',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('adresa', Request::old('adresa'),['placeholder'=>'Adresa','class'=>'form-control']) !!}
                                    @if ($errors->has('adresa'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('adresa') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---FACEBOOK--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('facebook','Facebook',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('facebook', Request::old('facebook'),['placeholder'=>'Facebook','class'=>'form-control']) !!}
                                    @if ($errors->has('facebook'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('facebook') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---TWITTER--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('twitter','Twitter',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('twitter', Request::old('twitter'),['placeholder'=>'Twitter','class'=>'form-control']) !!}
                                    @if ($errors->has('twitter'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('twitter') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---SKYPE--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('skype','Skype',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('skype', Request::old('skype'),['placeholder'=>'Skype','class'=>'form-control']) !!}
                                    @if ($errors->has('skype'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('skype') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---GRAD--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('grad','Grad',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('grad_id', \App\Grad::orderBy('naziv','asc')->lists('naziv','id'),1,['placeholder'=>'Grad','class'=>'form-control']) !!}
                                    @if ($errors->has('grad'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('grad') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---PRIHVATAM-USLOVE--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('','',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    <input type="checkbox" class="uslovi"> Prihvatam <a href="/pdf/uslovi-koriscenja-zubologa.pdf" target="_blank">Uslove korištenja</a>
                                    @if ($errors->has('grad'))
                                        <span class="help-block">
                                                    <strong>{{ $errors->first('grad') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>
                            {{---REGISTRUJ-ORDINACIJU--}}
                            <div class="form-group">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
                                {!!Form::button('Registruj ordinaciju', ['id'=>'button_unesi','class'=>'btn3d btn btn-lg btn-info ','type'=>'button','disabled'=>'disabled'])!!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {{---zubar-forma-::end--}}

                    {{---PACIJENT-FORMA-::START--}}
                    <div class="tab-pane" id="tab2">
                        {!! Form::open(['class'=>'form-horizontal']) !!}
                            <input name="zubar_pacijent" style="display:none" value="2">
                            {{---IME--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('ime','Ime*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('ime',Request::old('ime'),['placeholder'=>'Ime','class'=>'form-control','id'=>'ime']) !!}
                                    @if ($errors->has('ime'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('ime') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---PREZIME--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('prezime','Prezime*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('prezime',Request::old('prezime'),['placeholder'=>'Prezime','class'=>'form-control','id'=>'prezime']) !!}
                                    @if ($errors->has('prezime'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('prezime') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---EMAIL--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('email','Email*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('email', Request::old('email'),['placeholder'=>'Email','class'=>'form-control']) !!}
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>
                            {{---PASSWORD--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('password','Password*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password', ['placeholder'=>'Šifra','class'=>'form-control','id'=>'password']) !!}
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---PASSWORD-CONFIRMATION--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('password_confirmation','Potvrdite Password*',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::password('password_confirmation', ['placeholder'=>'Potvrda šifre','class'=>'form-control','id'=>'password_confirmation']) !!}
                                    @if ($errors->has('password_confirmation'))
                                        <span class="help-block">
                                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                    @endif
                                </div>
                            </div>
                            {{---TELEFON--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('telefon','Telefon',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::text('telefon', Request::old('telefon'),['placeholder'=>'Telefon','class'=>'form-control']) !!}
                                    @if ($errors->has('telefon'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('telefon') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---GRAD--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('grad','Grad',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    {!! Form::select('grad_id', \App\Grad::orderBy('naziv','asc')->lists('naziv','id'),1,['placeholder'=>'Grad','class'=>'form-control']) !!}
                                    @if ($errors->has('grad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('grad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---PRIHVATAM-USLOVE--}}
                            <div class="form-group has-feedback">
                                {!! Form::label('','',['class'=>'control-label col-sm-2']) !!}
                                <div class="col-sm-10">
                                    <input type="checkbox" class="uslovi"> Prihvatam <a href="/pdf/uslovi-koriscenja-zubologa.pdf" target="_blank">Uslove korištenja</a>
                                    @if ($errors->has('grad'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('grad') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            {{---REGISTRUJ-SE--}}
                            <div class="form-group">
                                <div class="col-sm-2"></div>
                                <div class="col-sm-10">
                                    {!!Form::button('Registruj se', ['id'=>'button_unesi','class'=>'btn3d btn btn-lg btn-info ','type'=>'button','disabled'=>'disabled'])!!}
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    {{---pacijent-forma-::end--}}
                </div>
            </div>
        </div>
    </div>
    <style>
        #myTab li a{ cursor: pointer }
    </style>
@endsection

@section('end-script')
    <script>
        $('[data-toggle=tab]').click(function(){
            if($(this).parent().hasClass('active')) return;
            $('#myTab li').removeClass('active');
            $(this).parent().addClass('active');
            $('.tab-pane').slideUp();
            $($(this).data('target')).slideDown().css('display','initial');
        })
        $('.uslovi').change(function(){
            var el=$(this).closest('form').find('button');
            if($(this).prop('checked')) el.removeAttr('disabled').attr('type','submit');
            else el.attr('disabled','disabled').attr('type','button');
        })
        @if(old('zubar_pacijent')==2)
            $('.tab-pane').removeClass('active');
            $('#tab2').addClass('active')
            $('#myTab li').removeClass('active');
            $('[data-target=#tab2]').parent().addClass('active');
        @endif
    </script>
@endsection