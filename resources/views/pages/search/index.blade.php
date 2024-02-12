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
        <div class="search-page-content container page-content">
            <div class="search-page-content-inner">
                <div class="primary-search">
                    <form action="{{ route('search.index') }}" method="get">
                        <input type="text" name="query" id="query" placeholder="Search for jobs, companies, and more">
                    </form>
                </div>
                <div class="search-page-primary-results row">
                    <div class="jobs-search-main col-lg-8">
                        <div class="jobs-search-main-header">
                            <h2>Jobs</h2>
                            <p>Find your dream job!</p>
                        </div>
                        <div class="jobs-search-main-results">
                            @if($query != "")
                            
                            @else
                                <p>Search for jobs to see results</p>
                            @endif
                        </div>
                    </div>
                    <div class="side-area col-lg-4">
                        <div class="companies-search-main">

                        </div>
                        <div class="users-search-main">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection