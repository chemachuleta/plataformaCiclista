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
            --green-700: #145c42;
            --green-500: #229f72;
            --green-300: #9dd9bd;
            --green-100: #edf8f2;
            --sand-100: #f8faf9;
            --white: #ffffff;
            --ink: #1f2b26;
            --muted: #5e7168;
            --shadow: 0 12px 32px rgba(11, 61, 46, 0.10);
            --radius: 18px;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: "Poppins", sans-serif;
            color: var(--ink);
            background:
                radial-gradient(1200px 600px at 5% -10%, rgba(34, 159, 114, 0.14), transparent 60%),
                radial-gradient(1000px 550px at 100% 0%, rgba(20, 92, 66, 0.15), transparent 55%),
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
            background: rgba(255, 255, 255, 0.88) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(20, 92, 66, 0.10);
        }

        .navbar-brand {
            font-weight: 600;
            color: var(--green-900) !important;
            letter-spacing: 0.3px;
        }

        .nav-link {
            font-weight: 500;
            line-height: 1.4;
            padding-top: 0.65rem;
            padding-bottom: 0.65rem;
        }

        .navbar-nav {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .dropdown-menu {
            border: 1px solid rgba(20, 92, 66, 0.1);
            border-radius: 12px;
            box-shadow: 0 10px 24px rgba(11, 61, 46, 0.12);
        }

        .user-chip {
            display: inline-flex;
            align-items: center;
            padding: 0.35rem 0.85rem;
            border-radius: 999px;
            background: var(--green-100);
            border: 1px solid rgba(20, 92, 66, 0.18);
            color: var(--green-900);
            font-weight: 600;
            font-size: 0.9rem;
            line-height: 1;
        }

        .logout-form {
            margin: 0 0 0 0.55rem;
        }

        .logout-btn {
            border: 1px solid rgba(20, 92, 66, 0.3);
            background: var(--white);
            color: var(--green-700);
            border-radius: 999px;
            padding: 0.35rem 0.9rem;
            font-weight: 600;
            line-height: 1.2;
            transition: all 150ms ease;
        }

        .logout-btn:hover {
            background: var(--green-100);
            color: var(--green-900);
            border-color: rgba(20, 92, 66, 0.45);
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

        .card-body {
            padding-left: 2rem;
            padding-right: 2rem;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e9f72, #37c489);
            border: none;
            box-shadow: 0 10px 22px rgba(30, 159, 114, 0.20);
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

        .btn-outline-main {
            border: 1px solid rgba(20, 92, 66, 0.35);
            color: var(--green-700);
            background: var(--white);
            border-radius: 999px;
            padding: 0.5rem 1.2rem;
            font-weight: 600;
        }

        .btn-outline-main:hover {
            background: var(--green-100);
            color: var(--green-900);
        }

        .form-control {
            border-radius: 12px;
            border: 1px solid rgba(15, 107, 75, 0.18);
        }

        .form-control::placeholder {
            color: #8a9a92;
        }

        .form-control:focus {
            border-color: var(--green-500);
            box-shadow: 0 0 0 0.2rem rgba(22, 160, 101, 0.20);
        }

        .alert {
            border-radius: 14px;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
            overflow: hidden;
        }

        .table thead th {
            background: #f3faf6;
            color: var(--green-900);
            border-bottom: 1px solid rgba(20, 92, 66, 0.15);
            font-weight: 600;
        }

        .table td, .table th {
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f8fcfa;
        }

        .menu-tree {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .menu-tree > li {
            margin-bottom: 0.85rem;
        }

        .menu-tree a {
            text-decoration: none;
        }

        .menu-tree a:hover {
            text-decoration: underline;
        }

        .menu-child {
            list-style: none;
            margin: 0.55rem 0 0 0;
            padding: 0.2rem 0 0.2rem 1rem;
            border-left: 2px solid rgba(20, 92, 66, 0.16);
        }

        .menu-child li {
            margin-bottom: 0.4rem;
        }

        .page-intro {
            background: linear-gradient(140deg, rgba(237, 248, 242, 0.95), rgba(255, 255, 255, 0.95));
            border: 1px solid rgba(20, 92, 66, 0.08);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 1.4rem 1.6rem;
            margin-bottom: 1.4rem;
        }

        .page-intro p {
            margin: 0.45rem 0 0;
            color: var(--muted);
        }

        main.py-4 {
            padding-top: 2.5rem !important;
            padding-bottom: 3rem !important;
        }

        @media (max-width: 767.98px) {
            .card-header,
            .card-body {
                padding-left: 1.2rem;
                padding-right: 1.2rem;
            }

            .page-intro {
                padding: 1.1rem 1rem;
            }
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
                            <li class="nav-item d-flex align-items-center">
                                <span class="user-chip">{{ Auth::user()->nombre ?? Auth::user()->name ?? 'Usuario' }}</span>
                                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                    @csrf
                                    <button type="submit" class="logout-btn">Cerrar sesion</button>
                                </form>
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
