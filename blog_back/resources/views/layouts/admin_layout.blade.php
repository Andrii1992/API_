<!doctype html>
<html lang="pl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">


    <title>@yield('title')</title>
</head>



<body class="hold-transition dark-mode">
    <div class="wrapper">


        <div class="container-fluid">
            <div class="row">
                <aside class="col-lg-0  main-sidebar sidebar-dark-primary">
                    <div class="sidebar">
                        <nav class="mt-2 ">
                            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                                @if(auth()->user()->getRole() == "admin" || auth()->user()->getRole() == "user")
                                <li class="nav-item">
                                    <a href="{{ route('indexAdmin') }}" class="nav-link text-secondary">
                                        <i class="text-success fas fa-tachometer-alt"></i>
                                        <span style="font-size: 24px;" class="sidebar-menu">
                                            <strong> Admin panel</strong> </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('postsAdmin') }}" class="nav-link text-secondary">
                                        <i class="text-success far fa-newspaper"></i>
                                        <span class="sidebar-menu">
                                            Posty </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('createPostsAdmin') }}" class="nav-link text-secondary">
                                        <i class="text-success far fa-plus-square"></i>
                                        <span class="sidebar-menu">
                                            Nowy post </span>
                                    </a>
                                </li>
                                <li class="nav-item d-block d-lg-none">
                                    <form class="form-inline my-2 my-lg-0 px-3 conrainer" action="{{ route('postsAdmin') }}" method="GET" role="form">
                                        <div class="row px-3">
                                            @if(isset($ser))
                                            <input class="col-12 form-control mr-sm-2" type="search" placeholder="Wyszukaj posty" name="search" value="{{ $ser }}">
                                            @else
                                            <input class="col-12 form-control mb-3 mr-sm-2" type="search" placeholder="Wyszukaj posty" name="search">
                                            @endif
                                            <button class="col-12 form-control  btn btn-outline-success my-2 my-sm-0 d-block" type="submit">Wyszukaj</button>
                                        </div>
                                    </form>
                                </li>
                                @if(auth()->user()->getRole() == "admin")
                                <li class="nav-item">
                                    <a href="{{ route('usersAdmin') }}" class="nav-link text-secondary">
                                        <i class="text-success fas fa-user-friends"></i>
                                        <span class="sidebar-menu">
                                            Użytkownicy </span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('getCreateUserAdmin') }}" class="nav-link text-secondary">
                                        <i class="text-success far fa-plus-square"></i>
                                        <span class="sidebar-menu">
                                            Nowy użytkownik </span>
                                    </a>
                                </li>
                                <li class="nav-item d-block d-lg-none">
                                    <form class="form-inline my-2 my-lg-0 pl-2" action="{{ route('usersAdmin') }}" method="GET" role="form">
                                        @if(isset($search))
                                        <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj użytkowników" name="search" value="{{ $search }}">
                                        @else
                                        <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj użytkowników" name="search">
                                        @endif
                                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Wyszukaj</button>
                                    </form>
                                </li>

                                @endif
                                @endif
                                <li class="nav-item dropdown d-lg-none d-block">
                                    <a id="navbarDropdown" class="text-success nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu  dropdown-menu-right py-0" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item btn btn-outline-success py-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Wyloguj') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </aside>
                <div class="col content-wrapper pr-lg-0">
                    <nav class="main-header navbar navbar-expand navbar-dark">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a id="hide" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                            </li>
                        </ul>

                        <ul class="navbar-nav ml-auto">
                            @if(auth()->user()->getRole() == "admin" || auth()->user()->getRole() == "user")
                            <li class="nav-item d-none d-lg-block">
                                <form class="form-inline my-2 my-lg-0" action="{{ route('postsAdmin') }}" method="GET" role="form">
                                    @if(isset($ser))
                                    <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj posty" name="ser" value="{{ $ser }}">
                                    @else
                                    <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj posty" name="ser">
                                    @endif
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Wyszukaj</button>
                                </form>
                            </li>
                            @if(auth()->user()->getRole() == "admin")
                            <li class="nav-item d-none d-lg-block">
                                <form class="form-inline my-2 my-lg-0 pl-2" action="{{ route('usersAdmin') }}" method="GET" role="form">
                                    @if(isset($search))
                                    <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj użytkowników" name="search" value={{ $search }}>
                                    @else
                                    <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj użytkowników" name="search">
                                    @endif
                                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Wyszukaj</button>
                                </form>
                            </li>
                            @endif


                            @endif
                            <li class="nav-item dropdown d-none d-lg-block">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right py-0" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item btn btn-outline-success py-1" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Wyloguj') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        </ul>
                    </nav>

                    <div class="container-fluid rounded-left">
                        @yield('content')
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>






    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="{{ asset('bootstrap-4.6.0/js/jquery-3.5.1.slim.min.js') }}">
    </script>
    <script src="{{ asset('bootstrap-4.6.0/js/popper.min.js') }}">
    </script>
    <script src="{{ asset('bootstrap-4.6.0/js/bootstrap.min.js') }}">
    </script>
    <script src="{{ asset('bootstrap-4.6.0/js/jquery-3.5.1.min.js') }}">
    </script>
    <script src="{{ asset('bootstrap-4.6.0/js/all.min.js') }}"></script>
    <script src="{{ asset('bootstrap-4.6.0/js/jquery-ui.min.js') }}"></script>

    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <script>


        $("#hide").click(function() {
            if ($(window).width() > 992) {
                if (!$(".sidebar-menu").is(":visible")) {
                    $(".main-sidebar").show("blind");
                }
                if ($(".sidebar-menu").is(":visible")) {
                    $(".sidebar-menu").hide("slow");

                    var element = document.getElementsByClassName('nav-link');

                    for (var i = 0; i < element.length; i++) {
                        element[i].classList.add('svg-jus');

                    }
                } else {

                    var element = document.getElementsByClassName('nav-link');

                    for (var i = 0; i < element.length; i++) {
                        element[i].classList.remove("svg-jus");

                    }
                    $(".sidebar-menu").show("slow");
                }
            } else {
                if ($(".sidebar-menu").is(":visible")) {
                    if ($(".main-sidebar").is(":visible")) {
                        $(".main-sidebar").hide("blind");

                    } else {
                        $(".main-sidebar").show("blind");
                    }
                } else {
                    $(".sidebar-menu").show("slow");
                    if ($(".main-sidebar").is(":visible")) {
                        $(".main-sidebar").hide("blind");

                    } else {

                        $(".main-sidebar").show("blind");
                    }
                }

            }
        });
    </script>
