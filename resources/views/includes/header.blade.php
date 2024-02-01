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
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="header-navigation col-lg-4">
                <div class="header-navigation-inner">

                </div>
            </div>
        </div>
    </div>
</header>