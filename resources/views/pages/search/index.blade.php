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
                            <p style="margin-bottom: 0px;">Find your dream job!</p>
                        </div>
                        <div class="jobs-search-main-results">
                            @if($query != "")
                                @if(count($jobs) > 0)
                                    @foreach($jobs[0] as $job)
                                    <?php
                                        // Get Company info
                                        $company = \App\Models\Companies::where('id', $job['company_id'])->first();

                                        // Get the jobs posted date
                                        $job_posted_date = \Carbon\Carbon::parse($job['created_at'])->diffForHumans();
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
                                                    <span class="date" style="float: right;">{{ $job_posted_date }}</span>
                                                </h2>
                                                <p>{{ ucwords($company->name) }} &middot; {{ ucwords($job['employment_location_type']) }}</p>
                                                <div class="job-location">
                                                    <p>{{ ucwords($job['location']) }}</p>
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
                                                @else
                                                    <div class="job-actions" style="padding-top: 10px;">
                                                        <a href="{{ route('jobs.show', $job['id']) }}" class="btn skinny primary">View</a>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                                    <div class="jobs-search-main-footer" style="padding: 20px;">
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
                        <div class="side-block companies-search-main">
                            <div class="side-block-header companies-search-main-header">
                                <h2>Companies</h2>
                                <p>Find the company of your dreams!</p>
                            </div>
                            <div class="side-block-content companies-search-main-results">
                                @if($query != "")
                                    @if(count($companies) > 0)
                                        @foreach($companies as $company)
                                            <div class="company-box" onClick="window.location.assign('{{ route('companies.show', $company->id) }}');">
                                                <div class="company-logo">
                                                    <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}">
                                                </div>
                                                <div class="company-details">
                                                    <div class="company-name">
                                                        <h2>{{ $company->name }}</h2>
                                                        <p>{{ ucwords($company->industry) }} &middot; {{ ucwords($company->schedule_type) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="side-block-footer">
                                            <a href="{{ route('companies.index') }}" class="btn primary">View All Companies</a>
                                        </div>
                                    @else
                                        <p>No companies found</p>
                                    @endif
                                @else
                                    <p>Search for companies to see results</p>
                                @endif
                            </div>
                        </div>
                        <div class="side-block users-search-main">
                            <div class="side-block-header users-search-main-header">
                                <h2>Users</h2>
                                <p>Find users to add to your network!</p>
                            </div>
                            <div class="side-block-content users-search-main-results">
                                @if($query != "")
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <div class="user-box" onClick="window.location.assign('{{ route('profile.index', $user->username) }}');">
                                                <div class="user-logo">
                                                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}">
                                                </div>
                                                <div class="user-details">
                                                    <div class="user-name">
                                                        <h2>{{ $user->name }}</h2>
                                                        <p>{{ ucwords($user->username) }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="side-block-footer">
                                            <a href="{{ route('search.users') }}" class="btn primary">View All Users</a>
                                        </div>
                                    @else
                                        <p>No users found</p>
                                    @endif
                                @else
                                    <p>Search for users to see results</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection