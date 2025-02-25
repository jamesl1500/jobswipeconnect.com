@php($title = 'My Application')
@extends('layouts.authorized')

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
                        <li><a href="{{ route('jobs.show.applicants', $job->id) }}">Applicants</a></li>
                        <li><a href="{{ route('jobs.edit', $job->id) }}">Edit Job</a></li>
                    <?php } ?>

                    <?php if(auth()->user()) { ?>
                        <!-- If user is job-seeker -->
                        <?php if($job->applicants->contains('user_id', Auth::user()->id)){ ?>
                            <li class="active"><a href="{{ route('jobs.my_application', $job->id) }}">My Application</a></li>
                        <?php } else { ?>
                            <li><a href="{{ route('jobs.apply', $job->id) }}">Apply</a></li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="jobs-page-content apply">
            <div class="jobs-page-content-inner">
                <div class="jobs-page-content-title">
                    <h2>My Application</h2>
                </div>
                <div class="jobs-page-content-body">
                    <p class="card-text"><strong>Applied On:</strong> {{ $application->created_at->diffForHumans() }}</p>
                    <p class="card-text"><strong>Status:</strong> {{ ucwords($application->status) }}</p>
                    <?php
                        $resume = json_decode($application->resume);
                    ?>
                    <p><strong>Resume:</strong></p>
                    <div class="resume-box">
                        <div class="resume-box-left">
                            <p class="ext">{{ $resume->extension }}</p>
                        </div>
                        <div class="resume-box-right">
                            <p class="name">{{ $resume->name }}</p>
                            <!-- Show date uploaded in human readable form -->
                            <p class="date">Uploaded: {{ \Carbon\Carbon::parse($resume->date)->diffForHumans() }}</p>
                        </div>
                    </div>
                    <p class="card-text"><strong>Cover Letter:</strong> {!! $application->cover_letter !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection