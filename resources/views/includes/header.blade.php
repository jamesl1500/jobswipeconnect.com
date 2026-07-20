<header class="header-main">
    <div class="header-main-inner">
        <div class="header-main-row">
            <div class="header-branding">
                <div class="header-branding-inner">
                    <a href="{{ Auth::check() ? route('dashboard.jobs') : route('home') }}">
                        <span class="logo-mark">J</span><span class="logo-word">obSwipe</span>
                    </a>
                </div>
            </div>
            <div class="header-search">
                <div class="header-search-inner">
                    <form action="{{ route('search.index') }}" method="get">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" name="query" id="query" placeholder="Search for jobs, companies, and more" value="{{ request()->input('query') }}">
                    </form>
                </div>
            </div>
            <div class="header-navigation">
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
                            <li><a href="{{ route('marketing.about') }}">About</a></li>
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            <!-- Dropdown menu -->
                            <li class="h-dropdown"><i class="fa-solid fa-bars"></i></li>
                        @endif
                    </ul>
                </div>

                <!-- Dropdown menu -->
                <div class="header-dropdown hidden">
                    @if(Auth::check())
                        <!-- Make it where user can change their role between "job-seeker" or "job-poster" with two radio buttons in iphone style -->
                        <div class="header-dropdown-role">
                            <form action="{{ route('settings.change_role') }}" id="change-role-form" method="POST">
                                @csrf
                                <div class="toggle">
                                    <input type="radio" name="role" id="job-seeker" value="job-seeker" {{ Auth::user()->role == 'job-seeker' ? 'checked' : '' }}>
                                    <label for="job-seeker">Job Seeker</label>
                                    <input type="radio" name="role" id="job-poster" value="job-poster" {{ Auth::user()->role == 'job-poster' ? 'checked' : '' }}>
                                    <label for="job-poster">Job Poster</label>
                                </div>
                            </form>
                        </div>
                    @endif
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
                            <li><a href="{{ route('marketing.about') }}">About</a></li>
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