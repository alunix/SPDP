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

    <title> SPDP</title>

     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script> 
    <script src="{{ asset('js/submit.js') }}" defer></script> 
    <script src="{{ asset('vendor/unisharp/laravel-ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'summary-ckeditor' );
    </script>
    
    <!-- Script for chart-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    <script src="https://unpkg.com/vue"></script>
    <script>
            var app = new Vue({
                el: '#app',
            });
        </script>
          <script src=https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js charset=utf-8></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script> 



    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/styles.scss') }}" rel="stylesheet">


    <style>
        .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

        /* For Bottom Navigation Bar */
            .navbar_bottom {
                overflow: hidden;
                background-color: #00FF00;
                position: fixed;
                bottom: 0;
                width: 100%;
            }

            .navbar_bottom a {
                float: left;
                display: block;
                color: #f2f2f2;
                text-align: center;
                padding: 5px 16px;
                text-decoration: none;
                font-size: 17px;
            }

            .navbar_bottom a:hover {
                background: #f1f1f1;
                color: black;
            }

            .navbar_bottom a.active {
                background-color: #4CAF50;
                color: white;
            }
            
            @import "@material/button/mdc-button";

             /* @stack('styles.scss');
             */
    </style>


</head>
<body>

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li class="links"><a href="{{ url('/') }}">SPDP</a></li>
                </ul>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                            

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                @if (Route::has('register'))
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                       
                        

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                <a class="dropdown-item" href="{{ route('settings') }}"
                                       >
                                        {{ __('Settings') }}
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                   

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
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
            @yield('content')
        </main>
    </div>

