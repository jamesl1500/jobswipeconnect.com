@php($title = 'Register')
@extends('layouts.auth')

@section('content')
<div class="auth-page page">
    <div class="auth-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Register</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Register to get started</h2>
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
                <h2>Register</h2>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <!-- Name -->
                    <div class="form-input">
                        <label for="name">Name</label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                    </div>

                    <!-- Email Address -->
                    <div class="form-input">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required />
                    </div>

                    <!-- Role chooser -->
                    <div class="form-input">
                        <label for="role">Choose your role</label>
                        <ul>
                            <li>Job Seeker: You're seeking a job and would like to apply to jobs</li>
                            <li>Job Poster: You're a business or person who is looking for job seekers</li>
                        </ul>

                        <select id="role" name="role" required>
                            <option>Choose your role</option>
                            <option value="job-seeker">Job Seeker</option>
                            <option value="job-poster">Job Poster</option>
                        </select>
                    </div>    

                    <!-- Password -->
                    <div class="form-input">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-input">
                        <label for="password_confirmation">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required />
                    </div>

                    <div class="form-input">
                        <button class="btn primary">Register</button>
                        <a class="" style="float: right;" href="{{ route('login') }}">Already registered?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection