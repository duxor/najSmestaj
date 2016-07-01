@extends('master')
@section('body')
    {{---POCETNA::START--}}
    <header id="landioCarousel" class="carousel carousel-header slide bg-inverse" data-ride="carousel" data-interval="0"
            role="banner">
        <ol class="carousel-indicators">
            <li data-target="#landioCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#landioCarousel" data-slide-to="1"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active" style="background-image: url(/templejt/master/img/d3.jpg);">
                <div class="carousel-caption">
                    <h1 class="display-3">Brzo i lako kreirajte ličnu web prezentaciju sa brojnim mogućnostima</h1>
                    <h2 class="m-b-3 hidden-sm-down">Ako imate <em>svoj smeštaj</em> registrujte se i u samo 5 minuta kreirajte Vaš sajt!</h2>
                    <a class="btn btn-secondary-outline m-b-2" data-target="#landioCarousel" data-slide-to="1"><span class="pull-xs-left icon-search"></span>Tražim smeštaj!</a>
                </div>
            </div>
            <div class="carousel-item" style="background-image: url(/templejt/master/img/d4.jpg);">
                {!!Form::open(['url'=>'/pretraga','class'=>'form-horizontal pretragaForm'])!!}
                <div class="carousel-caption">
                    <h1 class="display-3">Pronađi smeštaj po meri!</h1>
                    <h2 class="m-b-3 hidden-sm-down">Prilagodite pretragu <strong>svojim potrebama!</strong></h2>
                    <div class="col-sm-4 col-sm-offset-2">
                        {{---NAZIV--}}
                        <div class="form-group has-icon-left form-control-name">
                            <label class="sr-only" for="inputNaziv">Naziv</label>
                            <input type="text" class="form-control form-control-lg" id="inputNaziv" placeholder="Naziv" name="naziv">
                        </div>
                        {{---GRAD--}}
                        <div class="form-group has-icon-left form-control-email">
                            <label class="sr-only" for="inputGrad">Grad</label>
                            {!!Form::select('grad', $gradovi, null, ['id'=>'inputGrad','class'=>'form-control form-control-lg','placeholder'=>'Izaberi grad'])!!}
                        </div>
                        {{---DATUM-PRIJAVE--}}
                        <div class="form-group has-icon-left form-control-email">
                            <label class="sr-only" for="inputPrijava">Datum prijave</label>
                            <input type="text" class="form-control form-control-lg" id="inputPrijava" placeholder="Datum prijave" name="datum_prijave">
                        </div>
                        {{---DATUM-ODJAVE--}}
                        <div class="form-group has-icon-left form-control-email">
                            <label class="sr-only" for="inputOdjava">Datum prijave</label>
                            <input type="text" class="form-control form-control-lg" id="inputOdjava" placeholder="Datum odjave" name="datum_odjave">
                        </div>
                        {{---BOJ-OSOBA--}}
                        <div class="form-group has-icon-left form-control-name">
                            <label class="sr-only" for="inputBrojosoba">Broj osoba</label>
                            {!!Form::select('broj_osoba',[1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>11,12=>12],null,['id'=>'inputBrojosoba','class'=>'form-control form-control-lg','placeholder'=>'Broj osoba'])!!}
                        </div>
                    </div>
                    <div class="col-sm-3 tagovi">
                        <h2>Svrha</h2>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-tag="#turizam">
                                <span class="c-indicator"></span> Turizam</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-tag="#posao">
                                <span class="c-indicator"></span> Posao</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-tag="#odmor">
                                <span class="c-indicator"></span> Odmor</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-tag="#zimovanje">
                                <span class="c-indicator"></span> Zimovanje</a>
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-3 dodaci">
                        <h2>Dodaci</h2>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-dodatak="bazen">
                                <span class="c-indicator"></span> Bazen</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-dodatak="restoran">
                                <span class="c-indicator"></span> Restoran</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-dodatak="teretana">
                                <span class="c-indicator"></span> Teretana</a>
                            </label>
                        </div>
                        <div class="form-group">
                            <label class="c-input c-checkbox">
                                <input type="checkbox" data-dodatak="fitnes">
                                <span class="c-indicator"></span> Fitnes</a>
                            </label>
                        </div>
                    </div>
                    <br clear="all">
                    <br clear="all">
                    {!!Form::hidden('tagovi')!!}
                    {!!Form::hidden('dodaci')!!}
                    <button class="btn btn-secondary-outline m-b-2" role="button"><span class="pull-xs-left icon-search"></span>Pronađi!</button>
                </div>
                {!!Form::close()!!}
            </div>
            <ul class="nav nav-inline social-share">
                <li class="nav-item"><a class="nav-link" href="#"><span class="icon-twitter"></span> 1024</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><span class="icon-facebook"></span> 562</a></li>
                <li class="nav-item"><a class="nav-link" href="#"><span class="icon-linkedin"></span> 356</a></li>
            </ul>
        </div>
    </header>
    {{---pocetna::end--}}

    {{---WEB-PLATFORMA::START--}}
    <section id="web-platforma" class="section-intro bg-faded text-xs-center">
        <div class="container">
            <h3 class="wp wp-1">Ne morate biti programer da biste kreirali web aplikaciju!</h3>
            <p class="wp wp-2">što predstavlja <b>novitet</b> u web okruženju i <b>pomera granice</b> modernog poslovanje</p>
            <img src="/templejt/master/img/mock.png" alt="iPad mock" class="img-fluid wp wp-3">
        </div>
    </section>
    {{---web-platforma::end--}}

    {{---MOGUCNOSTI::START--}}
    <section class="section-features text-xs-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-block">
                            <span class="icon-pen display-1"></span>
                            <h4 class="card-title">5</h4>
                            <h6 class="card-subtitle text-muted">Minuta</h6>
                            <p class="card-text">Vreme potrebno za <b>registraciju</b> profila i podešavanje Vaše aplikacije. Za to vreme popunićete podatke o Vašem smeštaju, dodati opis, fotografije, a sistem će za Vas da <b>kreira web sajt</b>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-block">
                            <span class="icon-thunderbolt display-1"></span>
                            <h4 class="card-title">Rezervacije</h4>
                            <h6 class="card-subtitle text-muted">Putem Vašeg sajta</h6>
                            <p class="card-text">Uključite opciju <u>rezervacije putem sajta</u> i imajte uvid u stanje vaših smeštaja gde god da se nalazite, a sistem će da Vam omogući pregled <b>statističkih</b> podataka, radi donošenja ispravnih <b>odluka</b>.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card m-b-0">
                        <div class="card-block">
                            <span class="icon-heart display-1"></span>
                            <h4 class="card-title">Besplatan</h4>
                            <h6 class="card-subtitle text-muted">Prvi mesec korištenja</h6>
                            <p class="card-text">Omogućili smo <b>besplatan</b> prvi mesec korištenja platforme, gde možete da isprobate sve funkcionalnosti i uverite se u opravdanost naših <b>garancija kvaliteta</b>, usluge i podrške.</p>
                        </div>
                    </div>
                </div>

                <br clear="all">
                <br clear="all">
                <br clear="all">
                <div class="col-md-4">
                    <div class="card m-b-0">
                        <div class="card-block">
                            <span class="icon-heart display-1"></span>
                            <h4 class="card-title">Business</h4>
                            <h6 class="card-subtitle text-muted">Poslovni model</h6>
                            <p class="card-text">Za Vas smo kreirali <b>sistem izveštavanja</b> po različitim kriterijumima na osnovu kojih ćete donositi bolje poslovne odluke.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card m-b-0">
                        <div class="card-block">
                            <span class="icon-heart display-1"></span>
                            <h4 class="card-title">Refaktorizacija</h4>
                            <h6 class="card-subtitle text-muted">Stalni razvoj platforme</h6>
                            <p class="card-text">U cilju očuvanja tržišne <b>jedinstvenosti</b> i razvoju u skladu sa najnovijim <b>standardima</b>, radimo na konstantnom unapređenju sistema.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card m-b-0">
                        <div class="card-block">
                            <span class="icon-heart display-1"></span>
                            <h4 class="card-title">Podrška</h4>
                            <h6 class="card-subtitle text-muted">Stručnog tima</h6>
                            <p class="card-text">Podršku ćete dobijati od <b>razvojnog tima</b> što predstavlja korak napred na polju korisničke interakcije i <b>kvaliteta</b> iste.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{---mogucnosti::end--}}

    {{---PROMO-VIDEO::START--}}
    <section class="section-video bg-inverse text-xs-center wp wp-4">
        <h3 class="sr-only">Video</h3>
        <figure id="demo_video" class="has-light-mask">
            <a id="youtube-trigger" class="icon-play-button" href="#" data-toggle="modal" data-target="#youtubeModal" data-video="https://www.youtube.com/v/X9dsXjIyyrI">
                <span class="icon-play"></span>
            </a>
            <img class="img-fluid img-fluid-custom" src="/templejt/master/img/v3.jpg" alt="Video poster">
        </figure>
    </section>
    <div class="modal fade" id="youtubeModal" tabindex="-1" role="dialog" aria-labelledby="youtubeModal" aria-hidden="true">
        <div class="modal-dialog modal-video" role="document">
            <div class="modal-content">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe id="youtube-play" class="embed-responsive-item" src="" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    {{---promo-video::end--}}

    {{---TARIFE:START--}}
    <section id="cene" class="section-pricing bg-faded text-xs-center">
        <div class="container">
            <h3>Opredelite se za jedan od tarifnih paketa</h3>
            <div class="row p-y-3">
                <div class="col-md-4 p-t-md wp wp-5">
                    <div class="card pricing-box">
                        <div class="card-header text-uppercase">
                            Demo
                        </div>
                        <div class="card-block">
                            <p class="card-title">U demo okruženju isprobajte punu funkcionalnost.</p>
                            <h4 class="card-text">
                                <sup class="pricing-box-currency">&euro;</sup>
                                <span class="pricing-box-price">0</span>
                                <small class="text-muted text-uppercase">/mesečno</small>
                            </h4>
                        </div>
                        <ul class="list-group list-group-flush p-x">
                            <li class="list-group-item">Demo web sajt</li>
                            <li class="list-group-item">Demo rezervacije</li>
                            <li class="list-group-item">Demo podaci</li>
                        </ul>
                        <a href="#" class="btn btn-primary-outline">Prijavi se</a>
                    </div>
                </div>
                <div class="col-md-4 stacking-top">
                    <div class="card pricing-box pricing-best p-x-0">
                        <div class="card-header text-uppercase">
                            PRO
                        </div>
                        <div class="card-block">
                            <p class="card-title">Ukoliko se odlučite za PRO paket dobićete <b>besplatno</b> vođenje Vašeg sajta.</p>
                            <h4 class="card-text">
                                <sup class="pricing-box-currency">&euro;</sup>
                                <span class="pricing-box-price">7.99</span>
                                <small class="text-muted text-uppercase">/mesečno</small>
                            </h4>
                        </div>
                        <ul class="list-group list-group-flush p-x">
                            <li class="list-group-item">Web sajt</li>
                            <li class="list-group-item"><b>Vođenje sajta</b></li>
                            <li class="list-group-item">Rezervacije</li>
                            <li class="list-group-item">Statistički podaci</li>
                        </ul>
                        <a href="#" class="btn btn-primary">Prijavi se</a>
                    </div>
                </div>
                <div class="col-md-4 p-t-md wp wp-6">
                    <div class="card pricing-box">
                        <div class="card-header text-uppercase">
                            BASIC
                        </div>
                        <div class="card-block">
                            <p class="card-title">Osnovni paket će zadovoljiti sve Vaše potrebe.</p>
                            <h4 class="card-text">
                                <sup class="pricing-box-currency">&euro;</sup>
                                <span class="pricing-box-price">4.99</span>
                                <small class="text-muted text-uppercase">/mesečno</small>
                            </h4>
                        </div>
                        <ul class="list-group list-group-flush p-x">
                            <li class="list-group-item">Web sajt</li>
                            <li class="list-group-item">Rezervacije</li>
                            <li class="list-group-item">Statistički podaci</li>
                        </ul>
                        <a href="#" class="btn btn-primary-outline">Prijavi se</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{---tarife:end--}}

    {{---RIJEC-KREATORA:START--}}
    <section class="section-testimonials text-xs-center bg-inverse">
        <div class="container">
            <h3 class="sr-only">Testimonials</h3>
            <div id="carousel-testimonials" class="carousel slide" data-ride="carousel" data-interval="0">
                <div class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <blockquote class="blockquote">
                            <img src="/templejt/master/img/dusan-perisic.jpg" height="80" width="80" alt="Avatar"
                                 class="img-circle">
                            <p class="h3">Izgradili smo sistem prilagodljiv tipu korisnika i spojili prezentacioni i biznis model u celinu.</p>
                            <footer>Dušan Perišić dipl.inž.</footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <img src="/templejt/master/img/sasa-jovic.jpg" height="80" width="80" alt="Avatar"
                                 class="img-circle">
                            <p class="h3">Funkcionalna organizacija doprinosi izuzetnoj pouzdanosti i skalabilnosti sistema.</p>
                            <footer>Saša Jović dipl.inž.</footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <img src="/templejt/master/img/aleksandar-jovic.jpg" height="80" width="80" alt="Avatar"
                                 class="img-circle">
                            <p class="h3"><i>User friendly</i> korisnički interfejs građen je prema intuitivnom modeli, pa će se i korisnici sa osnovnim znanjem rada na računaru odlično snalaziti.</p>
                            <footer>Aleksandar Jović dipl.inž.</footer>
                        </blockquote>
                    </div>
                    <div class="carousel-item">
                        <blockquote class="blockquote">
                            <img src="/templejt/master/img/goran-spasic.jpg" height="80" width="80" alt="Avatar"
                                 class="img-circle">
                            <p class="h3">Od sada mi brinemo o popularnosti Vašeg sajta.</p>
                            <footer>Goran Spasić dipl.ecc.</footer>
                        </blockquote>
                    </div>
                </div>
                <ol class="carousel-indicators">
                    <li class="active">
                        <img src="/templejt/master/img/dusan-perisic.jpg" alt="Navigation avatar" data-target="#carousel-testimonials" data-slide-to="0" class="img-fluid img-circle">
                    </li>
                    <li>
                        <img src="/templejt/master/img/sasa-jovic.jpg" alt="Navigation avatar" data-target="#carousel-testimonials" data-slide-to="1" class="img-fluid img-circle">
                    </li>
                    <li>
                        <img src="/templejt/master/img/aleksandar-jovic.jpg" alt="Navigation avatar"
                             data-target="#carousel-testimonials" data-slide-to="2" class="img-fluid img-circle">
                    </li>
                    <li>
                        <img src="/templejt/master/img/goran-spasic.jpg" alt="Navigation avatar"
                             data-target="#carousel-testimonials" data-slide-to="3" class="img-fluid img-circle">
                    </li>
                </ol>
            </div>
        </div>
    </section>
    {{---rijec-kreatora::end--}}

    {{---DESTINACIJE:START--}}
    <section id="destinacije" class="section-text">
        <div class="container">
            <h3 class="text-xs-center">Pronađite smeštaj u najegzotičnijim lokacijama</h3>
            <div class="row p-y-3">
                <div class="col-md-5">
                    <p class="wp wp-7">Platforma najSmeštaj raspolaže pojedinim elementima sistema <b>veštačke inteligencije</b> i po određenim kriterijumima se prilagođava tipu korisnika, što je trenutno aktuelni novitet u interakciji platorme sa korisnikom. Pretraga je poboljšana naprednim filterima, gde možete da izaberete šta vaš <u>smeštaj treba da zadovolji</u>, kao i koje <u>znamenitosti i objekti se nalaze u mestu</u> u kojem je lociran. <b>Imate izbora, budite kontrolor svog vremena!</b></p>
                </div>
                <div class="col-md-5 col-md-offset-2 separator-x">
                    <p class="wp wp-8">Za Vas smo <b>pripremili</b> i konstantno vršimo dogradnju liste destinacija za <u>odmor, rekreaciju, poslovna putovanja, lokalne i međunarodne sastanke</u>. U mestima u kojima se nalazi smeštaj označili smo <u>zanimljive kulturno-istorijske znamenitosti, sportsko rekreativne i druge kapacitete</u>, pa pre nego se odlučite da krenete možete da <b>rezervišete smeštaj</b> i <b>upoznate</b> sa mestom i mogućnostima istog.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="section-news">
        <div class="container">
            <h3 class="sr-only">News</h3>
            <div class="bg-inverse">
                <div class="row">
                    <div class="col-md-6 p-r-0">
                        <figure class="has-light-mask m-b-0 image-effect">
                            <img src="/templejt/master/img/m1.jpg"
                                 alt="Article thumbnail" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-md-6 p-l-0">
                        <article class="center-block">
                            <span class="label label-info">Naša preporuka</span>
                            <br>
                            <h5><a href="#">Organizujte poslovni meeting! <span class="icon-arrow-right"></span></a></h5>
                            <p class="m-b-0">
                                <a href="#"><span class="label label-default text-uppercase"><span class="icon-tag"></span> Business</span></a>
                                <a href="#"><span class="label label-default text-uppercase"><span class="icon-time"></span> {{round(abs(strtotime('2016-06-19 12:50')-strtotime(date('Y-m-d H:i')))/340)}} sati ranije</span></a>
                            </p>
                        </article>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-md-push-6 p-l-0">
                        <figure class="has-light-mask m-b-0 image-effect">
                            <img src="/templejt/master/img/t2.jpg"
                                 alt="Article thumbnail" class="img-fluid">
                        </figure>
                    </div>
                    <div class="col-md-6 col-md-pull-6 p-r-0">
                        <article class="center-block">
                            <span class="label label-info">Naša preporuka</span>
                            <br>
                            <h5><a href="#">Turistička tura za Vas! <span class="icon-arrow-right"></span></a></h5>
                            <p class="m-b-0">
                                <a href="#"><span class="label label-default text-uppercase"><span class="icon-tag"></span> Tour</span></a>
                                <a href="#"><span class="label label-default text-uppercase"><span class="icon-time"></span> {{round(abs(strtotime('2016-06-18 11:00')-strtotime(date('Y-m-d H:i')))/340)}} sati ranije</span></a>
                            </p>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{---destinacije:end--}}
    {{---NEWSLETTER:START--}}
    <section class="section-signup bg-faded">
        <div class="container">
            <h3 class="text-xs-center m-b-3">Prijavi se na mejling listu i prati najposećenija mesta!</h3>
            <form>
                <div class="row" style="text-align: center">
                    <div class="col-md-6 col-xl-4">
                        <div class="form-group has-icon-left form-control-name">
                            <label class="sr-only" for="inputIme">Ime</label>
                            <input type="text" class="form-control form-control-lg" id="inputIme" placeholder="Ime">
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="form-group has-icon-left form-control-email">
                            <label class="sr-only" for="inputEmail">Email</label>
                            <input type="email" class="form-control form-control-lg" id="inputEmail"
                                   placeholder="Email adresa" autocomplete="off">
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-primary btn-block newsletterBtn">Prijava!</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    {{---newsletter:end--}}
@endsection

