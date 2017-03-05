<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="robots" content="robots.txt">
    <meta name="googlebot" content="noindex">

    <title>@yield('title', "Управление Habb")</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/backend.css') }}">

    @yield('styles')

</head>
    <body>

        @include(\App\Helpers\Constants::BackNavPath)
        <div class="container">
            @include(\App\Helpers\Constants::FlashLayout)
            @include('flash::message')

            @yield('content')
        </div>

        <script src="{{ asset('js/tether.min.js') }}"></script>
        <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('js/select2.min.js') }}"></script>
        <script src="{{ asset('js/dataTables.min.js') }}"></script>
        <script src="{{ asset('custom/helpers.js') }}"></script>
        @yield('scripts')
    </body>
</html>