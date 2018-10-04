<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="googlebot" content="noindex">

    <meta name="robots" content="robots.txt">

    <title>@yield('title', "Habb Сообщество геймеров")</title>

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('uikit/css/extend.css') }}">
    <link rel="stylesheet" href="{{ asset('thirdparty/fa/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/shared.css') }}">
    <link rel="stylesheet" href="{{ asset('custom/frontend.css') }}">
    @yield('styles')

</head>
<body>

@yield('content')

<script src="{{ asset('thirdparty/jquery-3.3.1.min.js') }}"></script>
<script src="{{ asset('thirdparty/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.js') }}"></script>

<script src="{{ asset('custom/utils.js') }}"></script>
@yield('scripts')
</body>
</html>