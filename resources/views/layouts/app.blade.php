<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Fav Icon Testing -->
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('pageTitle') | Persona</title>
    <!-- Scripts -->
    <script src="{{ asset('js/submit.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.scss') }}" rel="stylesheet">
    <!-- CoolAdmin template styles-->
    <link href="{{ asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('css/theme.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

    <!--CoolAdmin script-->
    <!-- Jquery JS-->
    <script src="{{asset('vendor/jquery-3.2.1.min.js') }}" defer></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('vendor/bootstrap-4.1/popper.min.js') }}" defer></script>
    <script src="{{asset('vendor/bootstrap-4.1/bootstrap.min.js') }}" defer></script>
    <!-- Vendor JS       -->
    <script src="{{asset('vendor/slick/slick.min.js')}}" defer></script>
    <script src="{{asset('vendor/wow/wow.min.js') }}" defer></script>
    <script src="{{asset('vendor/counter-up/jquery.waypoints.min.js') }}" defer></script>
    <script src="{{asset('vendor/counter-up/jquery.counterup.min.js')}}" defer></script>
    <script src="{{asset('vendor/circle-progress/circle-progress.min.js') }}" defer></script>
    <script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.js') }}" defer></script>
    <script src="{{asset('vendor/select2/select2.min.js')}}" defer></script>
    <!-- Main JS-->
    <script src="{{asset('js/main.js')}}" defer></script>
    <!-- Vuetify icon -->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
</head>

<body>
    <div id="app">
        @guest

        @else
        <header class="header-desktop3 d-none d-lg-block">
            <div class="section__content section__content--p35">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <a href="#">
                            <img src="img/latest.png" alt="Persona" style="height:50px" />
                        </a>
                    </div>
                    <div class="header__navbar nav-item">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <router-link to="/dashboard">
                                    <i class="fas fa-tachometer-alt"></i>Papan pemuka
                                    <span class="bot-line"></span>
                                </router-link>
                            </li>
                            @if(Auth::user()->role == "fakulti")
                            <li>
                                <router-link :to="{name: 'permohonans'}">
                                    <i class="fas fa-list"></i>
                                    <span class="bot-line"></span>Permohonan
                                </router-link>
                            </li>
                            @else
                            <li class="has-sub">
                                <a href="#">
                                    <i class="fas fa-list"></i>
                                    <span class="bot-line"></span>Permohonan</a>
                                <ul class="header3-sub-list list-unstyled">
                                    <li>
                                        <router-link to="senarai-permohonan-baharu">Senarai permohonan baharu</router-link>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            <li>
                                <router-link to="/analitik">
                                    <i class="fas fa-chart-bar"></i>
                                    <span class="bot-line"></span>Analitik</a>
                                </router-link>
                            </li>
                        </ul>
                    </div>
                    <div class="header__tool">
                        <div class="account-wrap">
                            <div class="account-item account-item--style2 clearfix js-item-menu">
                                <div class="content">
                                    <a class="js-acc-btn" href="#"> {{ Auth::user()->name }}</a>
                                </div>
                                <div class="account-dropdown js-dropdown">
                                    <div class="account-dropdown__body">
                                        <div class="account-dropdown__item">
                                            <router-link to="/settings">
                                                <i class="zmdi zmdi-settings"></i>Settings</a>
                                            </router-link>
                                        </div>
                                        <div class="account-dropdown__item">
                                            <router-link to="/workflow_settings">
                                                <i class="#"></i>Email workflow settings
                                            </router-link>
                                        </div>
                                    </div>
                                    <div class="account-dropdown__footer">
                                        <a href="{{route('logout')}}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="zmdi zmdi-power"></i>Logout</a>
                                    </div>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @endguest
        <main class="container" style="background-color:white">
            <!-- Message in blade testing on 27/1/2019 by Bezane -->
            @if (Session::has('message'))
            <div class="alert alert-success" role="alert">
                {{Session::get('message')}}
            </div>
            @elseif (Session::has('error'))
            <div class="alert alert-warning" role="alert">
                {{Session::get('error')}}
            </div>
            @endif
            <!-- End message -->
            @guest
            @yield('content')
            @else

            <v-app id="app">
                <router-view>
                    </<router-view>
            </v-app>


            @endguest

        </main>
        @yield('div')
    </div>
</body>
@yield('myjsfile')

</html>
<script src="{{ asset('js/app.js') }}"></script>