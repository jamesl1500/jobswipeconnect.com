@php($title = $user->name . ' | Profile')
@extends('layouts.authorized')

@section('content')
<div class="profile-page page">
    <div class="profile-page-header">
        <div class="container page-header-container">
            <div class="profile-page-header-inner">
                <div class="profile-page-header-image">
                    <img src="{{ asset('storage/' .  $user->profile_picture ) }}" alt="{{ $user->name }}">
                </div>
                <div class="profile-page-header-content">
                    <div class="profile-page-header-content-inner">
                        <div class="profile-page-header-content-title">
                            <h1>{{ $user->name }}</h1>
                        </div>
                        <div class="profile-page-header-content-subtitle">
                            <h2>{{ $user->email }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-page-inline-navigation">
        <div class="container">
            <div class="profile-page-inline-navigation-inner">
                <ul>
                    <li class="active"><a href="{{ route('profile.index', $user->id) }}">Posts</a></li>
                    <li><a href="{{ route('profile.about', $user->id) }}">About</a></li>
                    <li><a href="{{ route('profile.resume', $user->id) }}">Resume</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection