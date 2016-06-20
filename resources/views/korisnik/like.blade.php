@extends('master')
@section('body')
    @if(isset($lista_zelja))
        @foreach($lista_zelja as $lz)
            {{$lz['naziv_objekta']}}{{$lz['naziv_smestaja']}}{{$lz['naziv_kapaciteta']}}{{$lz['dodaci']}}
            @if(Auth::check())
                <button class="btn btn-lg btn-default _tooltip zelja"
                @if($lz['zelja']) data-zelja="{{$lz['zelja']}}" style="color:red" title="Izbaci iz liste zelja"
                        @else data-zelja="false" title="Dodaj u listu želja"@endif
                data-zid="{{$lz['id']}}" data-toggle="tooltip" data-placement="bottom">
                    <i class="glyphicon glyphicon-heart"></i>
                </button>
            @else
                <a " href="/login" class="btn btn-sm btn-default _tooltip"  title="Dodaj u listu želja" data-toggle="tooltip" data-placement="bottom">
                <i class="glyphicon glyphicon-heart"></i>
                </a>
            @endif
            <br>
        @endforeach
    @else
        <h3>Nema rezultata za dati upit</h3>
    @endif
@endsection