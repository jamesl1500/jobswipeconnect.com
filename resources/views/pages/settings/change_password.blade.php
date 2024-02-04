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
                <h2>Change password</h2>
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
                        <li class="active"><a href="{{ route('settings.change_password') }}">Change Password</a></li>
                        <li><a href="{{ route('settings.privacy_settings') }}">Privacy Settings</a></li>
                        <li><a href="{{ route('settings.notifications') }}">Notifications</a></li>
                    </ul>
                </div>
            </div>
            <div class="settings-content col-lg-9">
                <div class="settings-content-inner">
                    <div class="settings-content-form-error">
                        @if($errors->any())
                            <div class="alert alert-danger">
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
                        <h2>Change Password</h2>
                    </div>
                    <form action="{{ route('settings.change_password.post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Change Password -->
                        <div class="form-group">
                            <div class="form-input">
                                <label for="current_password">Current Password</label>
                                <input type="password" name="current_password" id="current_password">
                            </div>
                            <div class="form-input">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password">
                            </div>
                            <div class="form-input">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation">
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