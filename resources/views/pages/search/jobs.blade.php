@php($title = "Jobs | Search")
@extends('layouts.both')

@section('content')
    <!-- Come up with a search page that searches for users, companies and jobs in that order -->
    <div class="search-page page">
        <div class="search-page-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Search</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>Search for jobs, companies, and more</h2>
                </div>
            </div>
        </div>
        <div class="search-page-inline-navigation">
            <div class="container">
                <div class="search-page-inline-navigation-inner">
                    <ul>
                        <li><a href="{{ route('search.index') }}?query={{ $query }}">All</a></li>
                        <li class="active"><a href="{{ route('search.jobs') }}?query={{ $query }}">Jobs</a></li>
                        <li><a href="{{ route('search.companies') }}?query={{ $query }}">Companies</a></li>
                        <li><a href="{{ route('search.users') }}?query={{ $query }}">Users</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="search-page-content container page-content">
            <div class="search-page-content-inner">
                <div class="search-page-primary-results row">
                    <div class="jobs-search-main col-lg-8">
                        <div class="jobs-search-main-header">
                            <h2>Jobs</h2>
                            <p>Find your dream job!</p>
                            <div class="search-jobs-filter-buttons">
                                <a href="{{ route('search.jobs') }}?query={{ $query }}&employment_location_type=remote" class="btn primary skinny <?php if(request()->get('employment_location_type') == 'remote'){ echo "filled"; }else{ echo "primary-hollow"; } ?>">Remote</a>
                                <a href="{{ route('search.jobs') }}?query={{ $query }}&employment_location_type=on-site" class="btn primary skinny <?php if(request()->get('employment_location_type') == 'on-site'){ echo "filled"; }else{ echo "primary-hollow"; } ?>">On-Site</a>
                                <a href="{{ route('search.jobs') }}?query={{ $query }}&employment_location_type=hybrid" class="btn primary skinny <?php if(request()->get('employment_location_type') == 'hybrid'){ echo "filled"; }else{ echo "primary-hollow"; } ?>">Hybrid</a>
                            </div>
                        </div>
                        <div class="jobs-search-main-results">
                            @if($query != "")
                                @if(count($jobs) > 0)
                                    @foreach($jobs as $job)
                                    <?php
                                    // Get Company info
                                    $company = \App\Models\Companies::where('id', $job['company_id'])->first();

                                    // Get the jobs posted date
                                    $job_posted_date = \Carbon\Carbon::parse($job['created_at'])->diffForHumans();
                                    ?>
                                    <div class="job-box">
                                        <div class="job-details">
                                            <div class="job-logo">
                                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}">
                                            </div>
                                            <div class="job-details-title">
                                                <h2>{{ $job['title'] }}
                                                    @if($job['employment_location_type'] == "remote")
                                                        <span class="badge badge-primary">Remote</span>
                                                    @endif
                                                    <span class="date" style="float: right;">{{ $job_posted_date }}</span>
                                                </h2>
                                                <p>{{ ucwords($company->name) }} &middot; {{ ucwords($job['employment_location_type']) }}</p>
                                                <div class="job-location">
                                                    <p>{{ ucwords($job['location']) }} </p>
                                                </div>
                                                @if(auth()->user() && auth()->user()->id == $job['user_id'])
                                                    <div class="job-actions" style="padding-top: 10px;">
                                                        <a href="{{ route('jobs.show', $job['id']) }}" class="btn skinny primary">View</a>
                                                        <a href="{{ route('jobs.edit', $job['id']) }}" class="btn skinny primary">Edit</a>
                                                    </div>
                                                @elseif(auth()->user())
                                                    <div class="job-actions" style="padding-top: 10px;">
                                                        <a href="{{ route('jobs.show', $job['id']) }}" class="btn skinny primary">View</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <!-- Use pagination -->
                                    <div class="jobs-search-main-footer">
                                        {{ $jobs->withQueryString()->links() }}
                                    </div>
                                @else
                                    <p style="padding: 20px;padding-bottom: 0px;">No jobs found</p>
                                @endif
                            @else
                                <p style="padding: 20px;padding-bottom: 0px;">Search for jobs to see results</p>
                            @endif
                        </div>
                    </div>
                    <div class="side-area col-lg-4">
                        <!-- Filter: Experience Level -->
                        <div class="side-block experience-block">
                            <div class="side-block-header">
                                <h3>Experience Level</h3>
                                <p>Find jobs by experience level</p>
                            </div>
                            <div class="side-block-content">
                                <ul class="filter-links">
                                    <li><a href="{{ route('search.jobs') }}?query={{ $query }}&experience_level=internship">Internship</a></li>
                                    <li><a href="{{ route('search.jobs') }}?query={{ $query }}&experience_level=entry-level">Entry Level</a></li>
                                    <li><a href="{{ route('search.jobs') }}?query={{ $query }}&experience_level=associate">Associate</a></li>
                                    <li><a href="{{ route('search.jobs') }}?query={{ $query }}&experience_level=mid-senior-level">Mid-Senior</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Filter: Job Category -->
                        <div class="side-block category-block">
                            <div class="side-block-header">
                                <h3>Job Categories</h3>
                                <p>Find jobs by category</p>
                            </div>
                            <div class="side-block-content">
                                <ul class="filter-links">
                                    <?php
                                    // Get all job categories
                                    $categories = ["accounting","administrative","advertising","banking","business","community","construction","customer-service","design","education","engineering","finance","healthcare","hospitality","human-resources","information-technology","legal","management","manufacturing","marketing","media","non-profit","real-estate","retail","sales","science","security","skilled-labor","transportation","other"];

                                    // Loop through the categories
                                    foreach ($categories as $category) {
                                        // If the category is in the URL, make it active
                                        if (request()->get('category') == $category) {
                                            echo '<li class="active"><a href="' . route('search.jobs') . '?query=' . $query . '&category=' . $category . '" class="active">' . ucwords($category) . '</a></li>';
                                        } else {
                                            echo '<li><a href="' . route('search.jobs') . '?query=' . $query . '&category=' . $category . '">' . ucwords($category) . '</a></li>';
                                        }
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>

                        <!-- Filter: Ads -->
                        <div class="side-block ads-block">
                            <div class="side-block-header">
                                <h3>Ads</h3>
                                <p>We gotta pay our bills!</p>
                            </div>
                            <div class="side-block-content">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection