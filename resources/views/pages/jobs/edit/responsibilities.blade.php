@php($title = 'Edit Job | Edit Responsibilities')
@extends('layouts.authorized')

@section('content')
<div class="settings-page page">
    <div class="settings-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Edit Job</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Edit Responsibilities</h2>
            </div>
        </div>
    </div>
    <div class="container page-content">
        <div class="row page-row">
            <div class="left-navigation col-lg-3">
                <div class="left-navigation-header">
                    <h3>Settings</h3>
                </div>
                <div class="left-navigation-menu">
                    <ul>
                        <li><a href="{{ route('jobs.edit', $job->id) }}">Basic Information</a></li>
                        <li class="active"><a href="{{ route('jobs.edit.responsibilities', $job->id) }}">Responsibilities</a></li>
                        <li><a href="{{ route('jobs.edit.requirements', $job->id) }}">Requirements</a></li>
                        <li><a href="{{ route('jobs.edit.benefits', $job->id) }}">Benefits</a></li>
                    </ul>
                </div>
            </div>
            <div class="settings-content col-lg-9">
                <div class="settings-content-inner">
                    <div class="settings-content-form-header">
                        <h2>Edit Responsibilities</h2>
                    </div>
                    <form action="{{ route('jobs.edit.responsibilities.post', $job->id) }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf

                            <!-- Responsibilities -->
                            <div class="form-input">
                                <label for="responsibilities">Responsibilities</label>
                                <textarea name="responsibilities" id="responsibilities" class="form-control">{{ $job->responsibilities }}</textarea>
                            </div>

                            <!-- Submit -->
                            <div class="form-input">
                                <input type="submit" value="Save Changes" class="btn primary" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
    </div>
</div>
@endsection