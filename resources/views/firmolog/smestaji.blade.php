@extends('firmolog.master')
@section('container')

    @if(!$objekat)
        <h1>Za prikazivanje smestajnih kapaciteta morate izabrati objekat!</h1>
    @else
        {!! $objekat->naziv !!}<br>
        {!! $objekat->grad !!}<br>
        {!! $objekat->vrsta_objekta !!}<br>
        @if(!$smestaji)
            <h1>Žao nam je ali ne postoji nijedan smestaj u bazi podataka!</h1>
        @else
            <hr size="30">
            @foreach($smestaji as $smestaj)
                <li>
                    {!! $smestaj->vrsta_smestaja !!}
                    {!! $smestaj->vrsta_kapaciteta !!}
                    <a href="/administration/smestaj/{{$smestaj->slug}}" class="btn btn-info" role="button">Izmeni</a>
                </li>
            @endforeach
            <a href="/administration/smestaj" class="btn btn-info" role="button">Dodaj novi smeštaj</a>
        @endif
    @endif
@endsection
