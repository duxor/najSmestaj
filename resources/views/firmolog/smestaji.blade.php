@extends('firmolog.master')
@section('container')
    @foreach($smestaji as $smestaj)
        <li>
            {!! $smestaj->vrsta_smestaja !!}
            {!! $smestaj->vrsta_kapaciteta !!}
        </li>

    @endforeach
@endsection