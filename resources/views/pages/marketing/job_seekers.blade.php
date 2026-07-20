@php($title = "For Job Seekers")
@extends('layouts.both')

@section('content')
<div class="marketing-page landing-page page">
    <div class="page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>For Job Seekers</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Stop applying into the void. Start matching.</h2>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="landing-section-header">
                <span class="landing-eyebrow">Why job seekers use us</span>
                <h2>Built around how you actually job hunt</h2>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-magnifying-glass"></i></div>
                        <h3>Matched to you</h3>
                        <p>Your profile drives what you see &mdash; roles filtered by skills, location, and the job type you actually want.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-hand-pointer"></i></div>
                        <h3>Apply with a swipe</h3>
                        <p>Like a role and your profile goes straight to the employer. No cover letter essay required to say "I'm interested."</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-message"></i></div>
                        <h3>Talk right away</h3>
                        <p>When an employer likes you back, a conversation opens immediately. No waiting on an applicant tracker to reply.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="landing-audiences">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="landing-audience-card seeker">
                        <i class="fa-solid fa-user landing-audience-icon"></i>
                        <h3>What's in your profile</h3>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Your experience, education, and skills</li>
                            <li><i class="fa-solid fa-check"></i> A resume employers can view when you match</li>
                            <li><i class="fa-solid fa-check"></i> The job types and locations you're open to</li>
                        </ul>
                        @guest
                            <a href="{{ route('register') }}" class="btn primary">Create Your Profile</a>
                        @else
                            <a href="{{ route('dashboard.jobs') }}" class="btn primary">Start Matching</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="landing-cta">
        <div class="container">
            <div class="landing-cta-inner">
                <h2>Your next role is a swipe away</h2>
                <p>It only takes a couple of minutes to set up a profile.</p>
                @guest
                    <a href="{{ route('register') }}" class="btn primary">Get Started Free</a>
                @else
                    <a href="{{ route('jobs.index') }}" class="btn primary">Browse Jobs</a>
                @endguest
            </div>
        </div>
    </section>
</div>
@endsection
