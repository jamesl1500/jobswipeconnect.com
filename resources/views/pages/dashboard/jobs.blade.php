@php($title = "Job Matching | Dashboard")
@extends('layouts.authorized')

@section('content')
    @php($role = auth()->user()->role)
    <div class="dashboard-page page">
        <div class="dashboard-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Dashboard</h1>
                </div>
                <div class="page-header-subtext">
                    @if($role == "job-seeker")
                    <h2>Match with jobs, and make new connections</h2>
                    @else
                    <h2>Match with applicants, and make new connections</h2>
                    @endif
                </div>
            </div>
        </div>
        <div class="dashboard-page-inline-navigation">
            <div class="container">
                <div class="dashboard-page-inline-navigation-inner">
                    <ul>
                        @if($role == "job-seeker")
                            <li class="active"><a href="{{ route('dashboard.jobs') }}">Job Matching</a></li>
                        @else
                            <li class="active"><a href="{{ route('dashboard.jobs') }}">Applicant Matching</a></li>
                        @endif

                        <li><a href="{{ route('dashboard.feed') }}">Feed</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container dashboard-page-content page-content">
           <div class="row page-row">
                <div class="dashboard-content left-filter col-lg-3">
                    <div class="dashboard-content-inner">
                        <!-- Filters -->
                        <div class="dashboard-content-filters">
                            <div class="dashboard-content-filters-inner">
                                <div class="dashboard-content-filters-header">
                                    <h2>Filters</h2>
                                    @if($role == "job-seeker")
                                        <p>Filter jobs by title, type, location, and category</p>
                                    @else
                                        <p>Filter applicants by education, skills, and experience</p>
                                    @endif
                                </div>
                                <div class="dashboard-content-filters-form">
                                    @if($role == "job-seeker")
                                        <form action="{{ route('dashboard.jobs') }}" method="get">
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="job_title">Job Title</label>
                                                    <input type="text" name="job_title" id="job_title" value="{{ request()->job_title }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="job_type">Job Type</label>
                                                    <select name="job_type" id="job_type">
                                                        <option value="">Select job type</option>
                                                        <option value="full-time" {{ request()->job_type == 'full-time' ? 'selected' : '' }}>Full Time</option>
                                                        <option value="part-time" {{ request()->job_type == 'part-time' ? 'selected' : '' }}>Part Time</option>
                                                        <option value="contract" {{ request()->job_type == 'contract' ? 'selected' : '' }}>Contract</option>
                                                        <option value="temporary" {{ request()->job_type == 'temporary' ? 'selected' : '' }}>Temporary</option>
                                                        <option value="internship" {{ request()->job_type == 'internship' ? 'selected' : '' }}>Internship</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="job_location">Job Location</label>
                                                    <input type="text" name="job_location" id="job_location" value="{{ request()->job_location }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="location_type">Location Type</label>
                                                    <select name="location_type" id="location_type">
                                                        <option value="">Select location type</option>
                                                        <option value="remote" {{ request()->location_type == 'remote' ? 'selected' : '' }}>Remote</option>
                                                        <option value="On Site" {{ request()->location_type == 'On Site' ? 'selected' : '' }}>On Site</option>
                                                        <option value="hybrid" {{ request()->location_type == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="job_category">Job Category</label>
                                                    <select name="job_category" id="job_category">
                                                        <option value="">Select job category</option>
                                                        @php($categories = ["accounting","administrative","advertising","banking","business","community","construction","customer-service","design","education","engineering","finance","healthcare","hospitality","human-resources","information-technology","legal","management","manufacturing","marketing","media","non-profit","real-estate","retail","sales","science","security","skilled-labor","transportation","other"])
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category }}" {{ request()->job_category == $category ? 'selected' : '' }}>{{ ucwords($category) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn primary">Filter</button>
                                            </div>
                                        </form>
                                    @else
                                        <form action="{{ route('dashboard.jobs') }}" method="get">
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="education">Education</label>
                                                    <select name="education" id="education">
                                                        <option value="">Select education</option>
                                                        <option value="high-school" {{ request()->education == 'high-school' ? 'selected' : '' }}>High School</option>
                                                        <option value="associate" {{ request()->education == 'associate' ? 'selected' : '' }}>Associate's Degree</option>
                                                        <option value="bachelor" {{ request()->education == 'bachelor' ? 'selected' : '' }}>Bachelor's Degree</option>
                                                        <option value="master" {{ request()->education == 'master' ? 'selected' : '' }}>Master's Degree</option>
                                                        <option value="doctorate" {{ request()->education == 'doctorate' ? 'selected' : '' }}>Doctorate (PhD)</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="skills">Skills</label>
                                                    <input type="text" name="skills" id="skills" value="{{ request()->skills }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-input">
                                                    <label for="experience">Experience</label>
                                                    <input type="text" name="experience" id="experience" value="{{ request()->experience }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn primary">Filter</button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboard-content posts-container col-lg-6">
                    <div class="dashboard-content-inner">
                        @if(auth()->user()->role == "job-seeker")
                            @include('pages.dashboard.matchmaker_types.job_seeker')
                        @else
                            @include('pages.dashboard.matchmaker_types.job_poster')
                        @endif
                    </div>
                </div>
                <div class="dashboard-content col-lg-3">
                    <div class="dashboard-content-inner">

                    </div>
                </div>
           </div>
        </div>
    </div>
</div>
@endsection