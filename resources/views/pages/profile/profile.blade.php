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
    <div class="profile-page-content page-content">
        <div class="profile-page-content-inner row">
            <div class="col-lg-2 profile-empty-space"></div>
            <div class="col-lg-8 profile-page-about-content-middle">
                <div class="profile-page-content-box">
                    @if(count($posts) > 0)
                        <?php
                            foreach($posts as $post)
                            {
                                echo view('components.post', ['post' => $post]);
                            }
                        ?>
                    @else
                        <div class="no-posts">
                            <h3>No posts found!</h3>
                            <p>This user has not made any posts yet!</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 profile-empty-space"></div>
        </div>
    </div>
</div>
@endsection