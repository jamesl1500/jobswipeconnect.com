@php($title = 'Settings | Basic Information')
@extends('layouts.authorized')

@section('content')
<div class="settings-page page">
    <div class="settings-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Settings</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Edit Basic Information</h2>
            </div>
        </div>
    </div>
    <div class="container page-content">
        <div class="left-navigation">
            <div class="left-navigation-menu">
                <ul>
                    <li class="active"><a href="{{ route('settings.index') }}">Basic Information</a></li>
                    <li><a href="{{ route('settings.change_email') }}">Change Email</a></li>
                    <li><a href="{{ route('settings.change_password') }}">Change Password</a></li>
                    <li><a href="{{ route('settings.privacy_settings') }}">Privacy Settings</a></li>
                    <li><a href="{{ route('settings.notifications') }}">Notifications</a></li>
                </ul>
            </div>
        </div>
        <div class="settings-content">
            <div class="settings-content-form">
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
                    <h2>Edit Basic Information</h2>
                </div>
                <form action="{{ route('settings.index.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <!-- Edit profile picture -->
                    <div class="form-group">
                        <div class="form-input">
                            <!-- Show current users profile picture -->
                            <div class="profile_picture">
                                <img src="{{ asset('storage/' . auth()->user()->profile_picture) }}" alt="Profile Picture" id="profile_picture">
                            </div>
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" name="profile_picture" id="profile_picture">
                        </div>
                    </div>
                    <!-- Edit name -->
                    <div class="form-group">
                        <div class="form-input">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="{{ auth()->user()->name }}">
                        </div>
                    </div>

                    <!-- Edit address -->
                    <div class="form-group">
                        <div class="inline-form-group">
                            <div class="form-input">
                                <label for="address">Address</label>
                                <input type="text" name="address" id="address" value="{{ auth()->user()->address }}">
                            </div>
                            <div class="form-input">
                                <label for="city">City</label>
                                <input type="text" name="city" id="city" value="{{ auth()->user()->city }}">
                            </div>
                            <div class="form-input">
                                <label for="state">State</label>
                                <input type="text" name="state" id="state" value="{{ auth()->user()->state }}">
                            </div>
                        </div>
                        <div class="inline-form-group">
                            <div class="form-input">
                                <label for="zip">Zip</label>
                                <input type="text" name="zip" id="zip" value="{{ auth()->user()->zip }}">
                            </div>
                            <div class="form-input">
                                <label for="country">Country</label>
                                <input type="text" name="country" id="country" value="{{ auth()->user()->country }}">
                            </div>
                        </div>
                    </div>

                    <!-- Edit phone -->
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ auth()->user()->phone }}">
                    </div>

                    <!-- Submit -->
                    <div class="form-group">
                        <input type="submit" value="Save Changes" class="btn" />
                    </div>
                </form>
            </div>
        </div>  
    </div>
</div>
@endsection