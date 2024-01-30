@php($title = 'Register')
@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div>
        <label for="name">{{ __('Name') }}</label>

        <input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required autofocus />
    </div>

    <!-- Email Address -->
    <div class="mt-4">
        <label for="email">{{ __('Email') }}</label>

        <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password">{{ __('Password') }}</label>

        <input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
    </div>

    <!-- Role chooser -->
    <div class="mt-4">
        <label for="role">{{ __('Choose your role') }}</label>
        <ul>
            <li>Job Seeker: You're seeking a job and would like to apply to jobs</li>
            <li>Job Poster: You're a business or person who is looking for job seekers</li>
        </ul>

        <select id="role" class="block mt-1 w-full" name="role" required>
            <option>Choose your role</option>
            <option value="job-seeker">Job Seeker</option>
            <option value="job-poster">Job Poster</option>
        </select>
    </div>

    <!-- Confirm Password -->
    <div class="mt-4">
        <label for="password_confirmation">{{ __('Confirm Password') }}</label>

        <input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
    </div>

    <div class="flex items-center justify-end mt-4">
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">{{ __('Already registered?') }}</a>

        <button class="ml-4">{{ __('Register') }}</button>
    </div>
</form>
@endsection