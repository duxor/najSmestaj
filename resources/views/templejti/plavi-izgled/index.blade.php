<!DOCTYPE html>
<html lang="en" class="wide smoothscroll wow-animation desktop landscape rd-navbar-static-linked">

{{---
         _____ _ _ __\/_____ __ _   ___ ___ ___ _ __\/___ _/___
        |_    | | |  ___/   |  \ | |   | __|   | |  ___/ |  __/
         _| | | | |___  | ^ | |  | | ^_| __| ^_| |___  | | |__
        |_____|_,_|_____|_|_|_|__| |_| |___|_|\ _|_____|_|____|

        Hvala što se interesujete za kod :)

        Kontakt za developere: kontakt@dusanperisic.com

--}}
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    {{-- Site Title --}}
    <title>{{$podaci->naziv}}</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    {{-- Stylesheets --}}
    {{--<link href="/templejt/plavi-izgled/css/font.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/templejt/plavi-izgled/css/style.css">--}}
    <link rel="stylesheet" href="/templejt/plavi-izgled/css/master.min.css">
    <![if lt IE 10]>
        <script async src="/templejt/plavi-izgled/js/html5shiv.min.js"></script>
    <![endif]>
</head>
<body>
{{---GLAVNI-DIV--}}
<div class="page">
    {{---HEADER::START--}}
    <header class="page-header">
        {{---NAVBAR::START--}}
        <div class="rd-navbar-wrap">
            <nav class="rd-navbar rd-navbar-static" data-rd-navbar-lg="rd-navbar-static">
                <div class="rd-navbar-inner">
                    {{---NAVBAR-PANEL::START--}}
                    <div class="rd-navbar-panel">
                        {{--NAVBAR-TOGGLE--}}
                        <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar"><span></span></button>
                        {{---NAVBAR-BRAND--}}
                        <div class="rd-navbar-brand">
                            <a href="/{{$podaci->slug}}" class="brand-name">
                                    {{--<img src="{{$podaci->logo?$podaci->logo:'/img/logo-demo-sm.png'}}" alt="Logo" class="img-responsive logo">--}}
                                    <span>{{$podaci->naziv}}</span>
                            </a>
                        </div>
                    </div>
                    {{---navbar-panel::end--}}
                    <div class="rd-navbar-nav-wrap">
                        {{---NAVBAR-NAV::START--}}
                        <ul class="rd-navbar-nav">
                            {{---POCETNA--}}
                            <li class="active">
                                <a href="/{{$podaci->slug}}">Početna</a>
                            </li>
                            {{---O-NAMA--}}
                            <li>
                                <a href="{{$slug=Request::segment(2) == ''?'':'/'.$podaci->slug.'/'}}#o-nama">O nama</a>
                            </li>
                            {{---GALERIJA--}}
                            <li>
                                <a href="{{$slug}}#galerija">Galerija</a>
                            </li>
                            {{---NAS-TIM--}}
                            <li>
                                <a href="{{$slug}}#nas-tim">Naš tim</a>
                            </li>
                            {{---LOKACIJA--}}
                            <li>
                                <a href="{{$slug}}#lokacija">Kako do nas?</a>
                            </li>
                        </ul>
                        {{---navbar-nav::end--}}

                        {{---NAVBAR-CONTACT::START--}}
                        <ul class="rd-navbar-inline-list">
                            <li><a class="icon icon-xs icon-primary fa-facebook-f" data-toggle="modal" data-target="#kontaktModal" data-show="#facebook"></a></li>
                            <li><a class="icon icon-xs icon-primary fa-instagram" data-toggle="modal" data-target="#kontaktModal" data-show="#instagram"></a></li>
                            <li><a class="icon icon-xs icon-primary fa-envelope" data-toggle="modal" data-target="#kontaktModal" data-show="#forma"></a></li>
                            <li><a class="icon icon-xs icon-primary fa-skype" data-toggle="modal" data-target="#kontaktModal" data-show="#skype"></a></li>
                            <li class="big">
                                <span class="icon icon-xs icon-primary fa-phone line-height-2"></span>
                                <a href="callto:#" class="letter-spacing-normal line-height-2 letter-spacing-middle-negative">{{$podaci->telefon}}</a>
                            </li>
                        </ul>
                        {{---navbar-contact::end--}}
                    </div>
                </div>
            </nav>
        </div>
        {{---navbar::end--}}
    </header>
    {{---header::end--}}

    {{---KONTAKT-MODAL::START--}}
    <div id="kontaktModal" class="modal">
        <div class="modal-dialog">
            <div class="close" data-dismiss="modal">&times;</div>
            <div id="forma" class="modal-element">
                <h2>Pošaljite nam poruku</h2>
                <div class="form-group">
                    <div class="label">
                        <label>Vaše ime</label>
                    </div>
                    <div class="input">
                        <input name="ime" placeholder="Vaše ime">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>E-mail</label>
                    </div>
                    <div class="input">
                        <input name="email" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>Telefon</label>
                    </div>
                    <div class="input">
                        <input name="telefon" placeholder="Telefon">
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label>Poruka</label>
                    </div>
                    <div class="input">
                        <textarea name="poruka" placeholder="Poruka"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="label">
                        <label></label>
                    </div>
                    <div class="input">
                        <button id="saljiNam" class="btn btn-md btn-primary">Pošalji</button>
                    </div>
                </div>
                <br clear="all">
            </div>
            <div id="facebook" class="modal-element">
                <h1><i class="fa-facebook-f"></i> Facebook</h1>
                <p><a class="btn btn-md btn-primary">Posetite</a> našu facebook stranicu</p>
            </div>
            <div id="skype" class="modal-element">
                <h1><i class="fa-skype"></i> Skype</h1>
                <p>Naš skype nickname je <a href="callto:#"><b>PomeranacBG</b></a></p>
            </div>
            <div id="instagram" class="modal-element">
                <h1><i class="fa-instagram"></i> Instagram</h1>
                <p>Pratite nas i na instagramu pod niknejmom <a href="callto:#"><b>PomeranianBG</b></a></p>
            </div>
            <div id="uspjeh" class="modal-element"></div>
        </div>
    </div>
    {{---kontakt-modal::end--}}

    {{---CONTENT::START--}}
    <main class="page-content">
            {{---SLAJDER::START--}}
            <section class="with-bg skew skew__deg-1">
                <div class="skew_sub-1">
                    <div class="skew_sub-2">
                        <div class="skew_bg bg-contrast"></div>
                    </div>
                </div>
                <div class="skew_cnt">
                    {{---SLAJDOVI::START--}}
                    <div class="swiper-container swiper-slider swiper-container-horizontal" data-height="34.09756097560976%" data-min-height="600px" data-loop="true" style="height: 600px;">
                        <div class="swiper-wrapper text-center text-md-left" style="transition-duration: 0ms; transform: translate3d(-5052px, 0px, 0px);">
                            {{--@foreach($templejt->slajder as $i=>$slajd)
                                <div class="swiper-slide" data-slide-bg="{{$slajd->img}}" data-swiper-slide-index="{{$i}}">
                                    <div class="swiper-slide-caption">
                                        <div class="container position-relative z-index-1">
                                            <div class="row">
                                                <div class="col-md-preffix-5 col-md-7">
                                                    <h1>{{$slajd->title}}</h1>
                                                    <p class="big">{{$slajd->subtitle}}</p>
                                                    <a href="" class="btn btn-md btn-primary">
                                                        čitaj dalje
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach--}}
                            {{--TEST::START--}}
                            <div class="swiper-slide" data-slide-bg="/img/default/slider/1.jpg" data-swiper-slide-index="0">
                                <div class="swiper-slide-caption">
                                    <div class="container position-relative z-index-1">
                                        <div class="row">
                                            <div class="col-md-preffix-5 col-md-7">
                                                <h1>NASLOV</h1>
                                                <p class="big">PODNASLOV</p>
                                                <a href="" class="btn btn-md btn-primary">
                                                    čitaj dalje
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-slide-bg="/img/default/slider/2.jpg" data-swiper-slide-index="1">
                                <div class="swiper-slide-caption">
                                    <div class="container position-relative z-index-1">
                                        <div class="row">
                                            <div class="col-md-preffix-5 col-md-7">
                                                <h1>NASLOV</h1>
                                                <p class="big">PODNASLOV</p>
                                                <a href="" class="btn btn-md btn-primary">
                                                    čitaj dalje
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide" data-slide-bg="/img/default/slider/3.jpg" data-swiper-slide-index="2">
                                <div class="swiper-slide-caption">
                                    <div class="container position-relative z-index-1">
                                        <div class="row">
                                            <div class="col-md-preffix-5 col-md-7">
                                                <h1>NASLOV</h1>
                                                <p class="big">PODNASLOV</p>
                                                <a href="" class="btn btn-md btn-primary">
                                                    čitaj dalje
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--test::end--}}
                        </div>
                        {{-- Swiper Pagination --}}
                        <div class="swiper-pagination swiper-pagination-clickable">
                            <span class="swiper-pagination-bullet swiper-pagination-bullet-active"></span>
                            <span class="swiper-pagination-bullet"></span>
                            <span class="swiper-pagination-bullet"></span>
                        </div>
                    </div>
                    {{---slajdovi::end--}}
                </div>
            </section>
            {{---slajder::end--}}

            {{---DOBRO-NAM-DOSLI::START--}}
            <section class="with-bg bg-image bg-image-1 skew__deg-1_after-inset">
                <div class="container well-md text-center">
                    <h2 class="text-primary dobro" data-pocetna="1">
                        Dobro nam doošli!
                    </h2>
                    <h6 class="text-regular"><span class="text-grayscale-darker">Ukoliko ne nađete sve potrebne informacije na našoj web platformi budite slobodni da nas pozovete na broj</span><a href="callto:#" class="preffix-2 text-primary">+381 00 000000</a></h6>
                    <p>
                        Neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text <span class="text-primary">naglašen slog naglašen slog</span> neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text neki text <span class="text-primary">naglašen slog naglašen slog</span> neki text neki text neki text neki text neki text neki text neki text neki text.
                    </p>

                    <a href="/o-nama" class="btn btn-md btn-primary">
                        čitaj dalje
                    </a>
                </div>
            </section>
            {{---dobro-nam-dosli::end--}}

            {{---ČIME-SE-BAVIMO::START--}}
            <section class="with-bg skew skew__deg-2">
                <div class="skew_sub-1">
                    <div class="skew_sub-2">
                        <div class="skew_bg bg-contrast"></div>
                    </div>
                </div>
                <div class="skew_cnt container well-lg">
                    <div class="row row-sm-center row-no-gutter inset-1 text-center">
                        <div class="col-sm-7 col-lg-4">
                            <div class="box-skin box-skin-default">
                                <div class="box-skin__body box-skin__body-default">
                                    <span class="icon icon-default icon-lg fa-line-chart"></span>
                                    <h4 class="devider letter-spacing-big">
                                        Višegodišnje <br class="br-md">
                                        iskustvo
                                    </h4>
                                    <p class="small-4">
                                        Već dugi niz godina bavimo se uslužnim delatnostima dugi niz godina bavimo se uslužnim delatnostima dugi niz godina bavimo se uslužnim delatnostima dugi niz godina bavimo se uslužnim delatnostima
                                    </p>
                                    <a href="/{{$podaci->slug}}/o-nama" class="link link-md link-default fa-long-arrow-right"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-4">
                            <div class="box-skin box-skin-default">
                                <div class="box-skin__body box-skin__body-default">
                                    <span class="icon icon-default icon-lg  fa-users"></span>
                                    <h4 class="devider letter-spacing-big">
                                        Profesionalno <br class="br-md">
                                        osoblje
                                    </h4>
                                    <p class="small-4">
                                        Tokom dugogodišnjeg rada naš tim je stekao ogromno iskustvo u radu dugogodišnjeg rada naš tim je stekao ogromno iskustvo u radu dugogodišnjeg rada naš tim je stekao ogromno iskustvo u radu
                                    </p>
                                    <a href="/{{$podaci->slug}}/o-nama" class="link link-md link-default fa-long-arrow-right"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-lg-4">
                            <div class="box-skin box-skin-default">
                                <div class="box-skin__body box-skin__body-default">
                                    <span class="icon icon-default icon-lg fa-thumbs-o-up"></span>
                                    <h4 class="devider letter-spacing-big">
                                        Zadovoljni <br class="br-md">
                                        korisnici
                                    </h4>
                                    <p class="small-4">
                                        Najbolji merodavni pokazatelj uspeha su naši zadovoljni korisnicimerodavni pokazatelj uspeha su naši zadovoljni korisnicimerodavni pokazatelj uspeha su naši zadovoljni korisnicimerodavni pokazatelj uspeha su naši zadovoljni korisnicimerodavni pokazatelj uspeha su naši zadovoljni korisnici
                                    </p>
                                    <a href="/{{$podaci->slug}}/o-nama" class="link link-md link-default fa-long-arrow-right"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{---čime-se-bavimo::end--}}

            {{---PONUDA::START--}}
                <section class="with-bg bg-image bg-image-2 bg-primary skew__deg-2_after-inset">
                    <div class="container well-md text-center text-md-left">
                        <h3 class="text-center">
                            šta imamo u ponudi
                        </h3>
                        <div class="row row-xs-center flow-offset-1">
                            <div class="col-sm-6 col-md-4">
                                <div class="box-skin-1">
                                    <span class="icon icon-sm icon-primary fa-home"></span>
                                    <h4 class="devider letter-spacing-middle">Soba</h4>
                                    <p class="small-4">
                                        Kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis
                                    </p>
                                    <a href="#slug" class="btn btn-sm btn-primary">
                                        čitaj dalje
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="box-skin-1">
                                    <span class="icon icon-sm icon-primary fa-home"></span>
                                    <h4 class="devider letter-spacing-middle">Neka druga soba</h4>
                                    <p class="small-4">
                                        Kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis
                                    </p>
                                    <a href="#slug" class="btn btn-sm btn-primary">
                                        čitaj dalje
                                    </a>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <div class="box-skin-1">
                                    <span class="icon icon-sm icon-primary fa-home"></span>
                                    <h4 class="devider letter-spacing-middle">Neka treća soba</h4>
                                    <p class="small-4">
                                        Kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis kratak opis
                                    </p>
                                    <a href="/o-rasi" class="btn btn-sm btn-primary">
                                        čitaj dalje
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            {{---ponuda::end--}}

            {{--GALERIJA::START--}}
                {{--@if($templejt->galerija->img)--}}
                <section class="well-md well-md--inset-2">
                    <div class="container">
                        <h3 class="text-center">Iz galerije izdvajamo</h3>
                    </div>
                    <div class="row row-no-gutter" data-lightbox="gallery">
                        {{--@foreach($templejt->galerija->img as $img)
                            <a class="thumb mfp-image" data-lightbox="image" href="{{$img}}">
                                <img src="{{$img}}" width="256" height="300" alt="Fotografija iz galerije">
                                <span class="thumb__overlay"></span>
                            </a>
                        @endforeach--}}
                        {{--TEST::START--}}
                        <a class="thumb mfp-image" data-lightbox="image" href="/img/default/slider/1.jpg">
                            <img src="/img/default/slider/1.jpg" width="256" height="300" alt="Fotografija iz galerije">
                            <span class="thumb__overlay"></span>
                        </a>
                        <a class="thumb mfp-image" data-lightbox="image" href="/img/default/slider/2.jpg">
                            <img src="/img/default/slider/2.jpg" width="256" height="300" alt="Fotografija iz galerije">
                            <span class="thumb__overlay"></span>
                        </a>
                        <a class="thumb mfp-image" data-lightbox="image" href="/img/default/slider/3.jpg">
                            <img src="/img/default/slider/3.jpg" width="256" height="300" alt="Fotografija iz galerije">
                            <span class="thumb__overlay"></span>
                        </a>
                        {{--test::end--}}
                    </div>
                </section>
                {{--@endif--}}
            {{--galerija::end--}}

            {{--NAŠ-TIM::START--}}
                <section class="with-bg skew skew__deg-3" style="z-index: 1">
                    <div class="skew_sub-1">
                        <div class="skew_sub-2">
                            <div class="skew_bg bg-contrast"></div>
                        </div>
                    </div>
                    <div class="skew_cnt text-center container well-xs">
                        <h3>Upoznajte tim</h3>
                        <p class="small-5 text-primary letter-spacing-normal">Ovo je naš tim profesionalaca koji se brinu da sve bude kako treba je naš tim profesionalaca koji se brinu da sve bude kako treba je naš tim profesionalaca koji se brinu da sve bude kako treba</p>
                        <div class="row text-md-left">
                            {{---TIM-SLJDOVI::START--}}
                            <div class="owl-carousel">
                                {{--@foreach($templejt->nas_tim->lica as $clan)
                                    <div class="item">
                                        <img src="{{$clan->img}}" alt="Fotografija {{$clan->ime}}">
                                        <p class="small-5 offset-1 text-grayscale-darker text-regular">{{$clan->ime}}</p>
                                        --}}{{--<p class="small-2 text-primary offset-2">{{$clan['duznost']}}</p>--}}{{--
                                    </div>
                                @endforeach--}}
                                {{--TEST::START--}}
                                <div class="item">
                                    <img src="/img/default/korisnik.jpg" alt="Fotografija Ime Prezime">
                                    <p class="small-5 offset-1 text-grayscale-darker text-regular">Ime Prezime</p>
                                </div>
                                <div class="item">
                                    <img src="/img/default/korisnik.jpg" alt="Fotografija Ime Prezime">
                                    <p class="small-5 offset-1 text-grayscale-darker text-regular">Ime Prezime</p>
                                </div>
                                <div class="item">
                                    <img src="/img/default/korisnik.jpg" alt="Fotografija Ime Prezime">
                                    <p class="small-5 offset-1 text-grayscale-darker text-regular">Ime Prezime</p>
                                </div>
                                <div class="item">
                                    <img src="/img/default/korisnik.jpg" alt="Fotografija Ime Prezime">
                                    <p class="small-5 offset-1 text-grayscale-darker text-regular">Ime Prezime</p>
                                </div>
                                <div class="item">
                                    <img src="/img/default/korisnik.jpg" alt="Fotografija Ime Prezime">
                                    <p class="small-5 offset-1 text-grayscale-darker text-regular">Ime Prezime</p>
                                </div>
                                {{--test::end--}}
                            </div>
                            {{---tim-slajdovi::end--}}
                        </div>
                    </div>
                </section>
            {{--naš-tim::end--}}

            {{--LOKACIJA-NA-MAPI::START--}}
                <div class="rd-google-map">
                    <div class="border-bottom"></div>
                    <div id="google-map" class="rd-google-map__model lazy-loaded" data-zoom="14" data-x="-73.9874068" data-y="40.643180" style="position: relative; overflow: hidden; transform: translateZ(0px); background-color: rgb(229, 227, 223);">
                        <div class="gm-style" style="position: absolute; left: 0px; top: 0px; overflow: hidden; width: 100%; height: 100%; z-index: 0;">
                            <div id="map" style="width:100%;height:100%"></div>
                        </div>
                    </div>
                </div>
            {{--lokacija-na-mapi::end--}}
        </main>
    {{---content::end--}}

        {{---FOOTER::START--}}
        <footer class="page-footer">
            <div class="container">
                <p class="text-center text-md-left">
                    <a href="/">Zubolog</a> © {{date('Y')}} zadržavamo sva prava, izrada <a href="http://dusanperisic.com" class="text-primary">DevTeam</a>
                </p>
            </div>
        </footer>
        {{---footer::end--}}
    </div>

    <script>var __token='{{csrf_token()}}';</script>
    <script src="/templejt/plavi-izgled/js/master.min.js"></script>

</body>
</html>