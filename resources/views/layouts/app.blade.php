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
    <!-- <script src="{{ asset('js/submit.js') }}" defer></script> -->
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.scss') }}" rel="stylesheet">
    <!-- CoolAdmin template styles-->
    <link href="{{ asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">
    <!-- <link href="{{ asset('vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all"> -->
    <link href="{{ asset('css/theme.css')}}" rel="stylesheet">
    <!--CoolAdmin script-->
    <!-- Jquery JS-->
    <script src="{{asset('vendor/jquery-3.2.1.min.js') }}" defer></script>
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
            <!-- <div class="section__content section__content--p35"> -->
            <div class="container">
                <div class="header3-wrap">
                    <div class="header__logo">
                        <router-link :to="{name: 'dashboard'}">
                            <img src="img/latest.png" alt="Persona" style="height:50px" />
                        </router-link>
                    </div>
                    <div class="header__navbar nav-item">
                        <ul class="list-unstyled">
                            <li class="has-sub">
                                <router-link :to="{name: 'dashboard'}">
                                    <i class="fas fa-tachometer-alt"></i>Papan pemuka
                                    <span class="bot-line"></span>
                                </router-link>
                            </li>
                            @if(Auth::user()->role == "fakulti")
                            <li>
                                <router-link :to="{name: 'SenaraiPermohonan'}">
                                    <i class="fas fa-list"></i>
                                    <span class="bot-line"></span>Permohonan
                                </router-link>
                            </li>
                            @else
                            <li>
                                <router-link :to="{name: 'senarai-baru'}">
                                    <i class="fas fa-list"></i>
                                    <span class="bot-line"></span>Permohonan
                                </router-link>
                            </li>
                            @endif
                            <li>
                                <router-link :to="{name: 'analitik'}">
                                    <i class="fas fa-chart-bar"></i>
                                    <span class="bot-line"></span>Analitik</a>
                                </router-link>
                            </li>
                            @if(Auth::user()->role == "pjk")
                            <li>
                                <router-link :to="{name: 'pengguna'}">
                                    <i class="fas fa-users"></i>
                                    <span class="bot-line"></span>Pengguna</a>
                                </router-link>
                            </li>
                            @endif
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
                                            <router-link to="/workflow-settings">
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
        <main>
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