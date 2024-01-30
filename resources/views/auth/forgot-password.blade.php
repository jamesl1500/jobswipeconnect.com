@php($title = 'Forgot Password')
@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email">{{ __('Email') }}</label>

        <input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}" required autofocus />
    </div>

    <div class="flex items-center justify-end mt-4">
        <button>
            {{ __('Email Password Reset Link') }}
        </button>
    </div>
</form>
@endsection