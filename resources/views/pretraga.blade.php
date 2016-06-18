@extends('master')
@section('body')

    @if(isset($smestaj))
        @foreach($smestaj as $sm)
            {{$sm['naziv_objekta']}}{{$sm['naziv_smestaja']}}{{$sm['naziv_kapaciteta']}}{{$sm['dodaci']}}
            @if(Auth::check())
                <button class="btn btn-sm btn-default _tooltip zelja"
                @if($sm['zelja']) data-zelja="{{$sm['zelja']}}" style="color:red" title="Izbaci iz liste zelja"
                        @else data-zelja="false" title="Dodaj u listu želja"@endif
                data-zid="{{$sm['id']}}" data-toggle="tooltip" data-placement="bottom">
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
    <script>
        $(document).ready(function(){$('button').tooltip();$('a').tooltip()});
        $("button.zelja").click(function(){
            $(this).css("color","black");
            //$(this).html("<i class='icon-spin6 animate-spin'></i>");
            var id=$(this).data("zid");
            $.post('/pretraga/like',
                    {
                        _token:'{{csrf_token()}}',
                        smestaj: $(this).data("zid"),
                        korisnik: 1,
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

@endsection