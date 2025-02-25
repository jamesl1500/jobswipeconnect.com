@php($title = $job->title . ' | Apply for Job')
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
                            <li><a href="{{ route('jobs.my_application', $job->id) }}">My Application</a></li>
                        <?php } else { ?>
                            <li  class="active"><a href="{{ route('jobs.apply', $job->id) }}">Apply</a></li>
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
                    <h2>Apply to job</h2>
                </div>
                <div class="jobs-page-content-body">
                    <form action="{{ route('jobs.apply', $job->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Display current user's name and email -->
                        <div class="form-group">
                            <div class="form-input">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" required disabled>
                        
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" required disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <label for="resume">Current resume</label>
                                <?php
                                    $resume = json_decode(auth()->user()->resume);
                                ?>
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
                                <input type="hidden" name="resume" value="{{ auth()->user()->resume }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <label for="cover_letter">Cover Letter</label>
                                <textarea class="form-control" id="cover_letter" name="cover_letter" rows="3" required>
                                    {{ auth()->user()->cover_letter }}
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-input">
                                <label for="skills">Skills</label>
                                <input type="text" class="form-control" id="skills" name="skills" value="{{ auth()->user()->skills }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection