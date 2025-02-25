@php($title = 'Settings | Change Resume')
@extends('layouts.authorized')

@section('content')
<div class="settings-page page">
    <div class="settings-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Settings</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Change resume</h2>
            </div>
        </div>
    </div>
    <div class="container page-content">
        <div class="row page-row">
            <div class="left-navigation col-lg-3">
                <div class="left-navigation-header">
                    <h3>Settings</h3>
                </div>
                <div class="left-navigation-menu">
                    <ul>
                        <li><a href="{{ route('settings.index') }}">Basic Information</a></li>
                        <li class="active"><a href="{{ route('settings.change_resume') }}">Change Resume</a></li>
                        <li><a href="{{ route('settings.social_media') }}">Social media</a></li>
                        <li><a href="{{ route('settings.change_email') }}">Change Email</a></li>
                        <li><a href="{{ route('settings.change_password') }}">Change Password</a></li>
                        <li><a href="{{ route('settings.privacy_settings') }}">Privacy Settings</a></li>
                        <li><a href="{{ route('settings.notifications') }}">Notifications</a></li>
                    </ul>
                </div>
            </div>
            <div class="settings-content col-lg-9">
                <div class="settings-content-inner">
                    <div class="settings-content-form-header">
                        <h2>Change Resume</h2>
                    </div>
                    <form action="{{ route('settings.change_resume.post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Current resume -->
                        <div class="form-group">
                            <label for="resume"><b>Current resume</b></label>
                            <?php
                                $resume = json_decode(auth()->user()->resume);
                            ?>
                            <div class="resume-box">
                                <div class="resume-box-left">
                                    <p>{{ $resume->extension }}</p>
                                </div>
                                <div class="resume-box-right">
                                    <p class="name">{{ $resume->name }}</p>
                                    <!-- Show date uploaded in human readable form -->
                                    <p class="date">Uploaded: {{ \Carbon\Carbon::parse($resume->date)->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Edit resume -->
                        <div class="form-group">
                            <div class="form-input">
                                <label for="resume">New Resume</label>
                                <input type="file" name="resume" id="resume" />
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="form-group">
                            <input type="submit" value="Save Changes" class="btn primary" />
                        </div>
                    </form>
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection