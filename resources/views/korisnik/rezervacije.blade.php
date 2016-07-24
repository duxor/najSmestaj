@extends('korisnik.master')
@section('container')
    @if(!$rezervacije)
        <h1>Žao nam je ali ne postoji nijedna rezervacija!</h1>
    @endif
    @foreach($rezervacije as $rezervacija)
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                    <img src="/img/default/smestaj.jpg" alt="{{$rezervacija->naziv_smestaja}}">
                    <div class="caption">
                        <h3><a href="/{{$rezervacija->slug_objekta}}/{{$rezervacija->slug_smestaja}}">{{$rezervacija->naziv_smestaja}}</a></h3>
                        <p>
                            <span class="label label-success">Aktivna rezervacija</span> <br>
                            Objekat: <a href="/{{$rezervacija->slug_objekta}}">{{$rezervacija->naziv_objekta}}</a><br>
                            Vrsta: {{$rezervacija->vrsta_smestaja}} <br>
                            Kapacitet: {{$rezervacija->vrsta_kapaciteta}} <br>
                            Broj lica: {{$rezervacija->broj_osoba}} <br>
                            Od {{date('d.m.Y.',strtotime($rezervacija->datum_prijave))}} do {{date('d.m.Y.',strtotime($rezervacija->datum_odjave))}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
