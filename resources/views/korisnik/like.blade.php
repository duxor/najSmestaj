@extends('master')
@section('body')
    @if($lista_zelja)
        @foreach($lista_zelja as $lz)
            {{$lz['naziv_objekta']}}{{$lz['naziv_smestaja']}}{{$lz['naziv_kapaciteta']}}{{$lz['dodaci']}}
            @if(Auth::check())
                <button class="btn btn-sm btn-default _tooltip zelja"
                @if($lz['zelja']) data-zelja="{{$lz['zelja']}}" style="color:red" title="Izbaci iz liste zelja"
                        @else data-zelja="false" title="Dodaj u listu želja"@endif
                data-zid="{{$lz['id']}}" data-toggle="tooltip" data-placement="bottom">
                    <i class="glyphicon glyphicon-heart"></i>
                </button>
            @endif
            <br>
        @endforeach
        <script>
            $("button.zelja").click(function(){
                $(this).css("color","black");
                var id=$(this).data("zid");
                $.post('/pretraga/like',
                        {
                            _token:'{{csrf_token()}}',
                            smestaj: $(this).data("zid"),
                            zelja: $(this).data("zelja")
                        },
                        function(data){
                            $('button[data-zid="'+id+'"]').html("<i class='glyphicon glyphicon-heart'></i>");
                            if($('button[data-zid="'+id+'"]').data('zelja')!=false){
                                $('button[data-zid="'+id+'"]').data('zelja',false);
                                $('button[data-zid="'+id+'"]').css("color","black");
                            } else{
                                $('button[data-zid="'+id+'"]').data('zelja',data);
                                $('button[data-zid="'+id+'"]').css("color","red");
                            }
                        }
                );
            });
        </script>
    @else
        <h3>Nema rezultata za dati upit</h3>
    @endif
@endsection