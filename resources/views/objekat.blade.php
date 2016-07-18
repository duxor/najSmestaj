@extends('templejti.'.$podaci->templejt_slug.'.index')
@section('body')
    <h1>Objekat!</h1>
    {{print($podaci)}}
@endsection
