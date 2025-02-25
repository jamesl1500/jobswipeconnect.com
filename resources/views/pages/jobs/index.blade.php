@php($title = "Jobs")
@extends('layouts.both')

@section('content')
<!-- Create a page for the jobs -->
<div class="jobs-page page">
    <div class="jobs-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Jobs</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Find your next job here!</h2>
            </div>
        </div>
    </div>
    <div class="jobs-page-inline-navigation">
        <div class="container">
            <div class="jobs-page-inline-navigation-inner">
                <ul>
                    <li class="active"><a href="{{ route('dashboard.jobs') }}">Jobs</a></li>
                    @if(auth()->user() and auth()->user()->role == 'job-seeker')
                        <li><a href="{{ route('dashboard.feed') }}">Applied Jobs</a></li>
                    @else
                        <li><a href="{{ route('jobs.create') }}">Create Jobs</a></li>
                        <li><a href="{{ route('jobs.my_jobs') }}">My Jobs</a></li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
    <div class="jobs-page-content">
        <div class="container jobs-page-content-container">
            <div class="jobs-page-content-inner-row row">
                <!-- Left filter -->
                <div class="jobs-page-content-left-filter col-lg-3">
                    <div class="jobs-content-filters-inner">
                        <div class="jobs-content-filters-header">
                            <h2>Filters</h2>
                            <p>Filter jobs by title, type, location, and category</p>
                        </div>
                        <div class="jobs-content-filters-form">
                            <form action="{{ route('jobs.index') }}" method="get">
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

                <!-- Jobs -->
                <div class="jobs-page-content-middle col-lg-6">
                    <div class="jobs-page-content-middle-inner">
                        <div class="jobs-page-content-middle-inner-header">
                            <h2>Jobs</h2>
                            <p>Here are the latest jobs</p>
                        </div>
                        <div class="jobs-page-content-middle-inner-jobs">
                            @if($jobs->count() > 0)
                                @foreach($jobs as $job)
                                    <?php
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
                                @endforeach
                            @else
                            <div class="simple-alert warning">
                                <div class="title">
                                    <h1>No Results Found</h1>
                                </div>
                                <div class="subtitle">
                                    <h2>Search something different or select different filters</h2>
                                </div>
                                <div class="actions">
                                    <a href="{{ route('jobs.index') }}" class="btn btn-primary">Refresh</a>
                                </div>
                            </div>
                            @endif

                            <!-- Pagination -->
                            <div class="jobs-search-main-footer">
                                {{ $jobs->withQueryString()->links() }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right links -->
                <div class="jobs-page-content-right-links col-lg-3">
                    @if(auth()->user())
                        <div class="jobs-page-content-right-links">
                            <div class="jobs-page-content-right-links-inner-header">
                                <h2>Links</h2>
                                <p>Links to other pages</p>
                            </div>
                            <div class="jobs-page-content-right-links-inner-links">
                                <ul>
                                    @if(auth()->user()->role == 'job-poster')
                                        <li><a href="{{ route('jobs.create') }}">Create Jobs</a></li>
                                        <li><a href="{{ route('companies.my_companies') }}">My Companies</a></li>
                                    @else
                                        <li><a href="{{ route('companies.index') }}">Companies</a></li>
                                        <li><a href="{{ route('jobs.liked_jobs') }}">Liked Jobs</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    @endif

                    <!-- Advertisements -->
                    <div class="jobs-page-content-right-links-advertisements">
                        <div class="jobs-page-content-right-links-advertisements-header">
                            <h2>Advertisements</h2>
                            <p>Advertisements go here</p>
                        </div>
                        <div class="jobs-page-content-right-links-advertisements-inner">
                            <p>Advertisements go here</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection