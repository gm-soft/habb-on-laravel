<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="robots" content="robots.txt">

    <title>@yield('title', "Регистрация HABB")</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/frontend.css') }}">
    @yield('styles')
</head>
<body class="reg-body">
    <div class="header box-shadow">
        <img src="{{ asset('images/header.png') }}" width="100%">
    </div>
    @include('flash::message')
    @yield('content')

    @include('layouts.footer')
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/tether.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('custom/helpers.js') }}"></script>

    @yield('scripts')
</body>
</html>