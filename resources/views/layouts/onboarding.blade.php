<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    <meta name="robots" content="noindex, nofollow">

    <title>{{ $title }} | {{ env('APP_NAME') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="onboarding-topbar">
    <div class="onboarding-topbar-inner">
        <a href="{{ route('home') }}" class="onboarding-topbar-brand">
            <span class="logo-mark">J</span><span class="logo-word">obSwipe</span>
        </a>

        @isset($onboardingStep)
            <div class="onboarding-topbar-progress">
                <span class="onboarding-topbar-progress-label">Step {{ $onboardingStep }} of {{ $onboardingStepCount ?? 2 }}</span>
                <div class="onboarding-topbar-progress-track">
                    @for ($i = 1; $i <= ($onboardingStepCount ?? 2); $i++)
                        <span class="onboarding-topbar-progress-segment {{ $i <= $onboardingStep ? 'filled' : '' }}"></span>
                    @endfor
                </div>
            </div>
        @endisset

        <form action="{{ route('logout') }}" method="post" class="onboarding-topbar-exit">
            @csrf
            <button type="submit">Log out</button>
        </form>
    </div>
</div>

<div class="content-hold">
    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script src="https://kit.fontawesome.com/8ea51260da.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@env('local')
    <script src="http://localhost:35729/livereload.js"></script>
@endenv
</body>
</html>
