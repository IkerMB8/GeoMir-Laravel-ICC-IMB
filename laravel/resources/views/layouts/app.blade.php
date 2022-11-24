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
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @include('flash')
</head>
<body>
    <div id="app">
        <nav class="navegador">
            <div class="left">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img class="logoGM" src="/img/LogoGeoMir.PNG" />
                </a>
            </div>
            <div class="center">
                <form class="d-flex" role="search">
                    <button class="btn btn-outline-success" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                </form>
                <i class="fa-regular msg fa-2x fa-message"></i>
                <i class="fa-solid fa-2x fa-plus"></i>
            </div>
            <div class="right">
                
                @include('partials.language-switcher')
                <ul class="navbar-nav">
                    @guest
                        <div class="logreg">
                            @if (Route::has('login'))
                                <div class="contenedor">
                                    <article>
                                        <li >
                                            <button id="btn-abrir-popup" class="botonLog" href="{{ route('login') }}">{{ __('Login') }}</button>
                                        </li>
                                    </article>
                                </div>
                                <div class="overlay" id="overlay">
                                    <div class="popup" id="popup">
                                        <a href="#" id="btn-cerrar-popup" class="btn-cerrar-popup btn-close"></a>
                                        <h3>Iniciar Sesión</h3>
                                        <div style="display:flex; margin-top:45px; align-items:top; justify-content:space-around;">
                                            <div>
                                                <img class="logoinicio" src="/img/geomir.png">
                                            </div>
                                            <div style="display:flex; justify-content:center;">
                                                <!-- <form action="POST" style="display:flex; justify-content:center; flex-direction:column;">
                                                        <label class="lbl">Email<br><input type="text"></label>
                                                        <label class="lbl">Contraseña<br><input type="password"></label>
                                                    <input type="submit" class="btn-submit" value="Suscribirse">
                                                </form> -->
                                                <form class="logform" method="POST" action="{{ route('login') }}">
                                                @csrf

                                                <div class="row mb-3 divlbl">
                                                    <label style="text-align:left !important;" for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                                                    <div class="col-md-6 ">
                                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3 divlbl">
                                                    <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6 offset-md-4 remember">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                                            <label class="form-check-label" for="remember">
                                                                {{ __('Remember Me') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-0"  style="justify-content:center;">
                                                    <div class="col-md-8 offset-md-4"  style="margin:0;">
                                                        <button type="submit" class="boton">
                                                            {{ __('Login') }}
                                                        </button>

                                                        @if (Route::has('password.request'))
                                                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                                                {{ __('Forgot Your Password?') }}
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                        @if (Route::has('register'))
                                            <p class="else">¿No tienes una cuenta? <a href="{{ route('register') }}"><span>{{ __('Register') }}</span></a></p>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if (Route::has('register'))
                                <div class="contenedor">
                                    <li class="nav-item">
                                        <a class="botonSign" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                </div>
                            @endif
                        </div>
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
        <div class="navfiltros">
            <div>
                <a href="{{ url('/posts') }}"><button class="boton" id="cambiaColor1">{{ __('Posts') }}</button></a>
                <a href="{{ url('/places') }}"><button  class="boton" id="cambiaColor2">{{ __('Lugares') }}</button></a>
                <button type="submit" id="cambiaColor3" class="boton">{{ __('Imágenes') }}</button>
                <button type="submit" id="cambiaColor4" class="boton">{{ __('Vídeos') }}</button>
                <button type="submit" id="cambiaColor5" class="boton">{{ __('Ordenar') }}</button>
            </div>
        </div>
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>