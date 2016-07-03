<!--
         _____ _ _ __\/_____ __ _   ___ ___ ___ _ __\/___ _/___
        |_    | | |  ___/   |  \ | |   | __|   | |  ___/ |  __/
         _| | | | |___  | ^ | |  | | ^_| __| ^_| |___  | | |__
        |_____|_,_|_____|_|_|_|__| |_| |___|_|\ _|_____|_|____|

        Hvala što se interesujete za kod :)

        Kontakt za developere: kontakt@dusanperisic.com

-->

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>najSmeštaj | Panel</title>
    {{-- Tell the browser to be responsive to screen width --}}
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    {{-- Bootstrap 3.3.6 --}}
    <link rel="stylesheet" href="/templejt/admin-lte-v233/bootstrap/css/bootstrap.min.css">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="/templejt/admin-lte-v233/css/font-awesome.min.css">
    {{-- Ionicons --}}
    <link rel="stylesheet" href="/templejt/admin-lte-v233/css/ionicons.min.css">
    {{-- Theme style --}}
    <link rel="stylesheet" href="/templejt/admin-lte-v233/css/AdminLTE.min.css">
    {{-- AdminLTE Skins--}}
    <link rel="stylesheet" href="/templejt/admin-lte-v233/css/skins/_all-skins.min.css">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="stylesheet" href="/css/animation.css">
</head>

<?php $korisnik=Auth::user(); ?>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="/{{$root='profil'}}" class="logo">
                <span class="logo-mini"><b>N</b>ajS</span>
                <span class="logo-lg"><b>najSmeštaj</b></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        {{---PORUKE::START--}}
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-success">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Imate 1 poruku</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="/templejt/admin-lte-v233/img/dusan-160x160.jpg" class="img-circle" alt="Fotografija">
                                                </div>
                                                <h4>
                                                    Tehnička podrška <small><i class="fa fa-clock-o"></i> 1 min</small>
                                                </h4>
                                                <p>Dobro došli!</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">Pregledaj sve</a></li>
                            </ul>
                        </li>
                        {{---poruke::end--}}

                        {{---NOTIFIKACIJE::START--}}
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <span class="label label-warning">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Nemate ni jednu notifikaciju</li>
                                <li>
                                    <ul class="menu"></ul>
                                </li>
                                <li class="footer"><a href="#">Pregledaj sve</a></li>
                            </ul>
                        </li>
                        {{---notifikacije::end--}}

                        {{--TASKOVI::START--}}
                        <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-flag-o"></i>
                                <span class="label label-danger">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Imate 1 aktivan task</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <h3>
                                                    Popunjenost Vašeg naloga
                                                    <small class="pull-right">46%</small>
                                                </h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 46%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">46% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">Pregledaj sve</a>
                                </li>
                            </ul>
                        </li>
                        {{--taskovi::end--}}

                        {{---KORISNIČKI-MENI::START--}}
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="{{$korisnik->foto?$korisnik->foto:'/img/default/korisnik.jpg'}}" class="user-image" alt="User Image">
                                <span class="hidden-xs">{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="{{$korisnik->foto?$korisnik->foto:'/img/default/korisnik.jpg'}}" class="img-circle" alt="User Image">
                                    <p>
                                        {{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}
                                        <small>Registrovan na platformu od {{date('d.m.Y. H:i',strtotime($korisnik->created_at))}}</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Izmeni</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="/logout" class="btn btn-default btn-flat">Odjava</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        {{---korisnički-meni::end--}}
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        {{----------------------------------------------------------------------
            LIJEVI-NAVBAR::START
        ------------------------------------------------------------------------}}
        <aside class="main-sidebar">
            <section class="sidebar">
                {{---KORISNIK::START--}}
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{$korisnik->foto?$korisnik->foto:'/img/default/korisnik.jpg'}}" class="img-circle" alt="Fotografija korisnika">
                    </div>
                    <div class="pull-left info">
                        <p>{{$korisnik->ime||$korisnik->prezime?$korisnik->ime.' '.$korisnik->prezime:$korisnik->email}}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                {{---korisnik::end--}}

                {{---GLAVNI-MENI::START--}}
                <ul class="sidebar-menu">
                    <li class="header">GLAVNI MENI</li>
                    {{---PREGLED--}}
                    <li class="{{Request::segment(2) == ''?'active ':''}}treeview">
                        <a href="/{{$root}}">
                            <i class="fa fa-dashboard"></i> <span>Pregled</span></i>
                        </a>
                    </li>
                    {{---LISTA-ZELJA--}}
                    <li{{Request::is('*/lista-zelja')?' class=active ':''}}>
                        <a href="/{{$root}}/lista-zelja">
                            <i class="fa fa-suitcase"></i> <span>Lista zelja</span>
                        </a>
                    </li>
                    {{---REZERVACIJE--}}
                    <li{{Request::is('*/rezervacije')?' class=active ':''}}>
                        <a href="/{{$root}}/rezervacije">
                            <i class="fa fa-suitcase"></i> <span>Rezervacije</span>
                        </a>
                    </li>
                </ul>
                {{---glavni-meni::end--}}
            </section>
        </aside>
        {{----------------------------------------------------------------------
            lijevi-navbar::end
        ------------------------------------------------------------------------}}

        <div class="content-wrapper">
            <section class="content-header">
                <h1>
                    najSmeštaj Panel <small>Verzija 1.0</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="/{{$root}}"><i class="fa fa-dashboard"></i> Panel</a></li>
                    <li class="active">{{Request::segment(2)?ucfirst(str_replace('-',' ',Request::segment(2))):'Pregled'}}</li>
                </ol>
            </section>
            <section class="content">
                @yield('container')
            </section>
            <br clear="all">
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Verzija</b> 1.0
            </div>
            <a href="//najsmestaj.com">najSmeštaj</a> © Copyright {{date('Y')}} Zadržavamo sva prava.
        </footer>
        {{--AKTIVNOSTI--}}
        <aside class="control-sidebar control-sidebar-dark">
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs"></ul>
            <div class="tab-content">
                <div class="tab-pane" id="control-sidebar-home-tab"></div>
            </div>
        </aside>
        <div class="control-sidebar-bg"></div>
    </div>
    {{-- jQuery 2.2.0 --}}
    <script src="/templejt/admin-lte-v233/plugins/jQuery/jQuery-2.2.0.min.js"></script>
    {{-- Bootstrap 3.3.6 --}}
    <script src="/templejt/admin-lte-v233/bootstrap/js/bootstrap.min.js"></script>
    {{-- FastClick --}}
    <script src="/templejt/admin-lte-v233/plugins/fastclick/fastclick.js"></script>
    {{-- AdminLTE App --}}
    <script src="/templejt/admin-lte-v233/js/app.min.js"></script>
    {{-- Sparkline --}}
    <script src="/templejt/admin-lte-v233/plugins/sparkline/jquery.sparkline.min.js"></script>
    {{-- jvectormap --}}
    <script src="/templejt/admin-lte-v233/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="/templejt/admin-lte-v233/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    {{-- SlimScroll 1.3.0 --}}
    <script src="/templejt/admin-lte-v233/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    {{-- ChartJS 1.0.1 --}}
    <script src="/templejt/admin-lte-v233/plugins/chartjs/Chart.min.js"></script>
    {{-- AdminLTE for demo purposes --}}
    <script src="/templejt/admin-lte-v233/js/demo.js"></script>
    @yield('end-script')
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-80215552-1', 'auto');
        ga('send', 'pageview');

    </script>
</body>
</html>