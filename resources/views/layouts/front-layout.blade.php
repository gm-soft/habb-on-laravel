<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="robots.txt">

    <title>@yield('title', "HABB - Сообщество геймеров Казахстана")</title>

    <link rel="stylesheet" href="{{ asset('uikit/css/uikit.min.css') }}">
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
        <script src="{{ asset('uikit/js/uikit.min.js') }}"></script>
        <script src="{{ asset('uikit/js/uikit-icons.min.js') }}"></script>
        <script src="{{ asset('custom/helpers.js') }}"></script>

        @yield('scripts')
    </body>
</html>