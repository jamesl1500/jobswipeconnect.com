@php($title = "Terms of Service")
@extends('layouts.both')

@section('content')
<div class="marketing-page page">
    <div class="page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Terms of Service</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Last updated: {{ now()->format('F j, Y') }}</h2>
            </div>
        </div>
    </div>

    <div class="page-content">
        <div class="container">
            <div class="marketing-content marketing-prose">
                <p class="marketing-lead">By creating an account or using {{ env('APP_NAME') }}, you agree to these terms. Please read them carefully.</p>

                <h2>Using Our Service</h2>
                <p>You must be at least 16 years old to create an account. You're responsible for the accuracy of the information in your profile and for keeping your login credentials secure.</p>

                <h2>Your Content</h2>
                <p>You retain ownership of the profile information, resumes, job listings, and messages you post. By posting content, you grant us a license to display it to other users as part of the normal operation of the matching and messaging features.</p>

                <h2>Acceptable Use</h2>
                <p>You agree not to misrepresent yourself or a company, post false or misleading job listings, harass other users, or use the platform to collect user data outside of its intended purpose. We may suspend or remove accounts that violate these terms.</p>

                <h2>Matches Are Not Guarantees</h2>
                <p>Job Swipe Connect helps job seekers and employers find each other. We don't guarantee employment, candidate quality, or the outcome of any interview or hiring decision made between matched users.</p>

                <h2>Account Termination</h2>
                <p>You can delete your account at any time from your settings. We may suspend or terminate accounts that violate these terms or that we reasonably believe are fraudulent or harmful to other users.</p>

                <h2>Disclaimer of Warranties</h2>
                <p>The service is provided "as is." We work to keep it reliable and accurate, but we don't guarantee it will be uninterrupted or error-free.</p>

                <h2>Changes to These Terms</h2>
                <p>We may update these terms as the product evolves. Continued use of the service after a change means you accept the updated terms.</p>

                <h2>Contact Us</h2>
                <p>Questions about these terms? <a href="{{ route('marketing.contact') }}">Get in touch</a> and we'll be glad to help.</p>
            </div>
        </div>
    </div>
</div>
@endsection
