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
            <div class="stat-strip">
                <div class="stat-chip"><strong>{{ number_format($totalJobsCount) }}</strong> <span>open roles</span></div>
                <div class="stat-chip"><strong>{{ number_format($totalCompaniesCount) }}</strong> <span>companies hiring</span></div>
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
                            <p>{{ $jobs->total() }} {{ Str::plural('job', $jobs->total()) }} found</p>
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
                                                <h3>{{ $job->title }}</h3>
                                                <p>{{ $company->name }}</p>
                                                <span class="badge badge-primary">{{ $job->employment_location_type == 'remote' ? 'Remote' : ucwords($job->employment_location_type) }}</span>
                                                <span class="badge">{{ ucwords(str_replace('-', ' ', $job->job_status)) }}</span>
                                            </div>
                                            <div class="job-inner-content">
                                                <p>{{ ucwords($job->experience_level) }} &middot; {{ ucwords($job->education_level) }} &middot; {{ ucwords($job->job_category) }}</p>
                                            </div>
                                            <div class="job-inner-meta">
                                                @if($job->salary)
                                                    <span class="job-inner-meta-salary">{{ $job->salary }}</span>
                                                @endif
                                                @if($job->created_at)
                                                    <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                                                @endif
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
                <div class="col-lg-3">
                    @auth
                        <div class="sidebar-widget">
                            <div class="sidebar-widget-header">
                                <h2>Quick links</h2>
                            </div>
                            <ul class="widget-links">
                                @if(auth()->user()->role == 'job-poster')
                                    <li><a href="{{ route('jobs.create') }}"><i class="fas fa-plus"></i> Post a job</a></li>
                                    <li><a href="{{ route('companies.my_companies') }}"><i class="fas fa-building"></i> My companies</a></li>
                                @else
                                    <li><a href="{{ route('companies.index') }}"><i class="fas fa-building"></i> Companies</a></li>
                                    <li><a href="{{ route('jobs.liked_jobs') }}"><i class="fas fa-heart"></i> Liked jobs</a></li>
                                @endif
                                <li><a href="{{ route('dashboard.jobs') }}"><i class="fas fa-bolt"></i> Job matching</a></li>
                            </ul>
                        </div>
                    @endauth

                    <div class="sidebar-widget">
                        <div class="sidebar-widget-header">
                            <h2>Popular categories</h2>
                            <p>Browse jobs by category</p>
                        </div>
                        <div class="widget-categories">
                            @foreach($popularCategories as $category)
                                <a href="{{ route('jobs.index', ['job_category' => $category->job_category]) }}">
                                    {{ ucwords($category->job_category) }} <span class="count">{{ $category->jobs_count }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection