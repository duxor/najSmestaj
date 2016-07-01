@extends('korisnik.master')
@section('container')
    @if(!$rezervacije)
        <h1>Žao nam je ali ne postoji nijedna rezervacija!</h1>
    @endif
    @foreach($rezervacije as $rezervacija)
        <li>
            {!! $rezervacija->naziv_smestaja!!}
            {!! $rezervacija->vrsta_smestaja!!}
            {!! $rezervacija->vrsta_kapaciteta !!}
            {!! $rezervacija->naziv_objekta !!}
            {!! $rezervacija->broj_osoba !!}
            {!! $rezervacija->datum_prijave !!}
            {!! $rezervacija->datum_odjave !!}
        </li>
    @endforeach
@endsection
