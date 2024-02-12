@php($title = "Create Company")
@extends('layouts.both')

@section('content')
    <div class="companies-page page">
        <div class="companies-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Create Company</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>Create a company!</h2>
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
                        <div class="companies-content-form">
                            <form action="{{ route('companies.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-input">
                                        <label for="logo">Logo</label>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                    </div>
                                    <div class="form-input">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                                    </div>
                                    <div class="form-input">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                    <div class="form-input">
                                        <label for="website">Website</label>
                                        <input type="text" name="website" id="website" class="form-control" value="{{ old('website') }}">
                                    </div>
                                    <div class="form-input">
                                        <label for="industry">Industry</label>
                                        <input type="text" name="industry" id="industry" class="form-control" value="{{ old('industry') }}">    
                                    </div>
                                    <div class="form-input">
                                        <label for="schedule_type">Schedule Type</label>
                                        <select name="schedule_type" id="schedule_type" class="form-control">
                                            <option value="on-site">On-Site</option>
                                            <option value="hybrid">Hybrid</option>
                                            <option value="remote">Remote</option>
                                        </select>
                                    </div>
                                    <div class="form-input">
                                        <input type="submit" value="Create Company" class="btn primary">
                                    </div>
                                </div>
                            </form>
                        </div>
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