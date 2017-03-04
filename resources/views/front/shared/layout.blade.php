<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <meta name="robots" content="robots.txt">

    <title>@yield('title', "HABB - Сообщество геймеров Казахстана")</title>

    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/select2.min.css"  />
    <link rel="stylesheet" href="/css/dataTables.min.css"  />
    <link rel="stylesheet" href="/custom/shared.css">
    <link rel="stylesheet" href="/custom/frontend.css">
    @yield('styles')
</head>
    <body>
        @include(\App\Helpers\Constants::FrontNavPath)
        <div class="container">
            @include('flash::message')

            @yield('content')

        </div>

        <script src="/js/tether.min.js"></script>
        <script src="/js/jquery-3.1.1.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/select2.min.js"></script>
        <script src="/custom/helpers.js"></script>
        <script src="/js/dataTables.min.js"></script>

        @yield('scripts')
    </body>
</html>