</body>

</html>

<style>
    @import url("https://fonts.googleapis.com/css2?family=Lobster&family=Open+Sans&family=Oswald:wght@200;300;400;500;600;700&display=swap");
    @import url('https://fonts.googleapis.com/css2?family=Anton&family=Goblin+One&family=Itim&family=Merriweather+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap');

    body {
        font-family: "Oswald", sans-serif;
    }

    .invalid-feedback {
        color: #8c3545;
    }

    aside {
        font-family: 'Itim', cursive;
    }

    .cart h3 {
        /*  font-family: 'Merriweather Sans', sans-serif; */
        font-family: 'Goblin One', cursive;
    }

    .text-secondary {
        color: rgba(255, 255, 255, .5) !important;
    }

    a.text-secondary:hover,
    .nav-link:hover {
        color: #28a745 !important;
    }

    .dark-mode {
        background-color: #454d55 !important;
        color: #fff;
    }

    .hold-transition {
        transition-duration: 0.7s;
    }

    .dark-mode .preloader {
        background-color: #404244 !important;
        color: #fff;
    }

    /*
    .preloader {
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        background-color: #f4f6f9;
        height: 100vh;
        width: 100%;
        transition: height 1s linear;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 9999;
    }*/

    .main-sidebar,
    .main-sidebar::before .sidebar-menu {
        transition: margin-left .4s ease-in-out, width .1s ease-in-out;

    }

    svg {
        font-size: 20px;
        margin-right: 5px;
        margin-left: 5px;
    }

    .nav-pills>li:first-child svg {
        font-size: 24px;
    }

    .cart svg,
    .cart h3 {
        font-size: 70px;
        font-weight: 700;
    }

    .pagination .page-link {
        color: black !important;
        background-color: white !important;
    }

    .pagination .page-item.disabled {
        color: white !important;
        background-color: #aaaaaa !important;
    }

    .pagination .page-item.active .page-link {
        color: white !important;
        background-color: #28a745 !important;
        border-color: #28a745;
    }

    .content-wrapper>.container-fluid {
        background-color: #6E767E;
        min-height: 92vh;
        padding-bottom: 5%;
        padding-top: 2%;

    }

    .dropdown-menu {
        min-width: 5rem;
    }

    @media (min-width:992px) {
        .svg-jus {
            justify-content: center;
            display: flex;
        }
    }

    @media (max-width:992px) {
        .main-sidebar {
            display: none;
        }
    }
</style>