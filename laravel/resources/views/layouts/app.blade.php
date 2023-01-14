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
                <div class="botonera">
                    <a href="/sobrenosotros"><i class="fa-regular fa-2x fa-address-card"></i></a>
                    @hasanyrole('admin|author')
                    <i class="fa-regular msg fa-2x fa-message"></i>
                    <div class="logreg">
                        @if (Route::has('login'))
                        <a href="/posts/create"><i class="fa-solid fa-plus fa-2x"></i></a>
                        @endif
                    </div>
                    @endhasanyrole
                </div>
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
                                        <div class="popupss">
                                            <div>
                                                <img class="logoinicio" src="/img/geomir.png">
                                            </div>
                                            <div style="margin-left:10px;display:flex; justify-content:center;">
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
                                            <p class="else">¿No tienes una cuenta? <button id="btn-abrir-popup2" class="registerb" href="{{ route('register') }}"><span>{{ __('Register') }}</span></button></p>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if (Route::has('register'))
                                <div class="overlay" id="overlay2">
                                    <div class="popup" id="popup2">
                                        <a href="#" id="btn-cerrar-popup2" class="btn-cerrar-popup btn-close"></a>
                                        <h3>Registrarse</h3>
                                        <div class="popupss">
                                            <div>
                                                <img class="logoinicio" src="/img/geomir.png">
                                            </div>
                                            <div class="regpop">
                                                <form method="POST" action="{{ route('register') }}">
                                                    @csrf
                                                    <div class="row mb-3">
                                                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                            @error('name')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                            @error('email')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                            @error('password')
                                                                <span class="invalid-feedback" role="alert">
                                                                    <strong>{{ $message }}</strong>
                                                                </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                                        <div class="col-md-6">
                                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                        </div>
                                                    </div>

                                                    <div class="row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="boton">
                                                                {{ __('Register') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>              
                                    </div>
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

                                <a class="dropdown-item" href="/sobrenosotros">Sobre Nosotros</a>
                            </div>
                        </li>
                    @endguest
                </ul>   
            </div>
        </nav>
        <br>
        <div class="navfiltros">
            <div>
                <a href="{{ url('/posts') }}"><button class="boton" id="cambiaColor1">{{ __('fpp.posts') }}</button></a>
                <a href="{{ url('/places') }}"><button  class="boton" id="cambiaColor2">{{ __('fpp.places') }}</button></a>
                <button type="submit" id="cambiaColor3" class="boton">{{ __('fpp.images') }}</button>
                <button type="submit" id="cambiaColor4" class="boton">{{ __('fpp.video') }}</button>
                <button type="submit" id="cambiaColor5" class="boton">{{ __('fpp.organize') }}</button>
                @hasanyrole('admin|editor')
                    <a href="{{ url('/files ') }}"><button  class="boton" >{{ __('Files') }}</button></a>
                @endhasanyrole
            </div>
        </div>
        <div id="access" class="web-accessibility-menu-button">
            <i class="fas fa-wheelchair silla"></i>
            <span class="accessibility-text">Accessibility</span>
        </div>
        <ul id="list-access" class="list-group list-web-accessibility activeAccess" style="display: flex;">
            <li class="list-group-item web-accessibility-item ">
                <div class="d-inline mr-3">Tt </div>
                <div class="d-inline web-accessibility-item-font font-size-16 ml-2" data-type="font-size" data-value="16"><button onclick="cambiarclase()">A</button></div>
                <div class="d-inline web-accessibility-item-font font-size-18 ml-1" data-type="font-size" data-value="18">A</div>
                <div class="d-inline web-accessibility-item-font font-size-20 ml-1" data-type="font-size" data-value="20">A</div>
                <div class="d-inline web-accessibility-item-font font-size-22 ml-1" data-type="font-size" data-value="22">A</div>
                <div class="d-inline web-accessibility-item-font font-size-24 ml-1" data-type="font-size" data-value="24">A</div>
                <div class="d-inline web-accessibility-item-font font-size-26 ml-1" data-type="font-size" data-value="26">A</div>
            </li>
            <li class="list-group-item web-accessibility-item  web-accessibility-item-direct" data-type="reset">
                <div class="d-inline mr-3"><i class="fas fa-undo"></i></div>
                <div class="d-inline  ml-2">Reset</div>
            </li>
        </ul>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="footer">
                <a href="{{ url('/') }}"><i class="fa-solid fa-2x fa-house"></i></a>
                <form class="d-flex" role="search">
                    <i class="fa-solid fa-2x fa-magnifying-glass"></i>
                </form>
                @hasanyrole('admin|author')
                <div class="logreg">
                    @if (Route::has('login'))
                    <a href="/posts/create"><i class="fa-solid fa-plus fa-2x"></i></a>
                    @endif
                </div>
                <i class="fa-regular msg fa-2x fa-message"></i>
                
                <i class="fa-solid fa-sliders fa-2x" id="slider"></i>
                
                <ul id="list-slider" class="list-group list-web-accessibility activeAccess" style="display: flex;">
                <div class="divSlider">
                    <a href="{{ url('/posts') }}"><button class="boton">{{ __('fpp.posts') }}</button></a>
                    <a href="{{ url('/places') }}"><button style="width: 86%;" class="boton">{{ __('fpp.places') }}</button></a>
                    <button type="submit" class="boton">{{ __('fpp.images') }}</button>
                    <button type="submit" class="boton">{{ __('fpp.video') }}</button>
                    <button type="submit" class="boton">{{ __('fpp.organize') }}</button>
                    @hasanyrole('admin|editor')
                        <a href="{{ url('/files ') }}"><button  class="boton" >{{ __('Files') }}</button></a>
                    @endhasanyrole
                </div>
                </ul>
                @endhasanyrole
            </div>
        </footer>
    </div>
</body>
<script>
    const cambiarClase = document.querySelector('#access'),
        menu = document.querySelector('#list-access');

    cambiarClase.addEventListener('click', (e) => {
        menu.classList.toggle('activeAccess');
    });

    const cambiarClase2 = document.querySelector('#slider'),
        menu2 = document.querySelector('#list-slider');

    cambiarClase2.addEventListener('click', (e) => {
        menu2.classList.toggle('activeAccess');
    });
</script>
</html>