@php($title = "Swipe Your Way To Work")
@extends('layouts.both')

@section('content')
<div class="landing-page">

    <section class="landing-hero">
        <div class="landing-hero-blob landing-hero-blob-1"></div>
        <div class="landing-hero-blob landing-hero-blob-2"></div>

        <div class="container landing-hero-inner">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="landing-hero-content">
                        <span class="landing-eyebrow">Job matching, reimagined</span>
                        <h1>Find work you'll<br>actually swipe right on.</h1>
                        <p>Job Swipe Connect matches job seekers and employers the way people actually decide — fast, visual, and mutual. Skip the endless scrolling through listings that don't fit.</p>

                        <div class="landing-hero-actions">
                            @auth
                                <a href="{{ route('dashboard.jobs') }}" class="btn primary">Go to Dashboard</a>
                            @else
                                <a href="{{ route('register') }}" class="btn primary">Get Started Free</a>
                                <a href="{{ route('jobs.index') }}" class="btn secondary">Browse Jobs</a>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="landing-hero-card">
                        <div class="landing-swipe-card">
                            <div class="landing-swipe-card-top">
                                <div class="landing-swipe-card-avatar"></div>
                                <div class="landing-swipe-card-title">
                                    <h3>Product Designer</h3>
                                    <p>Acme Co. &middot; Remote</p>
                                </div>
                            </div>
                            <div class="landing-swipe-card-tags">
                                <span class="badge">Full Time</span>
                                <span class="badge">Design</span>
                                <span class="badge">Remote</span>
                            </div>
                            <div class="landing-swipe-card-actions">
                                <span class="landing-swipe-pill dislike"><i class="fa-solid fa-xmark"></i></span>
                                <span class="landing-swipe-pill like"><i class="fa-solid fa-heart"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="landing-steps">
        <div class="container">
            <div class="landing-section-header">
                <span class="landing-eyebrow">How it works</span>
                <h2>Three steps to your next match</h2>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number">1</div>
                        <h3>Build your profile</h3>
                        <p>Add your experience, skills, and what you're looking for — or your company and open roles.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number">2</div>
                        <h3>Swipe to match</h3>
                        <p>Browse jobs or candidates one at a time. Like the ones that fit, pass on the ones that don't.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number">3</div>
                        <h3>Chat &amp; connect</h3>
                        <p>When it's a mutual match, a conversation opens up right away. No cold applications required.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="landing-audiences">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="landing-audience-card seeker">
                        <i class="fa-solid fa-user landing-audience-icon"></i>
                        <h3>For Job Seekers</h3>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Discover roles matched to your skills</li>
                            <li><i class="fa-solid fa-check"></i> Apply with a swipe, not a cover letter essay</li>
                            <li><i class="fa-solid fa-check"></i> Message employers the moment you match</li>
                        </ul>
                        @guest
                            <a href="{{ route('register') }}" class="btn primary">Create Your Profile</a>
                        @else
                            <a href="{{ route('dashboard.jobs') }}" class="btn primary">Start Matching</a>
                        @endguest
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="landing-audience-card employer">
                        <i class="fa-solid fa-building landing-audience-icon"></i>
                        <h3>For Employers</h3>
                        <ul>
                            <li><i class="fa-solid fa-check"></i> Post roles and review candidates visually</li>
                            <li><i class="fa-solid fa-check"></i> Match with applicants who are genuinely interested</li>
                            <li><i class="fa-solid fa-check"></i> Track interviews and hires in one place</li>
                        </ul>
                        @guest
                            <a href="{{ route('register') }}" class="btn primary">Post a Job</a>
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
                <h2>Ready to find your match?</h2>
                <p>It only takes a couple of minutes to set up a profile.</p>
                @auth
                    <a href="{{ route('dashboard.jobs') }}" class="btn primary">Go to Dashboard</a>
                @else
                    <a href="{{ route('register') }}" class="btn primary">Get Started Free</a>
                @endauth
            </div>
        </div>
    </section>

</div>
@endsection
