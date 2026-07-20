@php($title = "About " . $user->name . " | Profile")
@extends('layouts.both')

@section('content')
<div class="profile-page page">
    <!-- Header -->
    @include('pages.profile.includes.header')

    <!-- Navigation -->
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
                        @if($user->skills)
                            @foreach(explode(',', $user->skills) as $skill)
                                <div class="profile-page-about-skills-content-item">
                                    <p>{{ ucwords($skill) }}</p>
                                </div>
                            @endforeach
                        @else
                            <p class="no_skills">No skills added</p>
                        @endif
                    </div>
                </div>

                <!-- Experience -->
                <div class="profile-page-about-experience" id="experiences">
                    <div class="profile-page-about-experience-header">
                        <h2>Experience</h2>
                        @if(auth()->user() && $user->id == auth()->user()->id)
                            <button class="btn primary" data-bs-toggle="modal" data-bs-target="#addExperienceModal">Add Experience</button>
                        @endif
                    </div>
                    <div class="profile-page-about-experience-content {{ auth()->user() && auth()->user()->id == $user->id ? 'sortable' : '' }}" data-action="{{ route('profile.about.updateExperienceOrder.post', ['username' => $user->username]) }}">
                        @if(count($user->experiences) > 0)
                            @foreach($user->experiences as $experience)
                                <div class="profile-page-about-experience-content-item" id="expid-{{ $experience->id }}" data-id="{{ $experience->id }}" data-position="{{ $experience->position }}" draggable="true" >
                                    <h3 id="exp_title_{{ $experience->id }}">{!! $experience->title !!}</h3>
                                    <p id="exp_subtext_{{ $experience->id }}">{!! $experience->company !!} &middot; {{ ucwords($experience->employment_type) }}</p>
                                    <p id="exp_dates_{{ $experience->id }}" class="dates">{!! $experience->start_date !!} - @if($experience->is_current_job) Current @else {{ $experience->end_date }} @endif</p>
                                    <p id="exp_description_{{ $experience->id }}">{!! $experience->description !!}</p>
                                    <div class="experience-actions">
                                        @if(auth()->user() && $user->id == auth()->user()->id)
                                            <button class="btn skinny primary edit-experience" data-expid="{{ $experience->id }}" data-action="{{ route('profile.about.get_experience.post', $user->username) }}" data-bs-toggle="modal" data-bs-target="#editExperienceModal">Edit</button>
                                            <button class="btn skinny primary delete-experience" data-expid="{{ $experience->id }}" data-action="{{ route('profile.about.delete_experience.post', $user->username) }}">Delete</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no_experience">{{ $user->name }} hasnt added any experience</p>
                        @endif
                    </div>
                </div>

                <!-- Education -->
                <div class="profile-page-about-education">
                    <div class="profile-page-about-education-header">
                        <h2>Education</h2>
                        @if(auth()->user() && $user->id == auth()->user()->id)
                            <button class="btn primary" data-bs-toggle="modal" data-bs-target="#addEducationModal">Add Education</button>
                        @endif
                    </div>
                    <div class="profile-page-about-education-content">
                        @if(count($user->educations) > 0)
                            @foreach($user->educations as $education)
                                <div class="profile-page-about-education-content-item" id="exp-{{ $education->id }}">
                                    <h3>{!! $education->school !!}</h3>
                                    <p><b>{!! $education->degree !!}</b></p>
                                    <p>{!! $education->field_of_study !!} &middot; {{ ucwords($education->education_level) }}</p>
                                    <p class="dates">{!! $education->start_date !!} - @if($education->is_current_education) Current @else {{ $education->end_date }} @endif</p>
                                    <p>{!! $education->description !!}</p>
                                    <div class="education-actions">
                                        @if(auth()->user() && $user->id == auth()->user()->id)
                                            <button class="btn skinny primary" data-bs-toggle="modal" data-bs-target="#editEducationModal">Edit</button>
                                            <button class="btn skinny primary delete-education" data-eduid="{{ $education->id }}" data-action="{{ route('profile.about.delete_education.post', $user->username) }}">Delete</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="no_education">{{ $user->name }} hasnt added any education</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-2 profile-empty-space"></div>
        </div>
    </div>

    @if(auth()->user() && $user->id == auth()->user()->id)
        <!-- Edit Cover Letter Modal -->
        <div class="modal" id="editCoverLetterModal" tabindex="-1" aria-labelledby="editCoverLetterModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Edit Cover Letter</h2>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-cover-letter-form" action="{{ route('profile.about.cover_letter.post', $user->username) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="resume">Cover Letter</label>
                                    <textarea name="cover_letter" id="cover_letter" autocomplete="false" rows="10">{{ $user->cover_letter }}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn primary" value="Save" />
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
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-skills-form" action="{{ route('profile.about.skills.post', $user->username) }}" method="post" enctype="multipart/form-data">
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
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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

        <!-- Add Experience Modal -->
        <div class="modal" id="addEducationModal" tabindex="-1" aria-labelledby="addEducationModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Add Education</h2>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="add-education-form" action="{{ route('profile.about.add_education.post', $user->username) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="school">School</label>
                                    <input type="text" name="school" id="school" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="degree">Degree</label>
                                    <input type="text" name="degree" id="degree" autocomplete="false">  
                                </div>
                                <div class="form-input">
                                    <label for="field_of_study">Field of Study</label>
                                    <input type="text" name="field_of_study" id="field_of_study" autocomplete="false">
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
                                    <label for="is_current_education">Is this your current education?</label>
                                    <select name="is_current_education" id="is_current_education">
                                        <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                                <div class="form-input">
                                    <label for="education_level">Education Level</label>
                                    <select name="education_level" id="education_level">
                                        <option value="high_-school">High School</option>
                                        <option value="diploma">Diploma</option>
                                        <option value="certificate">Certificate</option>
                                        <option value="associate">Associates</option>
                                        <option value="bachelor">Bachelors</option>
                                        <option value="master">Masters</option>
                                        <option value="other">Other</option>
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

        <!-- Edit Experience Modal -->
        <div class="modal" id="editExperienceModal" tabindex="-1" aria-labelledby="editExperienceModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Edit Experience</h2>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="edit-experience-form" action="{{ route('profile.about.edit_experience.post', $user->username) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="exp_edit_id" name="edit_experience_id" value="">
                            <div class="form-group">
                                <div class="form-input">
                                    <label for="title">Title</label>
                                    <input id="exp_edit_title" type="text" name="exp_edit_title" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="company">Company</label>
                                    <input id="exp_edit_company" type="text" name="exp_edit_company" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="employment_type">Employment Type</label>
                                    <select id="exp_edit_employment_type" name="exp_edit_employment_type">
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
                                    <input id="exp_edit_start_date" type="date" name="exp_edit_start_date" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="end_date">End Date</label>
                                    <input id="exp_edit_end_date" type="date" name="exp_edit_end_date" autocomplete="false">
                                </div>
                                <div class="form-input">
                                    <label for="description">Description</label>
                                    <textarea id="exp_edit_description" name="exp_edit_description" autocomplete="false" rows="10"></textarea>
                                </div>
                                <div class="form-input">
                                    <label for="is_current_job">Is this your current job?</label>
                                    <select id="exp_edit_is_current_job" name="exp_edit_is_current_job">
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
    @endif
</div>
@endsection