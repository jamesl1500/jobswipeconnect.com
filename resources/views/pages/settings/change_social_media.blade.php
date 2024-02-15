@php($title = 'Settings | Social Media')
@extends('layouts.authorized')

@section('content')
<div class="settings-page page">
    <div class="settings-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Settings</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Change email</h2>
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
                        <li class="active"><a href="{{ route('settings.social_media') }}">Social media</a></li>
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
                        <h2>Social Media</h2>
                    </div>
                    <form action="{{ route('settings.social_media.post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Edit email -->
                        <div class="form-group">
                            <div class="form-input">
                                <label for="portfolio">Portfolio</label>
                                <input type="text" name="portfolio" id="portfolio" value="{{ auth()->user()->portfolio }}" />
                            </div>
                            <div class="form-input">
                                <label for="github">Github</label>
                                <input type="text" name="github" id="github" value="{{ auth()->user()->github }}" />
                            </div>
                            <div class="form-input">
                                <label for="facebook">Facebook</label>
                                <input type="text" name="facebook" id="facebook" value="{{ auth()->user()->facebook }}" />
                            </div>
                            <div class="form-input">
                                <label for="linkedin">Linkedin</label>
                                <input type="text" name="linkedin" id="linkedin" value="{{ auth()->user()->linkedin }}" />
                            </div>
                            <div class="form-input">
                                <label for="twitter">Twitter</label>
                                <input type="text" name="twitter" id="twitter" value="{{ auth()->user()->twitter }}" />
                            </div>
                            <div class="form-input">
                                <label for="instagram">Instagram</label>
                                <input type="text" name="instagram" id="instagram" value="{{ auth()->user()->instagram }}" />
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