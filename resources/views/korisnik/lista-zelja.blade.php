@extends('korisnik.master')
@section('container')
    @if(!$liste_zelja)
        <h1>Žao nam je ali ne postoji nijedna lista želja!</h1>
    @endif
    @foreach($liste_zelja as $lista_zelja)
        <li>
            {!! $lista_zelja->naziv_smestaja!!}
            {!! $lista_zelja->vrsta_smestaja!!}
            {!! $lista_zelja->vrsta_kapaciteta !!}
            {!! $lista_zelja->naziv_objekta !!}
            {!! $lista_zelja->aktivan !!}
        </li>
    @endforeach
@endsection