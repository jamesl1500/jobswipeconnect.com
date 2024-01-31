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
            <form action="{{ route('onboarding.step1.post') }}" method="post">
                @csrf
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
                            <input type="file" name="profile_picture" id="profile_picture">
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
                            <p>This helps us find job seekers!</p>
                        <?php
                    }
                    ?>

                    <div class="form-area-elements">
                        <div class="form-area-element">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" id="first_name">
                        </div>
                        <div class="form-area-element">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name">
                        </div>
                        <div class="form-area-element">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection