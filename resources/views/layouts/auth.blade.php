<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo csrf_token(); ?>">

    <!-- SEO -->
    <meta name="robots" content="index, follow">
    <meta name="description" content="<?php echo env('APP_DESCRIPTION'); ?>">
    <meta name="keywords" content="<?php echo env('APP_KEYWORDS'); ?>">
    <meta name="author" content="<?php echo env('APP_AUTHOR'); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo $title; ?> | <?php echo env('APP_NAME'); ?>">
    <meta property="og:description" content="<?php echo env('APP_DESCRIPTION'); ?>">
    <meta property="og:image" content="<?php echo env('APP_URL'); ?>/images/logo.png">
    <meta property="og:url" content="<?php echo env('APP_URL'); ?>">
    <meta property="og:site_name" content="<?php echo env('APP_NAME'); ?>">
    <meta property="og:type" content="website">

    <title><?php echo $title; ?> | <?php echo env('APP_NAME'); ?></title>

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="header-hold">
    @include('includes.header')
</div>
<div class="content-hold">
    @yield('content')
</div>
<div class="footer-hold">   
    @include('includes.footer')
</div>

@env('local')
    <script src="http://localhost:35729/livereload.js"></script>
@endenv
</body>
</html>