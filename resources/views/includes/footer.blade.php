<footer class="footer-main">
    <div class="footer-main-inner">
        <div class="footer-top">
            <div class="footer-brand">
                <a href="{{ route('home') }}" class="footer-brand-logo">
                    <span class="logo-mark">J</span><span class="logo-word">obSwipe</span>
                </a>
                <p>Swipe your way to your next job, or your next great hire. Matching made fast, human, and a little bit fun.</p>
                <ul class="footer-social">
                    <li><a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="#" aria-label="X / Twitter"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Job Seekers</h4>
                <ul>
                    <li><a href="{{ route('marketing.job_seekers') }}">Why Job Swipe</a></li>
                    <li><a href="{{ route('jobs.index') }}">Browse Jobs</a></li>
                    <li><a href="{{ route('dashboard.jobs') }}">Matchmaker</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Employers</h4>
                <ul>
                    <li><a href="{{ route('marketing.employers') }}">Why Job Swipe</a></li>
                    <li><a href="{{ route('jobs.create') }}">Post a Job</a></li>
                    <li><a href="{{ route('companies.index') }}">Companies</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('marketing.about') }}">About</a></li>
                    <li><a href="{{ route('marketing.contact') }}">Contact</a></li>
                    @guest
                        <li><a href="{{ route('login') }}">Log In</a></li>
                    @else
                        <li><a href="{{ route('dashboard.jobs') }}">Dashboard</a></li>
                    @endguest
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} {{ env('APP_NAME') }}. All rights reserved.</p>
            <ul class="footer-legal">
                <li><a href="{{ route('marketing.privacy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('marketing.terms') }}">Terms of Service</a></li>
            </ul>
        </div>
    </div>
</footer>
