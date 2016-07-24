@extends('korisnik.master')
@section('container')
    @if($lista_zelja)
        @foreach($lista_zelja as $lz)
            <div class="row">
                <div class="col-sm-6 col-md-4">
                    <div class="thumbnail">
                        <img src="/img/default/smestaj.jpg" alt="{{$lz->naziv_smestaja}}">
                        <div class="caption">
                            <h3><a href="/{{$lz->slug_objekta}}/{{$lz->slug_smestaja}}">{{$lz->naziv_smestaja}}</a></h3>
                            <p>
                                Objekat: <a href="/{{$lz->slug_objekta}}">{{$lz->naziv_objekta}}</a><br>
                                Vrsta: {{$lz->vrsta_smestaja}} <br>
                                Kapacitet: {{$lz->vrsta_kapaciteta}} <br>
                                <button class="btn btn-sm btn-default _tooltip zelja"
                                    @if($lz['zelja'])
                                        data-zelja="{{$lz['zelja']}}"
                                        style="color:red"
                                        title="Izbaci iz liste zelja"
                                    @endif
                                    data-zid="{{$lz['id']}}" data-toggle="tooltip" data-placement="bottom">
                                    <i class="glyphicon glyphicon-heart"></i>
                                </button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @else
        <h3>Nema rezultata za dati upit</h3>
    @endif
@endsection
@section('end-script')
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
                            $('button[data-zid="'+id+'"]').closest('div[class=row]').remove();
                        } else{
                            $('button[data-zid="'+id+'"]').data('zelja',data);
                            $('button[data-zid="'+id+'"]').css("color","red");
                        }
                    }
            );
        });
    </script>
@endsection