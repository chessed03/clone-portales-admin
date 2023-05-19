<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->

    <link href="{{asset("template/admin/dist/css/adminlte.css")}}" rel="stylesheet">

    <link href="{{ asset("template/admin/dist/css/boxicons.min.css") }}" rel="stylesheet">

</head>
<body class="login-page" style="min-height: 466px;">

    <div class="login-box">

        <div class="card card-outline card-primary">

            @yield('content')

        </div>

    </div>

    <script src="{{ asset('template/admin/plugins/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('template/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('template/admin/dist/js/adminlte.min.js') }}"></script>

</body>
</html>
