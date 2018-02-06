<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/4.0.0-beta.3/lux/bootstrap.min.css">
        <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        @yield('header')
        <style media="screen">
            .margin-top-3 {
                margin-top: 3em;
            }

            .table th, .table td {
                padding: 0.75rem !important;
            }
        </style>
    </head>
    <body>
        @include('bus-router-sg::_partials.navbar')

        <div class="container-fluid">
            @yield('content')
        </div>

        @yield('footer')
    </body>
</html>
