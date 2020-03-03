<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel='shortcut icon' type='image/x-icon' href="{{URL::asset('favicon.ico')}}">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Thanh Tùng - Cá Nàng Hai') }}</title>
        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href=" {{URL::asset('css/fonts.nunito.css')}} " rel="stylesheet">
        <!-- Font awesome -->
        <link href=" {{URL::asset('css/fontawesome/css/all.css')}} " rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{URL::asset('css/bootstrap.min.css')}}">
        <!-- Data table -->
        <link rel="stylesheet" href="{{URL::asset('css/dataTables.bootstrap4.min.css')}}">
        <!-- My style -->
        <link rel="stylesheet" href="{{URL::asset('css/mystyle.css')}}">

        
    </head>
    <body>
        <div id="app">
            <!-- Header - Navbar -->
            @include('layouts.blocks.header-nav')

            <main class="py-4">
                @yield('content')
            </main>

            <!-- Footer -->
            @include('layouts.blocks.footer')
        </div>
        
    </body>
    <!-- script -->
    <script src="{{ URL::asset('js/jquery-3.3.1.js') }}"></script>
    <!-- <script src="{{ URL::asset('js/jquery.min.js') }}"></script> -->
    <script src="{{ URL::asset('js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <!-- Data table -->
    <script src="{{ URL::asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::asset('js/dataTables.bootstrap4.min.js') }}"></script>
    <!-- My define -->
    <script src="{{ URL::asset('js/mydefine.js') }}"></script>
    @yield('javascript')
</html>
