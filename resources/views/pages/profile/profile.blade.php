@php($title = $user->name . ' | Profile')
@extends('layouts.both')

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
                            <?php 
                                if(Auth::check())
                                {
                                    // Check to see if user is in profile users followings
                                    $isFollowing = App\Models\Followings::where('user_id', $user->id)->where('following_id', Auth::user()->id)->first();

                                    if($isFollowing)
                                    {
                                        ?>
                                            <h2>{{ $user->username }} &middot; Follows You</h2>
                                        <?php
                                    }else{
                                        ?>
                                            <h2>{{ $user->username }}</h2>
                                        <?php
                                    }
                                }else{
                            ?>
                                <h2>{{ $user->username }}</h2>
                            <?php
                                }
                            ?>
                        </div>
                        <div class="profile-page-header-content-actions">
                            @if (auth()->user() && auth()->user()->id == $user->id)
                                <a href="{{ route('settings.index', $user->username) }}" class="btn primary">Edit Profile</a>
                            @else
                                <?php
                                // Show follow button if logged user is not the same as the profile user
                                if(Auth::check())
                                {
                                    if(Auth::user()->id != $user->id)
                                    {
                                        // Check if logged user is following the profile user
                                        if(Auth::user()->followings->contains('following_id', $user->id))
                                        {
                                            ?>
                                                <form action="{{ route('unfollow') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn primary-hollow">Unfollow</button>
                                                    <a href="{{ route('messages.create_conversation', $user->id) }}" class="btn primary">Message</a>
                                                </form>
                                            <?php
                                        }else{
                                            ?>
                                                <form action="{{ route('follow') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                    <button type="submit" class="btn primary">Follow</button>
                                                    <a href="{{ route('messages.create_conversation', $user->id) }}" class="btn primary">Message</a>
                                                </form>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <a href="{{ route('settings.index') }}" class="btn primary">Settings</a>
                                        <?php
                                    }
                                }else{
                                    ?>
                                        <a href="{{ route('login') }}" class="btn primary">Login</a>
                                    <?php
                                }
                                ?>
                            @endif
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
                    <li class="active"><a href="{{ route('profile.index', $user->username) }}">Posts</a></li>
                    <li><a href="{{ route('profile.about', $user->username) }}">About</a></li>
                    <li><a href="{{ route('profile.resume', $user->username) }}">Resume</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection