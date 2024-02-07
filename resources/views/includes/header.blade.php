<header class="header-main">
    <div class="header-main-inner container">
        <div class="header-main-row row">
            <div class="header-branding col-lg-2">
                <div class="header-branding-inner">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" />
                    </a>
                </div>
            </div>
            <div class="header-search col-lg-6">
                <div class="header-search-inner">
                    <form action="{{ route('search') }}" method="get">
                        <input type="text" name="query" id="query" placeholder="Search for jobs, companies, and more">
                    </form>
                </div>
            </div>
            <div class="header-navigation col-lg-4">
                <div class="header-navigation-inner">
                    <ul>
                        @if (Auth::check())
                            <!-- Dont show if user hasn't completed onboarding step 1 -->
                            @if (!Auth::user()->onboarding_step_2)
                                <li><a href="{{ route('onboarding.step1') }}">Complete Onboarding</a></li>
                            @else
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li><a href="">Jobs</a></li>

                                <!-- User profile picture -->
                                <li class="profile_picture">
                                    <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">
                                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" />
                                    </a>
                                </li>
                            @endif
                        @else
                            <!-- If user is not logged in -->
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="">About</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @endif

                        <!-- Dropdown menu -->
                        <li class="dropdown"><i class="fa-solid fa-bars"></i></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>