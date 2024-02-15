@php($title = "Job Matching | Dashboard")
@extends('layouts.authorized')

@section('content')
    <div class="dashboard-page page">
        <div class="dashboard-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Dashboard</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>Match with jobs, and make new connections</h2>
                </div>
            </div>
        </div>
        <div class="dashboard-page-inline-navigation">
            <div class="container">
                <div class="dashboard-page-inline-navigation-inner">
                    <ul>
                        <li class="active"><a href="{{ route('dashboard.jobs') }}">Job Matching</a></li>
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
                                    <p>Filter jobs by title, type, location, and category</p>
                                </div>
                                <div class="dashboard-content-filters-form">
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
                                                    <option value="on-site" {{ request()->location_type == 'on-site' ? 'selected' : '' }}>On Site</option>
                                                    <option value="hybrid" {{ request()->location_type == 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-input">
                                                <label for="job_category">Job Category</label>
                                                <select name="job_category" id="job_category">
                                                    <option value="">Select job category</option>
                                                    <?php
                                                        $categories = ["accounting","administrative","advertising","banking","business","community","construction","customer-service","design","education","engineering","finance","healthcare","hospitality","human-resources","information-technology","legal","management","manufacturing","marketing","media","non-profit","real-estate","retail","sales","science","security","skilled-labor","transportation","other"];

                                                        foreach($categories as $category) {
                                                            echo "<option value='$category' " . (request()->job_category == $category ? 'selected' : '') . ">" . ucwords($category) . "</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn primary">Filter</button>
                                        </div>
                                    </form>
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