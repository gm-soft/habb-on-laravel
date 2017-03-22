<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="robots.txt">

    <title>@yield('title', "HABB - Сообщество геймеров Казахстана")</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('thirdparty/fa/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/frontend.css') }}">
    @yield('styles')
</head>
    <body>
        @include("layouts.front-nav")
        @include('flash::message')
        @yield('content')

        @include('layouts.footer')
        <script src="{{ asset('thirdparty/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/tether.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('custom/helpers.js') }}"></script>

        @yield('scripts')
    </body>
</html>