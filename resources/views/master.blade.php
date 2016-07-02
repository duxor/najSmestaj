<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>najSmeštaj</title>
    <meta name="description" content="Platforma za brzo i lako kreiranje lične web prezentacije i reklamiranje Vašeg smeštaja. U samo nekoliko koraka registrujte se i iskoristite naš promotivni period testiranja platforme.">
    <meta name="keywords" content="smaštaj, hotel, hostel, sobe, najsmestaj">
    <meta name="theme-color" content="#663fb5">
    <script src="/templejt/master/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/templejt/master/css/style.css">
</head>
<body>
    {{---NAVIGACIJA::START--}}
    <nav class="navbar {{($test=Request::segment(1)) == ''?'navbar-dark bg-inverse-custom bg-inverse navbar-fixed-top':'bg-white'}}">
        <div class="container">
            {{---LOGO--}}
            <a class="navbar-brand col-xs-3" href="/">
                <span class="icon-home"></span>
                <h3><b><span class="icon-office"></span> najSmeštaj</b></h3>
                <span class="sr-only">NajSmeštaj</span>
            </a>
            <a class="navbar-toggler hidden-md-up pull-xs-right" data-toggle="collapse" href="#collapsingNavbar" aria-expanded="false" aria-controls="collapsingNavbar">&#9776;</a>
            <a class="navbar-toggler navbar-toggler-custom hidden-md-up pull-xs-right" data-toggle="collapse" href="#collapsingMobileUser" aria-expanded="false" aria-controls="collapsingMobileUser">
                <span class="icon-user"></span>
            </a>
            <div id="collapsingNavbar" class="collapse navbar-toggleable-custom" role="tabpanel" aria-labelledby="collapsingNavbar">
                <ul class="nav navbar-nav pull-xs-right">
                    <li class="nav-item nav-item-toggable active">
                        <a class="nav-link scrol" href="/#web-platforma">
                            <small>WEB</small>
                            Platforma <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item nav-item-toggable">
                        <a class="nav-link scrol" href="/#cene">Cene</a>
                    </li>
                    <li class="nav-item nav-item-toggable">
                        <a class="nav-link scrol" href="/#destinacije">Destinacije</a>
                    </li>
                    <li class="nav-item nav-item-toggable hidden-md-up">
                        <form class="navbar-form">
                            <input class="form-control navbar-search-input" type="text" placeholder="Brza pretraga u izradi&hellip;">
                        </form>
                    </li>
                    <li class="navbar-divider hidden-sm-down"></li>
                    <li class="nav-item dropdown nav-dropdown-search hidden-sm-down">
                        <a class="nav-link dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon-search"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-search" aria-labelledby="dropdownMenu1">
                            <form class="navbar-form">
                                <input class="form-control navbar-search-input" type="text" placeholder="Brza pretraga u izradi&hellip;">
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown hidden-sm-down textselect-off">
                        <a class="nav-link dropdown-toggle nav-dropdown-user" id="dropdownMenu2" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">
                            <img src="/templejt/master/img/ns-icon.jpg" height="40" width="40" alt="Logo" class="img-circle" style="{{$test==''?'':'opacity:1'}}"> <span class="icon-caret-down"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-user dropdown-menu-animated"
                             aria-labelledby="dropdownMenu2">
                            <div class="media">
                                <div class="media-left">
                                    <img src="/templejt/master/img/ns-icon.jpg" height="60" width="60" alt="Logo" class="img-circle">
                                </div>
                                <div class="media-body media-middle">
                                    <h5 class="media-heading">najSmeštaj</h5>
                                    <h6>contact@najsmestaj.com</h6>
                                </div>
                            </div>
                            <a href="#" class="dropdown-item text-uppercase">Često postavljena pitanja</a>
                            <a href="#" class="dropdown-item text-uppercase">Uputstvo za korištenje</a>
                            <a href="#" class="dropdown-item text-uppercase">Uslovi korištenja</a>
                            <a href="#" class="dropdown-item text-uppercase" data-toggle="modal" data-target="#kontaktModal">Piši nam!</a>
                            @if(!$check=Auth::check())
                                <a href="/login" class="dropdown-item text-uppercase text-muted">Log in</a>
                            @else
                                <a href="/logout" class="dropdown-item text-uppercase text-muted">Log out</a>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
            <div id="collapsingMobileUser" class="collapse navbar-toggleable-custom dropdown-menu-custom p-x-1 hidden-md-up"
                 role="tabpanel" aria-labelledby="collapsingMobileUser">
                <div class="media m-t-1">
                    <div class="media-left">
                        <img src="/templejt/master/img/ns-icon.jpg" height="60" width="60" alt="Logo" class="img-circle">
                    </div>
                    <div class="media-body media-middle">
                        <h5 class="media-heading">najSmeštaj</h5>
                        <h6>contact@najsmestaj.com</h6>
                    </div>
                </div>
                <a href="#" class="dropdown-item text-uppercase">Često postavljena pitanja</a>
                <a href="#" class="dropdown-item text-uppercase">Uputstvo za korištenje</a>
                <a href="#" class="dropdown-item text-uppercase">Uslovi korištenja</a>
                <a href="#" class="dropdown-item text-uppercase" data-toggle="modal" data-target="#kontaktModal">Piši nam!</a>
                @if(!$check)
                    <a href="/login" class="dropdown-item text-uppercase text-muted">Log in</a>
                    @else
                    <a href="/logout" class="dropdown-item text-uppercase text-muted">Log out</a>
                @endif
            </div>
        </div>
    </nav>
    {{---navigacija::end--}}

    @yield('body')

    {{---KONTAKT-MODAL:START--}}
    <div id="kontaktModal" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close" data-dismiss="modal" style="position: absolute;right: 20px;cursor: pointer;font-weight: bold;font-size:40px;top:-10px">&times;</span>
                    <h2>Kontaktirajte nas!</h2>
                </div>
                <div class="modal-body">
                    <h2 id="kontaktPoruka" style="display: none"></h2>
                    <input name="ime" class="form-control form-control-lg" placeholder="Ime">
                    <input name="email" class="form-control form-control-lg" placeholder="Email">
                    <input name="naslov" class="form-control form-control-lg" placeholder="Naslov">
                    <textarea name="poruka" class="form-control form-control-lg" placeholder="Poruka"></textarea>
                    <button class="btn btn-primary-outline btn-block kontaktBtn">Pošalji!</button>
                </div>
            </div>
        </div>
    </div>
    {{---kontakt-modal:end--}}

    {{---FOOTER:START--}}
    <footer class="section-footer bg-inverse" role="contentinfo">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-5">
                    <div class="media">
                        <div class="media-left">
                            <span class="media-object icon-office display-1"></span>
                        </div>
                        <small class="media-body media-bottom">
                            &copy; najSmeštaj {{date('Y')}} <br>
                            Designed and Developed by our DevTeam
                        </small>
                    </div>
                </div>
                <div class="col-md-6 col-lg-7">
                    <ul class="nav nav-inline">
                        <li class="nav-item nav-item-toggable active">
                            <a class="nav-link scrol" href="/#web-platforma">
                                <small>WEB</small> Platforma <span class="sr-only">(current)</span>
                            </a>
                        </li>
                        <li class="nav-item nav-item-toggable">
                            <a class="nav-link scrol" href="/#cene">Cene</a>
                        </li>
                        <li class="nav-item nav-item-toggable">
                            <a class="nav-link scrol" href="/#destinacije">Destinacije</a>
                        </li>
                        <li class="nav-item"><a class="nav-link scroll-top" href="#totop">Na početak <span class="icon-caret-up"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    {{---footer:end--}}


    <script src="/templejt/master/js/landio.min.js"></script>
    @yield('end-script')
    <script>
        $(function(){
            $('.kontaktBtn').click(function(){
                $('#kontaktPoruka').slideUp();
                var ime=$('#kontaktModal input[name=ime]').val(),
                    email=$('#kontaktModal input[name=email]').val(),
                    naslov=$('#kontaktModal input[name=naslov]').val(),
                    poruka=$('#kontaktModal textarea[name=poruka]').val();
                if(!email || !poruka){
                    $('#kontaktPoruka').html('Dogodila se greška! Proverite podatke i pokušajte ponovo!');
                    $('#kontaktPoruka').slideDown();
                    return
                }
                $.post('/kontakt',{
                    _token:'{{csrf_token()}}',
                    ime:ime,
                    email:email,
                    naslov:naslov,
                    poruka:poruka
                },function(data){
                    data=JSON.parse(data);
                    $('#kontaktPoruka').html(+data.poruka);
                    $('#kontaktPoruka').slideDown();
                    if(data.check==1){
                        $('#kontaktModal input[name=ime]').val('');
                        $('#kontaktModal input[name=email]').val('');
                        $('#kontaktModal input[name=naslov]').val('');
                        $('#kontaktModal textarea[name=poruka]').val('')
                    }
                })
            })
        })
    </script>




</body>
</html>