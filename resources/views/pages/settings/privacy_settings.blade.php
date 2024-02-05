<?php
    $privacy_settings = new \App\Libraries\PrivacySettings;
    $ps = $privacy_settings->returnAllPrivacySettings();
?>

@php($title = 'Settings | Change Email')
@extends('layouts.authorized')

@section('content')
<div class="settings-page page">
    <div class="settings-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Settings</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Change privacy settings</h2>
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
                        <li><a href="{{ route('settings.change_email') }}">Change Email</a></li>
                        <li><a href="{{ route('settings.change_password') }}">Change Password</a></li>
                        <li class="active"><a href="{{ route('settings.privacy_settings') }}">Privacy Settings</a></li>
                        <li><a href="{{ route('settings.notifications') }}">Notifications</a></li>
                    </ul>
                </div>
            </div>
            <div class="settings-content col-lg-9">
                <div class="settings-content-inner">
                    <div class="settings-content-form-error">
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
                    <div class="settings-content-form-header">
                        <h2>Change Privacy Settings</h2>
                    </div>
                    <form action="{{ route('settings.privacy_settings.post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Change Password -->
                        <div class="form-group">
                            <!-- Show email -->
                            <div class="form-input">
                                <label for="show_email">Show Email</label>
                                <p>Do you want to show your email to other users?</p>
                                <select name="show_email" id="show_email" class="form-control">
                                    <option value="1" @if($ps->show_email == 1) selected @endif>Yes</option>
                                    <option value="0" @if($ps->show_email == 0) selected @endif>No</option>
                                </select>
                            </div>

                            <!-- Show phone -->
                            <div class="form-input">
                                <label for="show_phone">Show Phone Number</label>
                                <p>Do you want your phone number to be private?</p>
                                <select name="show_phone" id="show_phone" class="form-control">
                                    <option value="1" @if($ps->show_phone == 1) selected @endif>Yes</option>
                                    <option value="0" @if($ps->show_phone == 0) selected @endif>No</option>
                                </select>
                            </div>

                            <!-- Show Location -->
                            <div class="form-input">
                                <label for="show_location">Show Location</label>
                                <p>Do you want to show your location to other users?</p>
                                <select name="show_location" id="show_location" class="form-control">
                                    <option value="1" @if($ps->show_location == 1) selected @endif>Yes</option>
                                    <option value="0" @if($ps->show_location == 0) selected @endif>No</option>
                                </select>
                            </div>

                            <!-- Show Resume -->
                            <div class="form-input">
                                <label for="show_resume">Show Resume</label>
                                <p>Do you want to show your resume to other users?</p>
                                <select name="show_resume" id="show_resume" class="form-control">
                                    <option value="1" @if($ps->show_resume == 1) selected @endif>Yes</option>
                                    <option value="0" @if($ps->show_resume == 0) selected @endif>No</option>
                                </select>
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