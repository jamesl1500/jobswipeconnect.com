@php($title = $user->name . ' | Profile')
@extends('layouts.both')

@section('content')
<div class="profile-page page">
    <!-- Header -->
    @include('pages.profile.includes.header')
    
    <div class="profile-page-inline-navigation">
        <div class="container">
            <div class="profile-page-inline-navigation-inner">
                <ul>
                    <li class="active"><a href="{{ route('profile.index', $user->username) }}">Posts</a></li>
                    <li><a href="{{ route('profile.about', $user->username) }}">About</a></li>
                    <li><a href="{{ route('profile.resume', $user->username) }}">Resume</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection