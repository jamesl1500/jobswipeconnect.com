@php($title = 'Register')
@extends('layouts.auth')

@section('content')
<div class="auth-page page">
    <div class="auth-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Reset Password</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Let's get you back into your account!</h2>
            </div>
        </div>
    </div>
    <div class="auth-page-content page-content">
        <div class="auth-page-content-inner">
            <div class="auth-page-content-form-header">
                <h2>Reset Password</h2>
            </div>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <div class="form-group">
                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="form-input">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-input">
                        <label for="password_confirmation">Confirm Password</label>

                        <input id="password_confirmation" type="password" name="password_confirmation" required />
                    </div>

                    <div class="form-input">
                        <button class="btn primary">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection