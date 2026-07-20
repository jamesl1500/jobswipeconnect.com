@php($title = 'Onboarding Step 1')
@php($onboardingStep = 1)
@php($onboardingStepCount = 2)
@extends('layouts.onboarding')

@section('content')
<div class="onboarding-content onboarding-page page">
    <div class="onboarding-content-inner">
        <div class="onboarding-content-header">
            <h1>Let's set up your profile</h1>
            <p>A few basics so we can personalize your experience.</p>
        </div>
        <div class="onboarding-content-box">
            @if($errors->any())
                <div class="onboarding-form-errors">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="onboarding-content-box-form">
                <form action="{{ route('onboarding.step1.post') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Profile Picture -->
                    <div class="onboarding-form-area">
                        <h2>Profile picture</h2>
                        <p>Help others recognize you.</p>

                        <div class="form-area-elements">
                            <div class="avatar-upload">
                                <div class="avatar-upload-preview">
                                    <img src="{{ asset('images/profile_picture_placeholder.jpg') }}" alt="Profile picture preview" id="avatar-preview">
                                    <label for="profile_picture"><i class="fas fa-camera"></i></label>
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/png, image/jpeg, image/jpg, image/gif, image/svg+xml">
                                </div>
                                <p class="avatar-upload-hint">PNG, JPG, or GIF. Max 2MB.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="onboarding-form-area">
                        <h2>Username</h2>

                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}" autocomplete="off">
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="onboarding-form-area">
                        <h2>Location</h2>
                        @if(auth()->user()->role == 'job-seeker')
                            <p>This helps us find jobs and companies near you.</p>
                        @else
                            <p>This helps us find job seekers for you.</p>
                        @endif

                        <div class="form-area-elements">
                            <div class="form-area-elements-inline">
                                <div class="form-area-element">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" id="address" value="{{ old('address') }}">
                                </div>
                                <div class="form-area-element">
                                    <label for="city">City</label>
                                    <input type="text" name="city" id="city" value="{{ old('city') }}">
                                </div>
                            </div>
                            <div class="form-area-elements-inline">
                                <div class="form-area-element">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" value="{{ old('state') }}">
                                </div>
                                <div class="form-area-element">
                                    <label for="zip">Zip</label>
                                    <input type="text" name="zip" id="zip" value="{{ old('zip') }}">
                                </div>
                                <div class="form-area-element">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" id="country" value="{{ old('country') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="onboarding-form-actions">
                        <input type="submit" value="Continue" class="btn primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('profile_picture').addEventListener('change', function (event) {
        const file = event.target.files[0];

        if (!file) {
            return;
        }

        document.getElementById('avatar-preview').src = URL.createObjectURL(file);
    });
</script>
@endsection