@section('end-script')
    {!! Html::style('/css/datetimepicker.css') !!}
    {!!Html::script('/js/moment.js')!!}
    {!! Html::script('/js/datetimepicker.js') !!}
    <script>
        $(function(){
            $(".scrol a,.scrol").on('click', function(event){
                if($(this.hash).offset())
                    event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 900, function(){
                    window.location.hash = hash
                })
            });
            $('#inputPrijava').datetimepicker();
            $('#inputOdjava').datetimepicker();
            $('#inputPrijava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
            $('#inputOdjava').data('DateTimePicker').locale('sr').format('YYYY-MM-DD');
            $('.newsletterBtn').click(function(){
                $('#poruka').remove();
                var ime=$('#inputIme').val(),
                    email=$('#inputEmail').val();
                if(!ime || !email){
                    $($(this).closest('form').append('<div id="poruka"><h2>Dogodila se greška! Proverite podatke i pokušajte ponovo!</h2></div>'));
                    return
                }
                $.post('/newsletter',{
                    _token:'{{csrf_token()}}',
                    ime:ime,
                    email:email
                },function(data){
                    data=JSON.parse(data);
                    $($(this).closest('form').append('<div id="poruka"><h2>'+data.poruka+'</h2></div>'));
                    if(data.check==1){
                        $('#inputIme').val('');
                        $('#inputEmail').val('')
                    }
                })
            });
            $('.tagovi input[type=checkbox]').change(function(){
                if(!$(this).data('tag')) return;
                var tagovi=$('.tagovi input[type=checkbox]'),tagoviArray=[];
                for(var i=0,max=tagovi.length; i<max; i++)
                    if($(tagovi[i]).prop('checked')) tagoviArray.push($(tagovi[i]).data('tag'));
                $('input[name=tagovi]').val(JSON.stringify(tagoviArray))
            })
            $('.dodaci input[type=checkbox]').change(function(){
                if(!$(this).data('dodatak')) return;
                var dodaci=$('.dodaci input[type=checkbox]'),dodaciArray=[];
                for(var i=0,max=dodaci.length; i<max; i++)
                    if($(dodaci[i]).prop('checked')) dodaciArray.push($(dodaci[i]).data('dodatak'));
                $('input[name=dodaci]').val(JSON.stringify(dodaciArray))
            })
        });
    </script>
@endsection