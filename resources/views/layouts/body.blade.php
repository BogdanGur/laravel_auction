<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <script src="https://kit.fontawesome.com/06c89e9946.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header>
    <div class="wrapper">
        <nav>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
            </ul>

            <ul>
            @auth
                <li><a href="{{ route('account') }}">Account</a></li>
                <li><a href="{{ route('logout') }}">Logout</a></li>
            @else
                @if(Route::has('login'))
                    <li><a href="{{ route('login') }}">Login</a></li>
                @endif
                @if(Route::has('register'))
                    <li><a href="{{ route('register') }}">Register</a></li>
                @endif
            @endauth
            </ul>
        </nav>
    </div>
</header>

@yield('content')

<script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
