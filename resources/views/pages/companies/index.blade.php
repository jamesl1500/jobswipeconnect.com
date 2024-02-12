@php($title = "Companies")
@extends('layouts.both')

@section('content')
    <div class="companies-page page">
        <div class="companies-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Companies</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>Find the company of your dreams!</h2>
                </div>
            </div>
        </div>
        <div class="container companies-page-content page-content">
           <div class="row page-row">
                <div class="companies-content col-lg-3">
                    <div class="companies-content-inner">
                        @if (Auth::check())
                            <div class="side-block companies-actions">
                                <div class="side-block-header">
                                    <h3>Actions</h3>
                                </div>
                                <div class="side-block-content actions">
                                    <a href="{{ route('companies.create') }}" class="btn primary">Create Company</a>
                                    <a href="{{ route('companies.my_companies') }}" class="btn secondary">My Companies</a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="companies-content posts-container col-lg-6">
                    <div class="companies-content-inner">
                        <div class="companies-content-filters">

                        </div>
                        <div class="companies-content-posts">

                            <div class="companies-content-posts-inner">
                                <?php
                                    // Get all companies
                                    $companies = \App\Models\Companies::all();
                                ?>
                                @foreach ($companies as $company)
                                    <div class="companies-content-post">
                                        <div class="companies-content-post-inner">
                                            <div class="companies-content-post-image">
                                                <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}">
                                            </div>
                                            <div class="companies-content-post-details">
                                                <div class="companies-content-post-title">
                                                    <h3>{{ $company->name }}</h3>
                                                    <p>{{ $company->industry }} &middot; {{ ucwords($company->schedule_type) }}</p>
                                                </div>
                                                <div class="companies-content-post-description">
                                                    <p>{{ $company->description }}</p>
                                                </div>
                                                <div class="companies-content-post-link">
                                                    <a href="{{ route('companies.show', $company->id) }}" class="btn primary">View</a>

                                                    @if (Auth::check())
                                                        @if (Auth::user()->id == $company->user_id)
                                                            <a href="{{ route('companies.edit', $company->id) }}" class="btn secondary">Edit</a>
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="companies-content col-lg-3">
                    <div class="companies-content-inner">
                        <div class="side-block">
                            <div class="side-block-header">
                                <h3>Remote Workplaces</h3>
                            </div>
                            <div class="side-block-content">
                                <?php
                                    // Get companies where "schedule_type" is "remote"
                                    $remote_companies = \App\Models\Companies::where('schedule_type', 'remote')->get();

                                    // Loop through the remote companies
                                    foreach ($remote_companies as $remote_company) {
                                        echo '<a href="' . route('companies.show', $remote_company->id) . '">' . $remote_company->name . '</a>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection