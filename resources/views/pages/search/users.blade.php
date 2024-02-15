@php($title = "Users | Search")
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
                        <li><a href="{{ route('search.jobs') }}?query={{ $query }}">Jobs</a></li>
                        <li><a href="{{ route('search.companies') }}?query={{ $query }}">Companies</a></li>
                        <li class="active"><a href="{{ route('search.users') }}?query={{ $query }}">Users</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="search-page-content container page-content">
            <div class="search-page-content-inner">
                <div class="search-page-primary-results row">
                    <div class="jobs-search-main col-lg-8">
                        <div class="jobs-search-main-header">
                            <h2>Users</h2>
                            <p style="margin-bottom: 0px;">Make a new connection!</p>
                        </div>
                        <div class="jobs-search-main-results">
                            @if($query != "")
                                @if(count($users) > 0)
                                    @foreach($users as $user)
                                        <div class="user-search-main-result">
                                            <div class="user-search-main-result-inner">
                                                <div class="user-search-main-result-left">
                                                    <div class="user-search-main-result-left-inner">
                                                        <div class="user-search-main-result-left-image">
                                                            <img src="{{ asset('storage/'. $user->profile_picture) }}" alt="{{ $user->name }}">
                                                        </div>
                                                        <div class="user-search-main-result-left-content">
                                                            <h3>{{ $user->name }}</h3>
                                                            <p class="username">{{ $user->username }}</p>
                                                            <div class="skills">
                                                                <p>{{ $user->skills }}</p>
                                                            </div>
                                                            <div class="actions">
                                                                <div class="actions-inner">
                                                                    <a href="{{ route('profile.index', ['username' => $user->username]) }}" class="btn primary">View Profile</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Use pagination -->
                                    <div class="jobs-search-main-footer">
                                        {{ $users->withQueryString()->links() }}
                                    </div>
                                @else
                                    <p style="padding: 20px;padding-bottom: 0px;">No users found</p>
                                @endif
                            @else
                                <p style="padding: 20px;padding-bottom: 0px;">Search for users to see results</p>
                            @endif
                        </div>
                    </div>
                    <div class="side-area col-lg-4">
                        <div class="side-block companies-search-main">
                            <div class="side-block-header companies-search-main-header">
                                <h2>Skills</h2>
                                <p>Find users by skills!</p>
                            </div>
                            <div class="side-block-content companies-search-main-results">
                                
                            </div>
                        </div>
                        <div class="side-block users-search-main">
                            <div class="side-block-header users-search-main-header">
                                <h2>Ads</h2>
                                <p>We gotta pay our bills!</p>
                            </div>
                            <div class="side-block-content users-search-main-results">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection