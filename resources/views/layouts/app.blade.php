<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">

    <title>@yield('title')</title>

    <!-- Loading third party fonts -->
    <link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
    <link href="{{ mix('_assets/fonts/font-awesome.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Loading main css file -->
    <link rel="stylesheet" href="{{ mix('_assets/css/style.css') }}">
    @stack('styles')
</head>
<body>
<div id="site-content">
    @include('includes.header')
    <main class="main-content">
        <div class="container">
            @yield('content')
        </div> <!-- .container -->
    </main>
    @include('includes.footer')
</div>
<!-- Default snippet for navigation -->
<script src="{{ mix('_assets/js/script.js') }}"></script>
@stack('scripts')
</body>
</html>
