<?php
    $privacy_settings = new \App\Libraries\PrivacySettings;
    $ps = $privacy_settings->returnAllPrivacySettings($user->id);
?>
@php($title = "About " . $user->name . " | Profile")
@extends('layouts.both')

@section('content')
<div class="profile-page page">
    <div class="profile-page-header">
        <div class="container page-header-container">
            <div class="profile-page-header-inner">
                <div class="profile-page-header-image">
                    <img src="{{ asset('storage/' .  $user->profile_picture ) }}" alt="{{ $user->name }}">
                </div>
                <div class="profile-page-header-content">
                    <div class="profile-page-header-content-inner">
                        <div class="profile-page-header-content-title">
                            <h1>{{ $user->name }}</h1>
                        </div>
                        <div class="profile-page-header-content-subtitle">
                            <h2>{{ $user->username }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-page-inline-navigation">
        <div class="container">
            <div class="profile-page-inline-navigation-inner">
                <ul>
                    <li><a href="{{ route('profile.index', $user->username) }}">Posts</a></li>
                    <li class="active"><a href="{{ route('profile.about', $user->username) }}">About</a></li>
                    <li><a href="{{ route('profile.resume', $user->username) }}">Resume</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="profile-page-content page-content">
        <div class="profile-page-content-inner row">
            <div class="col-lg-2 profile-empty-space"></div>
            <div class="col-lg-8 profile-page-about-content-middle">
                <div class="profile-page-content-errors">
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
                <!-- Cover Letter -->
                <div class="profile-page-about-cover-letter">
                    <div class="profile-page-about-cover-letter-header">
                        <h2>Cover Letter</h2>

                        @if(auth()->user() && $user->id == auth()->user()->id)
                            <button class="btn primary" data-bs-toggle="modal" data-bs-target="#editCoverLetterModal">Edit</button>
                        @endif
                    </div>
                    <div class="profile-page-about-cover-letter-content">
                        <p>{{ $user->cover_letter }}</p>
                    </div>
                </div>

                <!-- Skills -->
                <div class="profile-page-about-skills">
                    <div class="profile-page-about-skills-header">
                        <h2>Skills</h2>

                        @if(auth()->user() && $user->id == auth()->user()->id)
                            <button class="btn primary" data-bs-toggle="modal" data-bs-target="#editSkillsModal">Edit</button>
                        @endif
                    </div>
                    <div class="profile-page-about-skills-content">
                        <?php
                        if($user->skills) {
                            // Turn string with comma seperated values into array
                            $skills = explode(',', $user->skills);

                            foreach($skills as $skill) {
                                ?>
                                <div class="profile-page-about-skills-content-item">
                                    <p><?php echo ucwords($skill); ?></p>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="no_skills">No skills added</p>';
                        }
                        ?>
                    </div>
                </div>

                <!-- Experience -->
                <div class="profile-page-about-experience">
                    <div class="profile-page-about-experience-header">
                        <h2>Experience</h2>
                        @if(auth()->user() && $user->id == auth()->user()->id)
                            <button class="btn primary" data-bs-toggle="modal" data-bs-target="#addExperienceModal">Add Experience</button>
                        @endif
                    </div>
                    <div class="profile-page-about-experience-content">
                        <?php
                        if($user->experiences) {
                            foreach($user->experiences as $experience) {
                                ?>
                                <div class="profile-page-about-experience-content-item">
                                    <h3><?php echo $experience->title; ?></h3>
                                    <p><?php echo $experience->company; ?> &middot; <?php echo ucwords($experience->employment_type); ?></p>
                                    <p><?php echo $experience->start_date; ?> - <?php if($experience->is_current_job){ ?> Current <?php } else { echo $experience->end_date; } ?></p>
                                    <p><?php echo $experience->description; ?></p>
                                    <div class="experience-actions">
                                        <?php
                                        if(auth()->user() && $user->id == auth()->user()->id) {
                                            ?>
                                            <button class="btn skinny primary" data-bs-toggle="modal" data-bs-target="#editExperienceModal">Edit</button>
                                            <button class="btn skinny primary" data-bs-toggle="modal" data-bs-target="#deleteExperienceModal">Delete</button>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo '<p class="no_experience">No experience added</p>';
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 profile-empty-space"></div>
        </div>
    </div>

    <?php if(auth()->user() && $user->id == auth()->user()->id) { ?>
        <!-- Edit Cover Letter Modal -->
        <div class="modal" id="editCoverLetterModal" tabindex="-1" aria-labelledby="editCoverLetterModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Edit Cover Letter</h2>
                        <button class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-resume-form" action="{{ route('profile.about.cover_letter.post', $user->username) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="resume">Cover Letter</label>
                                    <textarea name="cover_letter" id="cover_letter" autocomplete="false" rows="10">{{ $user->cover_letter }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Skills Modal -->
        <div class="modal" id="editSkillsModal" tabindex="-1" aria-labelledby="editSkillsModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Edit Cover Letter</h2>
                        <button class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-resume-form" action="{{ route('profile.about.skills.post', $user->username) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="resume">Skills</label>
                                    <p>Enter your skills seperated by a comma</p>
                                    <input type="text" name="skills" id="skills" autocomplete="false" value="{{ $user->skills }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Experience Modal -->
        <div class="modal" id="addExperienceModal" tabindex="-1" aria-labelledby="addExperienceModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Add Experience</h2>
                        <button class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add-experience-form" action="{{ route('profile.about.add_experience.post', $user->username) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="title">Title</label>
                                    <input type="text" name="title" id="title" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" id="company" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="employment_type">Employment Type</label>
                                    <select name="employment_type" id="employment_type">
                                        <option value="full-time">Full Time</option>
                                        <option value="part-time">Part Time</option>
                                        <option value="remote">Remote</option>
                                        <option value="contract">Contract</option>
                                        <option value="internship">Internship</option>
                                        <option value="freelance">Freelance</option>
                                        <option value="temporary">Temporary</option>
                                    </select>
                                </div>
                                <div class="form-input">
                                    <label for="start_date">Start Date</label>
                                    <input type="date" name="start_date" id="start_date" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="end_date">End Date</label>
                                    <input type="date" name="end_date" id="end_date" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" autocomplete="false" rows="10"></textarea>
                                </div>
                                <div class="form-input">
                                    <label for="is_current_job">Is this your current job?</label>
                                    <select name="is_current_job" id="is_current_job">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
@endsection