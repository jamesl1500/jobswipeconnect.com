@php($title = $job->title . " | Job")
@extends('layouts.both')

@section('content')
<div class="jobs-page page">
    <!-- Header -->
    @include('pages.jobs.includes.header')

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
                            <li class="active"><a href="{{ route('jobs.show.applicants', $job->id) }}">Applicants</a></li>
                            <li><a href="{{ route('jobs.show.applicants.interviewing', $job->id) }}">Interviewing</a></li>
                            <li><a href="{{ route('jobs.show.applicants.hires', $job->id) }}">Hires</a></li>
                            <li><a href="{{ route('jobs.show.applicants.rejected', $job->id) }}">Rejected</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 jobs-page-applicants-content-middle">
                <div class="jobs-page-content-header">
                    <h1>Applicants</h1>
                    <h2>View all of the applicants for this job!</h2>
                </div>
                <div class="jobs-page-content-box">
                    @if(count($applicants) > 0)
                        <?php
                            foreach($applicants as $applicant)
                            {
                                // Get user info
                                $user = App\Models\User::where('id', $applicant->user_id)->first();
                                ?>
                                    <div class="applicant" onClick="window.location.assign(<?php echo route('profile.index', $applicant->user_id); ?>);">
                                        <div class="applicant-image">
                                            <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" />
                                        </div>
                                        <div class="applicant-inner">
                                            <div class="applicant-inner-header">
                                                <h3>{{ $user->name }}</h3>
                                                <p>{{ $user->email }}</p>
                                            </div>
                                            <div class="applicant-inner-body">
                                                <p>{!! $applicant->cover_letter !!}</p>
                                            </div>
                                            <div class="applicant-inner-footer">
                                                <?php
                                                $resume = json_decode($applicant->resume);
                                                ?>
                                                <a href="{{ asset('storage\/' . $resume->path) }}" class="btn primary">View Resume</a>
                                                <button class="btn primary" data-bs-toggle="modal" data-bs-target="#interview-modal-{{ $applicant->id }}">Interview</button>
                                                <button class="btn primary">Hire</button>
                                                <button class="btn primary">Reject</button>
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
                                        </div>
                                    </div>
                                <?php
                            }
                        ?>

                        <!-- Pagination -->
                        <div class="jobs-applicants-main-footer">
                            {{ $applicants->withQueryString()->links() }}
                        </div>
                    @else
                        <div class="no-applicants">
                            <h3>No applicants found!</h3>
                            <p>There are currently no applicants for this job!</p>
                        </div>
                    @endif
                </div>
            </div>
            <div class="col-lg-3 jobs-empty-space"></div>
        </div>
    </div>
@endsection