@php($title = 'Onboarding Step 2')
@php($onboardingStep = 2)
@php($onboardingStepCount = 2)
@extends('layouts.onboarding')

@section('content')
<div class="onboarding-content onboarding-page page">
    <div class="onboarding-content-inner">
        <div class="onboarding-content-header">
            <h1>Tell us about your experience</h1>
            <p>This helps employers get a feel for who you are.</p>
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
                <form action="{{ route('onboarding.step2.post') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <!-- Resume -->
                    <div class="onboarding-form-area">
                        <h2>Resume</h2>
                        <p>PDF, DOC, or DOCX.</p>

                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="resume">Resume</label>
                                <input type="file" name="resume" id="resume" accept=".pdf,.doc,.docx">
                            </div>
                        </div>
                    </div>

                    <!-- Cover Letter -->
                    <div class="onboarding-form-area">
                        <h2>Cover letter</h2>
                        <p>This will appear as your bio on your profile.</p>

                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="cover_letter">Cover letter</label>
                                <textarea name="cover_letter" id="cover_letter"></textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Skills -->
                    <div class="onboarding-form-area">
                        <h2>Skills</h2>
                        <p>Separate each skill with a comma.</p>

                        <div class="form-area-elements">
                            <div class="form-area-element">
                                <label for="skills">Skills</label>
                                <textarea name="skills" id="skills"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="onboarding-form-actions">
                        <input type="submit" value="Finish" class="btn primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
