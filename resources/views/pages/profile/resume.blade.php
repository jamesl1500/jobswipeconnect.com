<?php
    $privacy_settings = new \App\Libraries\PrivacySettings;
    $ps = $privacy_settings->returnAllPrivacySettings($user->id);
?>
@php($title = $user->name . "'s resume | Profile")
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
                    <li><a href="{{ route('profile.about', $user->username) }}">About</a></li>
                    <li class="active"><a href="{{ route('profile.resume', $user->username) }}">Resume</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="profile-page-content page-content">
        <div class="profile-page-content-inner row">
            <div class="col-lg-3 profile-empty-space"></div>
            <div class="col-lg-6 profile-page-resume-content-middle">
                <div class="profile-page-resume-content-errors">
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
                <div class="profile-page-content-header">
                    <h1>Resume</h1>
                    <?php
                    if(auth()->user() && auth()->user()->id == $user->id) {
                        echo '<button id="openEditResumeModal" class="btn primary" data-bs-toggle="modal" data-bs-target="#editResumeModal">Edit Resume</button>';
                    }
                    ?>
                </div>
                <div class="profile-page-content-box">
                    <?php
                    if($user->resume) {
                        if($ps->show_resume == 1 || auth()->user() && auth()->user()->id == $user->id) {
                            // See if resume is a docx or pdf
                            $ext = pathinfo($user->resume, PATHINFO_EXTENSION);

                            if($ext == 'pdf') {
                                echo '<iframe src="' . asset('storage/' . $user->resume) . '" width="100%" height="500px"></iframe>';
                            } else {
                                echo '<p>' . $user->name . ' has not added a resume yet.</p>';
                            }
                        } else if(auth()->user() && auth()->user()->id == $user->id) {
                            // See if resume is a docx or pdf
                            $ext = pathinfo($user->resume, PATHINFO_EXTENSION);

                            if($ext == 'pdf') {
                                echo '<iframe src="' . asset('storage/' . $user->resume) . '" width="100%" height="500px"></iframe>';
                            } else {
                                echo '<p>' . $user->name . ' has not added a resume yet.</p>';
                            }
                        }else if(auth()->user()){
                            // See if resume is a docx or pdf
                            $ext = pathinfo($user->resume, PATHINFO_EXTENSION);

                            if($ext == 'pdf') {
                                echo '<iframe src="' . asset('storage/' . $user->resume) . '" width="100%" height="500px"></iframe>';
                            } else {
                                echo '<p>' . $user->name . ' has not added a resume yet.</p>';
                            }
                        } else {
                            echo '<p>' . $user->name . ' has privated their resume. <a href="/login">Log in</a> to view it</p>';
                        }
                    } else {
                        echo '<p>' . $user->name . ' has not added a resume yet.</p>';
                    }
                    ?>
                </div>
            </div>
            <div class="col-lg-3 profile-empty-space"></div>
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