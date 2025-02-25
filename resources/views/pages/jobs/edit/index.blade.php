@php($title = 'Edit Job | Basic Information')
@extends('layouts.authorized')

@section('content')
<div class="settings-page page">
    <div class="settings-page-header page-header">
        <div class="container page-header-container">
            <div class="page-header-title">
                <h1>Edit Job</h1>
            </div>
            <div class="page-header-subtext">
                <h2>Edit Basic Information</h2>
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
                        <li class="active"><a href="{{ route('jobs.edit', $job->id) }}">Basic Information</a></li>
                        <li><a href="{{ route('jobs.edit.responsibilities', $job->id) }}">Responsibilities</a></li>
                        <li><a href="{{ route('jobs.edit.requirements', $job->id) }}">Requirements</a></li>
                        <li><a href="{{ route('jobs.edit.benefits', $job->id) }}">Benefits</a></li>
                    </ul>
                </div>
            </div>
            <div class="settings-content col-lg-9">
                <div class="settings-content-inner">
                    <div class="settings-content-form-header">
                        <h2>Edit Basic Information</h2>
                    </div>
                    <form action="{{ route('jobs.edit.update', $job->id) }}" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            @csrf

                            <!-- Company -->
                            <?php
                            $companies = auth()->user()->companies;
                            ?>
                            <div class="form-input">
                                <label for="company_id">Company</label>
                                <select name="company_id" id="company_id" class="form-control">
                                    <option value="">Select Company</option>
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $job->company_id == $company->id ? "selected" : "" }}>{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Title -->
                            <div class="form-input">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $job->title }}" />
                            </div>

                            <!-- Description -->
                            <div class="form-input">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ $job->description }}</textarea>
                            </div>

                            <!-- Skills -->
                            <div class="form-input">
                                <label for="skills">Skills</label>
                                <p>Separate skills with a comma</p>
                                <input type="text" name="skills" id="skill" class="form-control" value="{{ $job->skills }}">
                            </div>

                            <!-- Job Category -->
                            <div class="form-input">
                                <label for="job_category">Job Category</label>
                                <select name="job_category" id="job_category" class="form-control">
                                    <option value="">Select job category</option>
                                    <?php
                                    // Get job categories
                                    $job_categories = ["accounting","administrative","advertising","banking","business","community","construction","customer-service","design","education","engineering","finance","healthcare","hospitality","human-resources","information-technology","legal","management","manufacturing","marketing","media","non-profit","real-estate","retail","sales","science","security","skilled-labor","transportation","other"];
                                    ?>
                                    @foreach($job_categories as $job_category)
                                        <option value="{{ $job_category }}"{{ $job->job_category == $job_category ? "selected" : "" }} >{{ ucwords($job_category) }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Salary & Salary Type -->
                            <div class="form-group">
                                <div class="inline-form-group">
                                    <div class="form-input">
                                        <label for="salary">Salary</label>
                                        <input type="text" name="salary" id="salary" class="form-control" value="{{ $job->salary }}">
                                    </div>
                                    <div class="form-input">
                                        <label for="job_salary_type">Salary Type</label>
                                        <select name="job_salary_type" id="job_salary_type" class="form-control" value="{{ $job->job_salary_type }}">
                                            <option value="hourly">Hourly</option>
                                            <option value="salaried">Salaried</option>
                                            <option value="commission">Commission</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Job Status & Location -->
                            <div class="form-group">
                                <div class="inline-form-group">
                                    <div class="form-input">
                                        <label for="job_status">Job Type</label>
                                        <select name="job_status" id="job_status" class="form-control" value="{{ $job->job_status }}">
                                            <option value="full-time">Full Time</option>
                                            <option value="part-time">Part Time</option>
                                            <option value="contract">Contract</option>
                                            <option value="temporary">Temporary</option>
                                            <option value="internship">Internship</option>
                                        </select>
                                    </div>
                                    <div class="form-input">
                                        <label for="location">Location</label>
                                        <input type="text" name="location" id="location" class="form-control" value="{{ $job->location }}">
                                    </div>
                                </div>
                            </div>
                            <!-- Experience Level & Education Level -->
                            <div class="form-group">
                                <div class="inline-form-group">
                                    <div class="form-input">
                                        <label for="experience_level">Experience Level</label>
                                        <select name="experience_level" id="experience_level" class="form-control" value="{{ $job->experience_level }}">
                                            <option value="internship">Internship</option>
                                            <option value="entry-level">Entry Level</option>
                                            <option value="mid-senior-level">Mid Level</option>
                                            <option value="senior-level">Director</option>
                                        </select>
                                    </div>
                                    <div class="form-input">
                                        <label for="education_level">Education Level</label>
                                        <select name="education_level" id="education_level" class="form-control" value="{{ $job->education_level }}">
                                            <option value="high-school">High School</option>
                                            <option value="certificate">Certificate</option>
                                            <option value="associate">Associate</option>
                                            <option value="bachelor">Bachelor</option>
                                            <option value="master">Master</option>
                                            <option value="doctorate">Doctorate</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Schedule Type -->
                            <div class="form-input">
                                <label for="employment_location_type">Schedule Type</label>
                                <select name="employment_location_type" id="employment_location_type" class="form-control" value="{{ $job->employment_location_type }}">
                                    <option value="on-site">On-Site</option>
                                    <option value="hybrid">Hybrid</option>
                                    <option value="remote">Remote</option>
                                </select>
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