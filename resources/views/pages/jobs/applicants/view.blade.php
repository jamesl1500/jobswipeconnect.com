@php($title = $job->title . " | Job")
@extends('layouts.both')

@section('content')
<div class="jobs-page page">
    <!-- Header -->
    @include('pages.jobs.includes.slim_header')

    <div class="jobs-page-inline-navigation">
        <div class="container">
            <div class="profile-page-inline-navigation-inner">
                <ul>
                    <li><a href="{{ route('jobs.show', $job->id) }}">Job Information</a></li>
                    <?php if(auth()->user() and auth()->user()->role == 'job-poster' and auth()->user()->id == $job->user_id) { ?>
                        <li class="active"><a href="{{ route('jobs.show.applicants', $job->id) }}">Applicants</a></li>
                        <li><a href="{{ route('jobs.edit', $job->id) }}">Edit Job</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

    <div class="jobs-page-content page-content">
        <div class="jobs-page-content-inner row">
            <div class="col-lg-3 jobs-applicant-left">
                <!-- Applicant page navigation -->
                <div class="jobs-page-applicants-navigation">
                    <div class="jobs-page-applicants-navigation-header">
                        <h2>Navigation</h2>
                    </div>
                    <div class="jobs-page-applicants-navigation-inner">
                        <ul>
                            <li><a href="{{ route('jobs.show.applicants', $job->id) }}">Applicants</a></li>
                            <li><a href="{{ route('jobs.show.applicants.interviewing', $job->id) }}">Interviewing</a></li>
                            <li><a href="{{ route('jobs.show.applicants.hires', $job->id) }}">Hires</a></li>
                            <li><a href="{{ route('jobs.show.applicants.rejected', $job->id) }}">Rejected</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 jobs-page-applicants-content-middle">
                <div class="jobs-page-content-header">
                    <h1>View Applicant</h1>
                    <h2>View an applicants profile and application!</h2>
                </div>
                <div class="jobs-page-applicant-actions">
                    <?php
                    $resume = json_decode($applicant->resume);
                    ?>
                    <a href="{{ asset('storage\/' . $resume->path) }}" class="btn primary">View Resume</a>
                    <button class="btn primary" data-bs-toggle="modal" data-bs-target="#interview-modal-{{ $applicant->id }}">Interview</button>
                </div>
                <div class="applicant-modals">
                    <!-- Interview Modal: Make it where i can send a message/email to applicant -->
                    <div class="modal fade" id="interview-modal-{{ $applicant->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5">Start Interview Process</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="{{ route('jobs.applicants.startInterview', array('job' => $applicant->job_id, 'applicant' => $applicant->id)) }}" method="POST">
                                <div class="modal-body">
                                    <p>Would you like to start the interview process with {{ $user->name }}?</p>

                                    @csrf
                                    <div class="form-group">
                                        <div class="form-input">
                                            <label for="message">Message to applicant</label>
                                            <textarea name="message" id="message" class="form-control" required></textarea>
                                        </div>

                                        <div class="form-input">
                                            <label for="date">Interview Date</label>
                                            <input type="date" name="date" id="date" class="form-control" required />
                                        </div>

                                        <div class="form-input">
                                            <label for="time">Interview Time</label>
                                            <input type="time" name="time" id="time" class="form-control" required />
                                        </div>

                                        <div class="form-input">
                                            <label for="location">Interview Location</label>
                                            <p>Zoom link or physical location</p>
                                            <input type="text" name="location" id="location" class="form-control" required />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Start Interview Process</button>
                                </div>
                                </form>
                            </div>
                          </div>
                    </div>
                </div>
                <div class="jobs-page-content-box">
                    <div class="jobs-page-content-box-inner">
                        <div class="jobs-page-content-box-body"><hr />
                            <div class="jobs-page-content-box-body-cover-letter">
                                <h3>Cover Letter</h3>
                                <p>{{ $applicant->cover_letter }}</p>
                            </div>
                            <div class="jobs-page-content-box-body-experience">
                                <h3>Experience</h3>
                                <?php
                                if(count($user->experiences) > 0) {
                                    foreach($user->experiences as $experience) {
                                        ?>
                                        <div class="profile-page-about-experience-content-item" id="expid-<?php echo $experience->id; ?>" >
                                            <h3 id="exp_title_{{ $experience->id }}"><?php echo $experience->title; ?></h3>
                                            <p id="exp_subtext_{{ $experience->id }}"><?php echo $experience->company; ?> &middot; <?php echo ucwords($experience->employment_type); ?></p>
                                            <p id="exp_dates_{{ $experience->id }}" class="dates"><?php echo $experience->start_date; ?> - <?php if($experience->is_current_job){ ?> Current <?php } else { echo $experience->end_date; } ?></p>
                                            <p id="exp_description_{{ $experience->id }}"><?php echo $experience->description; ?></p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo '<p class="no_experience">'.$user->name.' hasnt added any experience</p>';
                                }
                                ?>
                            </div>

                            <div class="jobs-page-content-box-body-education">
                                <h3>Education</h3>
                                <?php
                                if(count($user->educations) > 0) {
                                    foreach($user->educations as $education) {
                                        ?>
                                        <div class="profile-page-about-education-content-item" id="exp-<?php echo $education->id; ?>">
                                            <h3><?php echo $education->school; ?></h3>
                                            <p><b><?php echo $education->degree; ?></b></p>
                                            <p><?php echo $education->field_of_study; ?> &middot; <?php echo ucwords($education->education_level); ?></p>
                                            <p class="dates"><?php echo $education->start_date; ?> - <?php if($education->is_current_education){ ?> Current <?php } else { echo $education->end_date; } ?></p>
                                            <p><?php echo $education->description; ?></p>
                                        </div>
                                        <?php
                                    }
                                } else {
                                    echo '<p class="no_education">'.$user->name.' hasnt added any education</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 jobs-applicant-profile">
                <div class="jobs-page-applicant-profile">
                    <div class="jobs-page-applicant-profile-header">
                        <h2>Applicant Profile</h2>
                    </div>
                    <div class="jobs-page-applicant-profile-inner">
                        <div class="applicant-image">
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" />
                        </div>
                        <div class="applicant-inner">
                            <div class="applicant-inner-header">
                                <h3>{{ $user->name }}</h3>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="applicant-inner-content">
                                <p>{{ $user->cover_letter }}</p>
                            </div><hr />
                            <p class="card-text"><strong>Applied:</strong> {{ $applicant->created_at->diffForHumans() }}</p>
                            <p class="card-text"><strong>Status:</strong> {{ ucwords($applicant->status) }}</p>
                            <div class="applicant-inner-footer">
                                <a href="{{ route('profile.index', $user->id) }}" class="btn btn-primary">View Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection