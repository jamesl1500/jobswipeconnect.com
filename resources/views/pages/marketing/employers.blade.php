@php($title = "For Employers")
@extends('layouts.both')

@section('content')
<div class="marketing-page landing-page page">
    <div class="page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>For Employers</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Hire people who are actually interested.</h2>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="landing-section-header">
                <span class="landing-eyebrow">Why employers use us</span>
                <h2>A faster way to fill the role</h2>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-bullhorn"></i></div>
                        <h3>Post in minutes</h3>
                        <p>Create a company profile, list the role, and start seeing matched candidates the same day.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-users"></i></div>
                        <h3>Review visually</h3>
                        <p>Swipe through candidates one at a time instead of triaging a folder of résumés.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-clipboard-check"></i></div>
                        <h3>Track the pipeline</h3>
                        <p>Move matched candidates through interviewing, hires, and rejected &mdash; all from one dashboard.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="landing-audiences">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="landing-audience-card employer">
                        <i class="fa-solid fa-building landing-audience-icon"></i>
                        <h3>What you get</h3>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> A company profile with your open roles</li>
                            <li><i class="fa-solid fa-check"></i> Candidates who already liked your listing</li>
                            <li><i class="fa-solid fa-check"></i> Direct messaging with every match</li>
                        </ul>
                        @guest
                            <a href="{{ route('register') }}" class="btn primary">Create a Company</a>
                        @else
                            <a href="{{ route('jobs.create') }}" class="btn primary">Post a Job</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="landing-cta">
        <div class="container">
            <div class="landing-cta-inner">
                <h2>Ready to find your next hire?</h2>
                <p>Post a role and start matching with interested candidates today.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn primary">Get Started Free</a>
                @else
                    <a href="{{ route('jobs.create') }}" class="btn primary">Post a Job</a>
                @endguest
            </div>
        </div>
    </section>
</div>
@endsection
