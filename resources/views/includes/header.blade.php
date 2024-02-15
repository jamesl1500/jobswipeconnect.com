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
                    <form action="{{ route('search.index') }}" method="get">
                        <?php
                            // Get the query
                            $query = request()->input('query');
                        ?>
                        <input type="text" name="query" id="query" placeholder="Search for jobs, companies, and more" value="{{ $query }}">
                    </form>
                </div>
            </div>
            <div class="header-navigation col-lg-4">
                <div class="header-navigation-inner">
                    <ul>
                        @if (Auth::check())
                            <!-- Dont show if user hasn't completed onboarding step 1 -->
                            @if (!Auth::user()->onboarding_step_1 or !Auth::user()->onboarding_step_2)
                                <li><a href="{{ route('onboarding.step1') }}">Complete Onboarding</a></li>
                            @else
                                <li><a href="{{ route('dashboard.jobs') }}">Dashboard</a></li>
                                <li><a href="{{ route('jobs.index') }}">Jobs</a></li>

                                <!-- User profile picture -->
                                <li class="profile_picture">
                                    <a href="{{ route('profile.index', ['username' => Auth::user()->username]) }}">
                                        <img src="{{ asset('storage/' . Auth::user()->profile_picture) }}" alt="Profile Picture" />
                                    </a>
                                </li>

                                <!-- Dropdown menu -->
                                <li class="h-dropdown"><i class="fa-solid fa-bars"></i></li>
                            @endif
                        @else
                            <!-- If user is not logged in -->
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li><a href="">About</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <!-- Dropdown menu -->
                            <li class="h-dropdown"><i class="fa-solid fa-bars"></i></li>
                        @endif
                    </ul>
                </div>

                <!-- Dropdown menu -->
                <div class="header-dropdown hidden">
                    <ul>
                        @if (Auth::check())
                            <!-- Dont show if user hasn't completed onboarding step 1 -->
                            @if (!Auth::user()->onboarding_step_2)
                                <li><a href="{{ route('onboarding.step1') }}">Complete Onboarding</a></li>
                            @else
                                <li><a href="{{ route('companies.index') }}">Companies</a></li>
                                <li><a href="{{ route('settings.index') }}">Settings</a></li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Logout
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
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>   
                </div>
            </div>
        </div>
    </div>
</header>