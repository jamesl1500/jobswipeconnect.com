<?php
    $privacy_settings = new \App\Libraries\PrivacySettings;
    $ps = $privacy_settings->returnAllPrivacySettings($user->id);
?>
@php($title = "About " . $user->name . " | Profile")
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
                            <h2>{{ $user->username }}</h2>
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
                    <li><a href="{{ route('profile.index', $user->username) }}">Posts</a></li>
                    <li class="active"><a href="{{ route('profile.about', $user->username) }}">About</a></li>
                    <li><a href="{{ route('profile.resume', $user->username) }}">Resume</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="profile-page-content page-content">
        <div class="profile-page-content-inner row">
            <div class="col-lg-2 profile-empty-space"></div>
            <div class="col-lg-8 profile-page-about-content-middle">
                <!-- Cover Letter -->
                <div class="profile-page-about-cover-letter">
                    <div class="profile-page-about-cover-letter-header">
                        <h2>Cover Letter</h2>

                        @if($user->id == auth()->user()->id)
                            <button class="btn primary" data-bs-toggle="modal" data-bs-target="#editResumeModal">Edit</button>
                        @endif
                    </div>
                    <div class="profile-page-about-cover-letter-content">
                        <p>{{ $user->cover_letter }}</p>
                    </div>
                </div>

                <!-- Skills -->
                <div class="profile-page-about-skills">
                    <div class="profile-page-about-skills-header">
                        <h2>Skills</h2>
                    </div>
                    <div class="profile-page-about-skills-content">

                    </div>
                </div>
            </div>
            <div class="col-lg-2 profile-empty-space"></div>
        </div>
    </div>

    <!-- Edit Resume Modal -->
    <div class="modal" id="editResumeModal" tabindex="-1" aria-labelledby="editResumeModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Edit Resume</h2>
                    <button class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edit-resume-form" action="{{ route('profile.resume.post', $user->username) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="form-input">
                                <label for="resume">Resume</label>
                                <input type="file" name="resume" id="resume" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection