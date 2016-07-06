@extends('firmolog.master')
@section('container')
    @if(!$objekti)
        <h1>Žao nam je ali ne postoji nijedan objekat u bazi!</h1>
    @endif
    @foreach($objekti as $objekat)
        <div class="col-sm-4">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">{!! $objekat->naziv !!}
                        @if($objekat->aktivan ==1)
                                <span class="badge bg-green">aktivan</span>
                            @else
                                <span class="badge bg-red">nije</span></h3>
                         @endif
                    </h3>
                    <div class="box-tools pull-right">
                        <button type="button" value="{{$objekat->slug}}" class="aca btn btn-danger btn-xs"><i class="fa fa-check-square-o" ></i></button>
                        <a href="/administration/objekat/{{$objekat->slug}}"><button type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i></button></a>
                        <a href="/administration/smestaj"><button type="button" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button></a>
                    </div>
                </div>
                <div class="box-body">
                    {!! $objekat->id !!}
                    {!! $objekat->grad !!}
                    {!! $objekat->vrsta_objekta !!}
                    {!! $objekat->opis !!}
                    {!! $objekat->adresa!!}
                    {!! $objekat->telefon!!}
                    {!! $objekat->email!!}
                    {!! $objekat->x!!}
                    {!! $objekat->y!!}
                    {!! $objekat->z!!}
                    {!! $objekat->foto!!}
                    {!! $objekat->aktivan!!}
                    {!! $objekat->slug!!}
                </div>
                <div class="box-footer">
                    LISTA SVIH SMEŠTAJA OBJEKTA: link>nazivSmještaja
                </div>
            </div>
        </div>
    @endforeach
@endsection
@section('end-script')
    <script>
        $('.aca').each(function (index ) {
            $(this).click(function () {
                var slug  = $( this ).attr('value');
                $.post('/administration/status-objekta', {slug: slug,  _token: '{{csrf_token()}}'})
        })
        })
    </script>
@endsection





