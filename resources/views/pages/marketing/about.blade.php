@php($title = "About Us")
@extends('layouts.both')

@section('content')
<div class="marketing-page landing-page page">
    <div class="page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>About {{ env('APP_NAME') }}</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Job matching, the way people actually decide.</h2>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="marketing-content">
                <p class="marketing-lead">Job Swipe Connect exists because job hunting and hiring both take too long, and too much of that time is wasted on mismatches that were obvious from the start.</p>

                <p>We built a matchmaker that works the way people actually make quick decisions: look, react, move on. Job seekers swipe through roles that fit their skills and interests. Employers swipe through candidates who are genuinely interested in what they're offering. When both sides like what they see, a conversation opens immediately &mdash; no cover letter required to get started.</p>

                <p>We're not trying to replace thoughtful hiring. We're trying to remove the friction that keeps good matches from ever finding each other in the first place.</p>
            </div>

            <div class="landing-section-header">
                <span class="landing-eyebrow">What we believe</span>
                <h2>The principles behind the product</h2>
            </div>

            <div class="row">
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-bolt"></i></div>
                        <h3>Fast beats exhaustive</h3>
                        <p>A quick, honest signal from both sides is worth more than a stack of applications nobody reads carefully.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-handshake"></i></div>
                        <h3>Matching is mutual</h3>
                        <p>A match only happens when both sides say yes. No cold outreach, no résumé black holes.</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="landing-step">
                        <div class="landing-step-number"><i class="fa-solid fa-comments"></i></div>
                        <h3>Conversations, not forms</h3>
                        <p>Once you match, you talk &mdash; directly, in the app &mdash; instead of waiting on an application tracker.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="landing-cta">
        <div class="container">
            <div class="landing-cta-inner">
                <h2>Ready to see it for yourself?</h2>
                <p>Create a profile and start matching in a couple of minutes.</p>
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
