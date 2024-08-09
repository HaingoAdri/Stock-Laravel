
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title',"Acceuil")</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('vendor/owl-carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/owl-carousel/css/owl.theme.default.min.css')}}">
    <link href="{{asset('vendor/jqvmap/css/jqvmap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
</head>

<body style="font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
    <div id="main-wrapper">
        <div class="nav-header">
            <a href="index.html" class="brand-logo">
                <img class="logo-abbr" src="{{asset('images/logo.png')}}" alt="">
                <h3 class="brand-title text-white">FEEL IN BOX</h3>
                <!-- <img class="brand-title" src="{{asset('images/logo-text.png')}}" alt=""> -->
            </a>

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">
                                <span class="search_icon p-3 c-pointer" data-toggle="dropdown">
                                    <i class="mdi mdi-magnify"></i>
                                </span>
                                <div class="dropdown-menu p-0 m-0">
                                    <form>
                                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                                    </form>
                                </div>
                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                    <span style="font-size: 15px;">Bienvenue, {{ Session::get('nom') }} 👋!</span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <!-- <li class="nav-label first">Main Menu</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                        <ul aria-expanded="false">
                            <li><a href="./index.html">Dashboard 1</a></li>
                            <li><a href="./index2.html">Dashboard 2</a></li>
                        </ul>
                    </li> -->
                    <li class="nav-label">Outils</li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-world-2"></i><span class="nav-text">Categorie</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{route('categorie')}}">Categorie d'articles</a></li>
                            <li><a href="{{route('taille')}}">Taille</a></li>
                            <li><a href="{{route('couleur')}}">Couleur</a></li>
                        </ul>
                    </li>
                    <li class="nav-label">Gestion de produits</li>
                    <li><a href="{{route('produits')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Type de produits</span></a></li>

                    <li class="nav-label">Achat</li>
                    <li><a href="{{route('achats')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Insertion de stock</span></a></li>
                    <li><a href="{{route('voir_stock')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Voir stock</span></a></li>
                    @if(Session::get('admin')==true)
                        <li><a href="{{route('voir_cout_achat')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Cout de vente de produits</span></a></li>
                    @endif
                    <li><a href="{{route('voir_cout_vente')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                            class="nav-text">Voir cout de vente de produits</span></a></li>
                    <li class="nav-label">Vente</li>
                    <li><a href="{{route('caisse')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Vente de produits</span></a></li>

                    @if(Session::get('admin')==true)
                    <li class="nav-label">Historique</li>
                    <li><a href="{{route('mouvements')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Mouvements</span></a></li>
                    <li><a href="{{route('historique_achats')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Historique d'achat</span></a></li>
                    <li><a href="{{route('historique_vente')}}" aria-expanded="false"><i class="icon icon-globe-2"></i><span
                        class="nav-text">Historique de vente</span></a></li>
                    @endif
                </ul>
            </div>


        </div>
        <div class="content-body">
            @yield("section")
        </div>
        <div class="footer">
            <div class="copyright">
                <p>Feel In Box © 2024</p>
            </div>
        </div>
    </div>
    <script src="{{asset('vendor/global/global.min.js')}}"></script>
    <script src="{{asset('js/quixnav-init.js')}}"></script>
    <script src="{{asset('js/custom.min.j')}}s"></script>


    <!-- Vectormap -->
    <script src="{{asset('vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('vendor/morris/morris.min.js')}}"></script>


    <script src="{{asset('vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('vendor/chart.js/Chart.bundle.min.js')}}"></script>

    <script src="{{asset('vendor/gaugeJS/dist/gauge.min.js')}}"></script>

    <!--  flot-chart js -->
    <script src="{{asset('vendor/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('vendor/flot/jquery.flot.resize.js')}}"></script>

    <!-- Owl Carousel -->
    <script src="{{asset('vendor/owl-carousel/js/owl.carousel.min.js') }}"></script>

    <!-- Counter Up -->
    <script src="{{asset('vendor/jqvmap/js/jquery.vmap.min.js') }}"></script>
    <script src="{{asset('vendor/jqvmap/js/jquery.vmap.usa.j') }}s"></script>
    <script src="{{asset('vendor/jquery.counterup/jquery.counterup.min.js') }}"></script>


    <script src="{{asset('js/dashboard/dashboard-1.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

</body>

</html>