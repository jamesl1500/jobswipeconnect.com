@php($title = 'Onboarding Step 2')
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
                <form action="{{ route('onboarding.step2.post') }}" method="post" enctype="multipart/form-data">
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
                    <!-- Resume -->
                    <div class="onboarding-form-area area-1">
                        <h2>Resume</h2>
                        <p>Got a resume?</p>

                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="resume">Resume</label>
                                <input type="file" name="resume" id="resume">
                            </div>
                        </div>
                    </div>

                    <!-- Cover Letter -->
                    <div class="onboarding-form-area area-2">
                        <h2>Cover letter?</h2>
                        <p>This will be your bio on your profile</p>

                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="cover_letter">Cover Letter</label>
                                <textarea name="cover_letter" id="cover_letter" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div class="onboarding-form-area area-3">
                        <h2>What are your skills?</h2>
                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="skills">Skills</label>
                                <textarea name="skills" id="skills" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Add a submit button -->
                    <input type="submit" value="Finished" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection