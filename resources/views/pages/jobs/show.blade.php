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
                    <li class="active"><a href="{{ route('jobs.show', $job->id) }}">Job Information</a></li>
                    <?php if(auth()->user() and auth()->user()->role == 'job-poster' and auth()->user()->id == $job->user_id) { ?>
                        <li><a href="{{ route('jobs.show.applicants', $job->id) }}">Applicants</a></li>
                        <li><a href="{{ route('jobs.edit', $job->id) }}">Edit Job</a></li>
                    <?php } ?>

                    <?php if(auth()->user()) { ?>
                        <!-- If user is job-seeker -->
                        <?php if($job->applicants->contains('user_id', Auth::user()->id)){ ?>
                            <li><a href="{{ route('jobs.my_application', $job->id) }}">My Application</a></li>
                        <?php } else { ?>
                            <?php if(auth()->user() and auth()->user()->role != 'job-poster' and auth()->user()->id != $job->user_id) { ?>
                                <li><a href="{{ route('jobs.apply', $job->id) }}">Apply</a></li>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
            </div>
        </div>
    </div>
    <!-- Create a new section for the job information -->
    <div class="container">
        <div class="jobs-page-content">
            <div class="jobs-page-content-inner">
                <div class="jobs-page-content-title">
                    <h2>Job Information</h2>
                </div>
                <div class="jobs-page-content-body">
                    <div class="jobs-page-content-body-inner row">
                        <div class="jobs-page-content-body-left col-lg-8">
                            <div class="jobs-page-content-body-left-inner">
                                <div class="jobs-page-content-body-left-title">
                                    <h3>Job Description</h3>
                                </div>
                                <div class="jobs-page-content-body-left-description">
                                    <!-- Display markup content -->
                                    {!! $job->description !!}
                                </div>
                            </div>
                            <div class="jobs-page-content-body-left-inner">
                                <div class="jobs-page-content-body-left-title">
                                    <h3>Responsibilities</h3>
                                </div>
                                <div class="jobs-page-content-body-left-description">
                                    <!-- Display markup content -->
                                    {!! $job->responsibilities !!}
                                </div>
                            </div>
                        </div>
                        <div class="jobs-page-content-body-right col-lg-4">
                            <div class="jobs-page-content-body-right-inner">
                                <div class="jobs-page-content-body-right-title">
                                    <h3>Job Details</h3>
                                </div>
                                <div class="jobs-page-content-body-right-details">
                                    <div class="jobs-page-content-body-right-details-inner">
                                        <div class="jobs-page-content-body-right-details-item">
                                            <h4>Location</h4>
                                            <p>{{ $job->location }}</p>
                                        </div>
                                        <div class="jobs-page-content-body-right-details-item">
                                            <h4>Employment Location Type</h4>
                                            <p>{{ ucwords($job->employment_location_type) }}</p>
                                        </div>
                                        <div class="jobs-page-content-body-right-details-item">
                                            <h4>Salary</h4>
                                            <p>{{ $job->salary }} / {{ ucwords($job->job_salary_type) }}</p>
                                        </div>
                                        <div class="jobs-page-content-body-right-details-item">
                                            <h4>Posted</h4>
                                            <p>{{ $job->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="jobs-page-content-body-right-inner">
                                <div class="jobs-page-content-body-right-title">
                                    <h3>Job Statistics</h3>
                                </div>
                                <div class="jobs-page-content-body-right-details">
                                    <div class="jobs-page-content-body-right-details-inner">
                                        <div class="jobs-page-content-body-right-details-item">
                                            <h4>Applicants</h4>
                                            <p>{{ $job->applicants->count() }}</p>
                                        </div> 

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection