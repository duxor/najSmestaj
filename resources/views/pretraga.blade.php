@extends('master')
@section('body')
    @if($smestaj)
        @foreach($smestaj as $sm)
            {{$sm['naziv']}}<br>
        @endforeach
        @else
        <h3>Nema rezultata za dati upit</h3>
    @endif

@endsection