@php($title = "Search")
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
                        <li class="active"><a href="{{ route('search.index') }}?query={{ $query }}">All</a></li>
                        <li><a href="{{ route('search.jobs') }}?query={{ $query }}">Jobs</a></li>
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
                                    ?>
                                    <div class="job-box" onClick="window.location.assign('{{ route('jobs.show', $job['id']) }}');">
                                        <div class="job-details">
                                            <div class="job-logo">
                                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}">
                                            </div>
                                            <div class="job-details-title">
                                                <h2>{{ $job['title'] }}
                                                    @if($job['employment_location_type'] == "remote")
                                                        <span class="badge badge-primary">Remote</span>
                                                    @endif
                                                </h2>
                                                <p>{{ ucwords($company->name) }} &middot; {{ ucwords($job['employment_location_type']) }}</p>
                                                <div class="job-location">
                                                    <p>{{ ucwords($job['location']) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="jobs-search-main-footer">
                                        <a href="{{ route('search.jobs') }}?query={{ $query }}" class="btn primary">View All Jobs</a>
                                    </div>
                                @else
                                    <p>No jobs found</p>
                                @endif
                            @else
                                <p>Search for jobs to see results</p>
                            @endif
                        </div>
                    </div>
                    <div class="side-area col-lg-4">
                        <!-- Filter: Experience Level -->
                        <div class="side-block">
                            <div class="side-block-header">
                                <h3>Experience Level</h3>
                            </div>
                            <div class="side-block-content">
                                <ul>
                                    <li><a href="{{ route('search.jobs') }}?query={{ $query }}&employment_location_type=remote">Remote</a></li>
                                    <li><a href="{{ route('search.jobs') }}?query={{ $query }}&employment_location_type=office">Office</a></li>
                                    <li><a href="{{ route('search.jobs') }}?query={{ $query }}&employment_location_type=hybrid">Hybrid</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection