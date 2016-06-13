<script>
    function logujSe(tip){
        $('.logovanje-u-procesu').hide().html('<h1>Prijava u toku...</h1>').slideDown();
        $.post('/demo-daj-korisnika',{
            _token: $('input[name=_token]').val(),
            vrsta_korisnika:tip
        },function(data){
            data=JSON.parse(data);
            $('input[name=email]').val(data.email);
            $('input[name=password]').val(data.pass);
            $('input[name=password]').closest('form').submit();
        })
    }
    $(function(){
        $('.tab-content').prepend('<div class="logovanje-u-procesu"></div><button class="btn btn-lg btn-success loguj-pacijenta" type="button">DEMO: Prijavi se kao pacijent</button><button class="btn btn-lg btn-danger loguj-zubara" type="button">DEMO: Prijavi se kao zubar</button>');
        $('.loguj-pacijenta').click(function(){
            logujSe(2)
        });
        $('.loguj-zubara').click(function(){
            logujSe(3)
        })
    })
</script>