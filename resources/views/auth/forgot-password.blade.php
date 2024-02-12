@php($title = 'Forgot Password')
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
                <h2>Forgot Password?</h2>
            </div>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <!-- Email Address -->
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>

                    <div class="form-input">
                        <button class="btn primary">Email Password Reset Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection