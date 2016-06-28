@extends('firmolog.master')
@section('container')
    @if(!$objekti)
        <h1>Žao nam je ali ne postoji nijedan objekat u bazi!</h1>
    @endif
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
@endsection





