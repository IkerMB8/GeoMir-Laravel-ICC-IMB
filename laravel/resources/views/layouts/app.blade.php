<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://kit.fontawesome.com/a79a171ae8.js" crossorigin="anonymous"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <style>
        .navegador{
            width: 100%;
            height: 79px;
            background-color: white;
            top: 0;
            margin: 0;
            position: sticky;
            display: flex;
            background-color:#1A1830;
        }
        body.dark .navegador{
            background-color: #1E1E21;
        }
        .left{
            float: left;
            width: 30%;
            height: 100%;
            display:flex;
            justify-content:left;
            align-items:center;
        }
        .center{
            width: 40%;
            height: 100%;
            display:flex;
            justify-content:center;
            align-items:center;
        }	
        .right{
            float: right;
            width: 30%;
            height: 100%;
            display:flex;
            justify-content:right;
            align-items:center;
            color: white;
            margin-right: 20px;
        }
        @media (max-width: 767px) {
            .navegador .center{
                display: none;
            }
        }
    </style>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @include('flash')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm navegador">
            <div class="left">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img style="width:130px;margin-left:20%;" src="/img/LogoGeoMir.PNG" />
                </a>
            </div>
            <div class="center">
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="right">
                
                @include('partials.language-switcher')
                <ul style="margin-left:10px;" class="navbar-nav">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a style="color:white;" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>   
            </div>
        </nav>
        <br>
        <div style="display:grid; justify-content:center; text-align:center;">
            <h2 style="text-align:center;">{{ __('Resources') }}</h2>
            <br>
            <div style="justify-content:center; display:flex;">
                <div style="border: 4px solid black; border-radius: 10px; width:auto;">
                    <a href="{{ url('/posts') }}"class="boton">{{ __('Posts') }}</a>
                    <a href="{{ url('/places') }}"class="boton">{{ __('Lugares') }}</a>
                    <a href="#"class="boton">{{ __('Imágenes') }}</a>
                    <a href="#"class="boton">{{ __('Vídeos') }}</a>
                    <a href="#"class="boton">{{ __('Ordenar') }}</a>
                </div>
            </div>
        </div>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>