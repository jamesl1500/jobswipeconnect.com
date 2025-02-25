@php($title = "Create Job")
@extends('layouts.authorized')

@section('content')
    <div class="jobs-page page">
        <div class="jobs-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>My Jobs</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>View all of the jobs you've created!</h2>
                </div>
            </div>
        </div>
        <div class="jobs-page-inline-navigation">
            <div class="container">
                <div class="jobs-page-inline-navigation-inner">
                    <ul>
                        <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                        @if(auth()->user() and auth()->user()->role == 'job-seeker')
                            <li><a href="{{ route('dashboard.feed') }}">Applied Jobs</a></li>
                        @else
                            <li><a href="{{ route('jobs.create') }}">Create Jobs</a></li>
                            <li class="active"><a href="{{ route('jobs.my_jobs') }}">My Jobs</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="container jobs-page-content page-content">
           <div class="row page-row">
                <div class="jobs-content col-lg-3">
                    <div class="jobs-content-inner">

                    </div>
                </div>
                <div class="jobs-content jobs-my_jobs-container col-lg-6">
                    <div class="jobs-content-inner">
                        <div class="jobs-content-form">
                            @if(count($jobs) > 0)
                                <?php
                                    foreach($jobs as $job)
                                    {
                                        // Get company info
                                        $company = App\Models\Companies::where('id', $job->company_id)->first();
                                        ?>
                                            <div class="job">
                                                <div class="job-image">
                                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" />
                                                </div>
                                                <div class="job-inner">
                                                    <div class="job-inner-header">
                                                        <h3>{{ $job->title }}
                                                            @if($job->employment_location_type == "remote")
                                                            <span class="badge badge-primary" style="position: relative;top: -1px;">Remote</span>
                                                        @endif
                                                        </h3>
                                                        <p>{{ $company->name }}</p>
                                                    </div>
                                                    <div class="job-inner-content">
                                                        <p>{{ ucwords($job->experience_level) }} | {{ ucwords($job->education_level) }} | {{ ucwords($job->job_status) }}</p>
                                                        <p>{{ ucwords($job->job_category) }}</p>
                                                    </div>
                                                    <div class="job-inner-footer">
                                                        <a href="{{ route('jobs.show', $job->id) }}" class="btn primary">View Job</a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                    }
                                ?>
                            @else
                                <div class="simple-alert warning">
                                    <div class="title">
                                        <h1>You haven't created any jobs yet!</h1>
                                    </div>
                                    <div class="subtitle">
                                        <h2>Click the button below to create your first job!</h2>
                                    </div>
                                    <div class="actions">
                                        <a href="{{ route('jobs.create') }}" class="btn btn-primary">Create Job</a>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="jobs-content col-lg-3">
                    <div class="jobs-content-inner">
                        
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection