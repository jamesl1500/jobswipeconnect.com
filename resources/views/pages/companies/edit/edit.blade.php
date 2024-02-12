@php($title = "Edit Company")
@extends('layouts.authorized')

@section('content')
    <div class="companies-page page">
        <div class="companies-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Edit Company</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>Edit {{ $company->name }}!</h2>
                </div>
            </div>
        </div>
        <div class="container companies-page-content page-content">
           <div class="row page-row">
                <div class="companies-content col-lg-3">
                    <div class="companies-content-inner">
                        <div class="companies-content-navigation">
                            <div class="companies-content-navigation-header">
                                <h2>Navigation</h2>
                            </div>
                            <div class="companies-content-navigation-inner">
                                <ul>
                                    <li class="active"><a href="{{ route('companies.edit', $company->id) }}">Basic Details</a></li>
                                    <li><a href="{{ route('companies.edit.address', $company->id) }}">Address</a></li>
                                    <li><a href="{{ route('companies.edit.contact', $company->id) }}">Contact Info</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="companies-content posts-container col-lg-9">
                    <div class="companies-content-inner">
                        <div class="companies-content-form">
                            <div class="companies-content-inner-header">
                                <h2>Edit Basic Details</h2>
                            </div>
                            <form action="{{ route('companies.edit.post', $company->id) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-input">
                                        <div class="company-logo">
                                            <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="200" style="border-radius: 5px;margin-bottom: 20px;">
                                        </div>
                                        <label for="logo">Logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                    </div>
                                    <div class="form-input">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ $company->name }}">
                                    </div>
                                    <div class="form-input">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{ $company->description }}</textarea>
                                    </div>
                                    <div class="form-input">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" id="website" class="form-control" value="{{ $company->website }}">
                                    </div>
                                    <div class="form-input">
                                        <label for="industry">Industry</label>
                                        <input type="text" name="industry" id="industry" class="form-control" value="{{ $company->industry }}">    
                                    </div>
                                    <div class="form-input">
                                        <label for="schedule_type">Schedule Type</label>
                                        <select name="schedule_type" id="schedule_type" class="form-control">
                                            <option @if($company->schedule_type == "on-site") selected @endif value="on-site">On-Site</option>
                                            <option @if($company->schedule_type == "hybrid") selected @endif value="hybrid">Hybrid</option>
                                            <option @if($company->schedule_type == "remote") selected @endif value="remote">Remote</option>
                                        </select>
                                    </div>
                                    <div class="form-input">
                                        <input type="submit" value="Save Company" class="btn primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection