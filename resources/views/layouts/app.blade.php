<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Tienda') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #0f0f0f; color: #e5e5e5; min-height: 100vh; }

        /* NAVBAR */
        .navbar {
            background: #111 !important;
            border-bottom: 1px solid #222;
            padding: 0 !important;
        }
        .navbar .container { padding: 14px 24px; }
        .navbar-brand {
            font-weight: 700;
            font-size: 20px;
            color: #fff !important;
            letter-spacing: -0.5px;
        }
        .navbar-brand span { color: #6366f1; }
        .nav-link { color: #aaa !important; font-size: 14px; font-weight: 500; transition: color 0.2s; }
        .nav-link:hover { color: #fff !important; }
        .navbar-toggler { border-color: #333; }
        .navbar-toggler-icon { filter: invert(1); }

        .btn-nav-login {
            background: transparent;
            border: 1px solid #333;
            color: #ccc !important;
            border-radius: 8px;
            padding: 6px 16px !important;
            font-size: 13px !important;
            transition: all 0.2s;
        }
        .btn-nav-login:hover { border-color: #6366f1; color: #fff !important; }

        .btn-nav-register {
            background: #6366f1;
            border: 1px solid #6366f1;
            color: #fff !important;
            border-radius: 8px;
            padding: 6px 16px !important;
            font-size: 13px !important;
            transition: all 0.2s;
        }
        .btn-nav-register:hover { background: #4f46e5; }

        .dropdown-menu {
            background: #1a1a1a;
            border: 1px solid #2a2a2a;
            border-radius: 10px;
            padding: 6px;
        }
        .dropdown-item { color: #ccc; font-size: 14px; border-radius: 6px; padding: 8px 14px; }
        .dropdown-item:hover { background: #252525; color: #fff; }
        .dropdown-toggle { color: #e5e5e5 !important; font-size: 14px; font-weight: 500; }

        /* NAV LINKS */
        .nav-links-left a {
            color: #aaa;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            transition: all 0.2s;
        }
        .nav-links-left a:hover { color: #fff; background: #1e1e1e; }

        main { padding: 40px 0; }
    </style>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <span>●</span> {{ config('app.name', 'Tienda') }}
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto nav-links-left ms-3 gap-1">
                    <li class="nav-item">
                        <a href="/productos">Tienda</a>
                    </li>
                    <li class="nav-item">
                        <a href="/checkout">Carrito</a>
                    </li>
                </ul>

                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link btn-nav-login" href="{{ route('login') }}">Iniciar sesión</a>
                            </li>
                        @endif
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link btn-nav-register" href="{{ route('register') }}">Registrarse</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>
</div>
</body>
</html>
