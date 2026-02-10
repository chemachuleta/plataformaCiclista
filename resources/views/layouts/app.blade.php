<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        :root {
            --green-900: #0b3d2e;
            --green-700: #0f6b4b;
            --green-500: #16a065;
            --green-300: #8fd6b3;
            --green-100: #e6f5ee;
            --white: #ffffff;
            --ink: #1d2a24;
            --shadow: 0 16px 40px rgba(15, 107, 75, 0.12);
            --radius: 18px;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: "Poppins", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(1200px 600px at 10% -10%, rgba(22, 160, 101, 0.10), transparent 60%),
                radial-gradient(900px 500px at 90% 0%, rgba(15, 107, 75, 0.12), transparent 55%),
                var(--white);
        }

        h1, h2, h3, h4, h5 {
            font-family: "Playfair Display", serif;
            color: var(--green-900);
            letter-spacing: 0.2px;
        }

        a {
            color: var(--green-700);
            transition: color 160ms ease;
            line-height: 1.4;
            text-underline-offset: 2px;
            text-decoration-thickness: 1px;
        }

        a:hover {
            color: var(--green-500);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.85) !important;
            backdrop-filter: blur(8px);
            border-bottom: 1px solid rgba(15, 107, 75, 0.08);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--green-900) !important;
        }

        .nav-link {
            font-weight: 500;
            line-height: 1.4;
            padding-top: 0.65rem;
            padding-bottom: 0.65rem;
        }

        ul {
            padding-left: 1.25rem;
        }

        li {
            line-height: 1.5;
        }

        .container {
            max-width: 1100px;
        }

        .card {
            border: 1px solid rgba(15, 107, 75, 0.08);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .card-header {
            background: var(--green-100);
            border-bottom: 1px solid rgba(15, 107, 75, 0.08);
            font-weight: 600;
            color: var(--green-900);
            padding-left: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #20b877, #38d28d);
            border: none;
            box-shadow: 0 12px 24px rgba(32, 184, 119, 0.22);
            border-radius: 999px;
            padding: 0.55rem 1.4rem;
            font-weight: 600;
        }

        .btn-primary:hover,
        .btn-primary:focus {
            background: linear-gradient(135deg, #189a63, #28b975);
            box-shadow: 0 14px 30px rgba(24, 154, 99, 0.26);
        }

        .btn-link {
            color: var(--green-700);
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid rgba(15, 107, 75, 0.18);
        }

        .form-control:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 0.2rem rgba(22, 160, 101, 0.20);
        }

        .alert {
            border-radius: 14px;
        }

        .card-body {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        main.py-4 {
            padding-top: 2.5rem !important;
            padding-bottom: 3rem !important;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
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
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
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
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
