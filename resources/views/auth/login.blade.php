@php($title = 'Log in')
@extends('layouts.auth')

@section('content')
<div class="auth-page page">
    <div class="auth-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Log in</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Log in to join the fun!</h2>
            </div>
        </div>
    </div>
    <div class="auth-page-content page-content">
        <div class="auth-page-content-inner">
            <div class="auth-page-content-form-error">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <h2>Errors</h2>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @elseif(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @elseif(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
            <div class="auth-page-content-form-header">
                <h2>Log In</h2>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <!-- Email Address -->
                    <div class="form-input">
                        <label for="email">{{ __('Email') }}</label>
                        <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus />
                    </div>

                    <!-- Password -->
                    <div class="form-input">
                        <label for="password">{{ __('Password') }}</label>
                        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                    </div>

                    <!-- Remember Me -->
                    <div class="form-input">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="form-input">
                        <button class="btn primary">Log in</button>

                        @if (Route::has('password.request'))
                            <a style="float: right;" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection