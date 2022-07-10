<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
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
                @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
                    <li><a href="{{ route('admin.logout') }}">Logout</a></li>
                @endif
            </ul>
        </nav>
    </div>
</header>
@yield('content')

<script src="https://code.jquery.com/jquery-3.6.0.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
