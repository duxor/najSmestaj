<?php if(!isset($objekti)) $objekti=null; ?>
@extends('firmolog.master')
@section('body')
@if(!$objekti)<script>alert('Ne postoji nijedan objekat u bazi podataka!')</script>@endif
@endsection

@foreach($objekti as $objekat)
    <li>
        {!! $objekat->id !!}
        {!! $objekat->grad !!}
        {!! $objekat->vrsta_objekta !!}
        {!! $objekat->naziv !!}
        {!! $objekat->opis !!}
        {!! $objekat->adresa!!}
        {!! $objekat->telefon!!}
        {!! $objekat->email!!}
        {!! $objekat->x!!}
        {!! $objekat->y!!}
        {!! $objekat->z!!}
    </li>

@endforeach