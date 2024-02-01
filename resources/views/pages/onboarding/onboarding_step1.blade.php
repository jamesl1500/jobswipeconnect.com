@php($title = 'Onboarding Step 1')
@extends('layouts.onboarding')

@section('content')
<div class="onboarding-content">
    <div class="onboarding-content-header">
        <h1>Lets get you setup</h1>
    </div>
    <div class="onboarding-content-box">
        <div class="onboarding-content-box-header">
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
                    <h2>Step 1: Profile Picture</h2>
                    <p>Lets see how you look</p>

                    <div class="form-area-elements">
                        <div class="profile_picture">
                            <img src="{{ asset('images/profile_picture_placeholder.png') }}" alt="Profile Picture" id="profile_picture">
                        </div>
                        <div class="form-area-element">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" name="profile_picture" name="profile_picture" id="profile_picture">
                        </div>
                    </div>
                </div>

                <!-- Address -->
                <div class="onboarding-form-area area-2">
                    <h2>Step 2: Address</h2>
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
                        <div class="form-area-element">
                            <label for="zip">Zip</label>
                            <input type="text" name="zip" id="zip" value="{{ old('zip') }}">
                        </div>
                        <div class="form-area-element">
                            <label for="country">Country</label>
                            <input type="text" name="country" id="country" value="{{ old('country') }}">
                        </div>
                    </div>
                    <!-- Add a submit button -->
                    <div class="form-area-elements">
                        <input type="submit" value="Next Step" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection