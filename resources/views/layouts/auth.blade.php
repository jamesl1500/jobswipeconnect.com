<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <meta name="robots" content="index, follow">
    <meta name="description" content="{{ env('APP_DESCRIPTION') }}">
    <meta name="keywords" content="{{ env('APP_KEYWORDS') }}">
    <meta name="author" content="{{ env('APP_AUTHOR') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $title }} | {{ env('APP_NAME') }}">
    <meta property="og:description" content="{{ env('APP_DESCRIPTION') }}">
    <meta property="og:image" content="{{ env('APP_URL') }}/images/logo.png">
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:site_name" content="{{ env('APP_NAME') }}">
    <meta property="og:type" content="website">

    <title>{{ $title }} | {{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="header-hold">
    @include('includes.header')
    @include('includes.alerts')
</div>
<div class="content-hold">
    @yield('content')
</div>
<div class="footer-hold">   
    @include('includes.footer')
</div>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://kit.fontawesome.com/8ea51260da.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>

@env('local')
    <script src="http://localhost:35729/livereload.js"></script>
@endenv
</body>
</html>