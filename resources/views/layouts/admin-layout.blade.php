<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="robots" content="robots.txt">
    <meta name="googlebot" content="noindex">

    <title>@yield('title', "Управление Habb")</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('thirdparty/fa/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/backend.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/shared.css') }}">
    @yield('styles')
    @include("layouts.Metrika")


</head>
    <body>

        @include("layouts.admin-nav")
        @include('flash::message')
        @yield('content')

        @include('layouts.footer')

        <script src="{{ asset('thirdparty/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/tether.min.js') }}"></script>
        <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('scripts/framework.js') }}"></script>
        <script src="{{ asset('scripts/utils.js') }}"></script>
        @yield('scripts')
    </body>
</html>