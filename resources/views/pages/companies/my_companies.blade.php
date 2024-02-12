@php($title = "My Companies")
@extends('layouts.authorized')

@section('content')
    <div class="companies-page page">
        <div class="companies-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>My Companies</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>View your companies</h2>
                </div>
            </div>
        </div>
        <div class="container companies-page-content page-content">
           <div class="row page-row">
                <div class="companies-content col-lg-3">
                    <div class="companies-content-inner">
                        
                    </div>
                </div>
                <div class="companies-content posts-container col-lg-6">
                    <div class="companies-content-inner">
                        <div class="companies-content-form-header">
                            @if(count(Auth()->user()->companies) > 1)
                                <h2>{{ count(Auth()->user()->companies) }} Companies</h2>
                            @else
                                <h2>{{ count(Auth()->user()->companies) }} Company</h2>
                            @endif
                        </div>

                        <!-- Display companies -->
                        @if (count(Auth()->user()->companies) > 0)
                            @foreach (Auth()->user()->companies as $company)
                                <div class="company">
                                    <div class="company-logo">
                                        <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}">
                                    </div>
                                    <div class="company-details">
                                        <div class="company-name">
                                            <h2>{{ $company->name }}</h2>
                                            <p>{{ ucwords($company->industry) }} &middot; {{ ucwords($company->schedule_type) }}</p>
                                        </div>
                                        <div class="company-description">
                                            <p>{{ $company->description }}</p>
                                        </div>
                                        <div class="company-actions">
                                            <a href="{{ route('companies.edit', $company->id) }}" class="btn skinny primary">Edit</a>
                                            <a href="{{ route('companies.show', $company->id) }}" class="btn skinny secondary">View</a>

                                            @if($company->website)
                                                <a style="float: right;" href="{{ $company->website }}" class="btn skinny secondary" target="_blank">Website</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p>You have not created any companies yet.</p>
                        @endif
                    </div>
                </div>
                <div class="companies-content col-lg-3">
                    <div class="companies-content-inner">
                        
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection