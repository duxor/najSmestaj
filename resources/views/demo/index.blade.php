<div class="demo">
    <div class="demo-container">
        <img src="/img/logo-demo-ml.png">
        <h1>Dobro nam došli!</h1>
        <h2>Nalazite se na <b>demo aplikaciji</b> namenjenoj za testiranje funkcionalnosti, pa su shodno tome i ograničenja minimalizovana.</h2>
        <h1 class="j"><u>Svi podaci koji se ovde nalaze su <b>TEST</b> podaci i svaka sličnost sa stvarnim ličnostima i ordinacijama je sasvim slučajna. <b>Samo ovde (na demo aplikaciji) odobreno je da obavljate sve ponuđene aktivnosti bez obaveza.</b></u></h1>
        <h3>Ukoliko imate sugestiju budite slobodni da nas kontaktirate putem kontakt forme.</h3>
        <div class="right">
            <button class="btn btn-danger">Prihvatam demo verziju</button>
        </div>
    </div>
</div>
<style>
    body{ overflow: hidden }
    .demo{
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 99999;
        background-color: rgba(0,0,0,0.8);
        overflow: scroll;
        text-align: center;
    }
    .demo .j,.demo h2,.demo h3{ text-align: justify }
    .demo .demo-container{
        margin: 50px auto;
        padding: 100px 50px;
        background-color: #fff;
        color: #333;
        width: 80%;-webkit-border-top-right-radius: 30px;
        -webkit-border-bottom-left-radius: 30px;
        -moz-border-radius-topright: 30px;
        -moz-border-radius-bottomleft: 30px;
        border-top-right-radius: 30px;
        border-bottom-left-radius: 30px;
    }
    .demo h1, .demo h2{ margin-bottom: 40px }
    .demo img{ max-width: 100% }
    .demo .right{ float: right }
</style>
<script>
    $(function(){
        $('.demo button').click(function(){
            $('body').css('overflow','scroll');
            $('.demo').slideUp();
        });
        $('a[href="/register"]').each(function(){
            if($(this).hasClass('btn-action'))
                $(this).after('<a href="/login" class="btn btn-default btn-action" style="margin-top:5px">DEMO: Prijavi se sa<br> podacima registrovanog<br> korisnika!</a>');
            else
                $(this).after('<h2><center><a href="/login">DEMO: Prijavi se sa podacima registrovanog korisnika!</a></center></h2>');
        })
    })
</script>