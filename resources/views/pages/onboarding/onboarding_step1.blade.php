@php($title = 'Onboarding Step 1')
@extends('layouts.onboarding')

@section('content')
<div class="onboarding-content onboarding-page page">
    <div class="onboarding-content-inner">
        <div class="onboarding-content-header">
            <h1>Onboarding</h1>
            <h3>Lets get you setup</h3>
        </div>
        <div class="onboarding-content-box">
            <div class="onboarding-content-box-form">
                <!-- Wrap in a form element -->
                <form action="{{ route('onboarding.step1.post') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <?php 
                        // Display errors
                        if($errors->any()) {
                            ?>
                                <div class="alert alert-danger">
                                    <ul>
                                        <?php
                                        foreach($errors->all() as $error) {
                                            ?>
                                                <li>{{ $error }}</li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php
                        }
                    ?>
                    <!-- Profile Picture -->
                    <div class="onboarding-form-area area-1">
                        <h2>Profile Picture</h2>
                        <p>Upload a profile picture to help others recognize you!</p>

                        <div class="form-area-elements">
                            <div class="profile_picture">
                                <img src="{{ asset('images/profile_picture_placeholder.jpg') }}" alt="Profile Picture" id="profile_picture">
                            </div>
                            <div class="form-area-element">
                                <label for="profile_picture">Profile Picture</label>
                                <input type="file" name="profile_picture" name="profile_picture" id="profile_picture">
                            </div>
                        </div>
                    </div>

                    <!-- Username -->
                    <div class="onboarding-form-area area-2">
                        <h2>Username</h2>

                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" value="{{ old('username') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="onboarding-form-area area-3" style="margin-bottom: 0px;">
                        <h2>Address</h2>
                        <?php
                        if(auth()->user()->role == 'job-seeker') {
                            ?>
                                <p>This helps us find jobs and companies near you!</p>
                            <?php
                        }else {
                            ?>
                                <p>This helps us find job seekers for you!</p>
                            <?php
                        }
                        ?>

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
                                <div class="form-area-element">
                                    <label for="state">State</label>
                                    <input type="text" name="state" id="state" value="{{ old('state') }}">
                                </div>
                            </div>
                            <div class="form-area-elements-inline">
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
                        
                        <!-- Add a submit button -->
                        <input type="submit" value="Next Step" class="btn primary" style="margin-bottom: 0px;">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection