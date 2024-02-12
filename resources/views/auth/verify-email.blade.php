@php($title = 'Verify Email')
@extends('layouts.auth')

@section('content')
<div class="auth-page page">
    <div class="auth-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Forgot Password</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Let's get you back into your account!</h2>
            </div>
        </div>
    </div>
    <div class="auth-page-content page-content">
        <div class="auth-page-content-inner">
            <div class="auth-page-content-form-header">
                <h2>Verify Email</h2>
            </div>
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>
            @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
            
                <div>
                    <button class="btn primary" style="width: 100%;margin-bottom: 10px;">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </form>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            
                <button type="submit" class="btn secondary" style="width: 100%;">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</div>
@endsection