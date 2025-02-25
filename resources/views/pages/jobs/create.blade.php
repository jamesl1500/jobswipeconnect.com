@php($title = "Create Job")
@extends('layouts.authorized')

@section('content')
    <div class="jobs-page page">
        <div class="jobs-header page-header">
            <div class="container page-header-container">
                <div class="page-header-title">
                    <h1>Create Job</h1>
                </div>
                <div class="page-header-subtext">
                    <h2>Create a job!</h2>
                </div>
            </div>
        </div>
        <div class="jobs-page-inline-navigation">
            <div class="container">
                <div class="jobs-page-inline-navigation-inner">
                    <ul>
                        <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                        @if(auth()->user() and auth()->user()->role == 'job-seeker')
                            <li><a href="{{ route('dashboard.feed') }}">Applied Jobs</a></li>
                        @else
                            <li class="active"><a href="{{ route('jobs.create') }}">Create Jobs</a></li>
                            <li><a href="{{ route('jobs.my_jobs') }}">My Jobs</a></li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="container jobs-page-content page-content">
           <div class="row page-row">
                <div class="jobs-content col-lg-3">
                    <div class="jobs-content-inner">

                    </div>
                </div>
                <div class="jobs-content jobs-create-container col-lg-6">
                    <div class="jobs-content-inner">
                        <div class="jobs-content-form">
                            <form action="{{ route('jobs.create.post') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-input">
                                        <?php
                                        // Get logged users companies
                                        $companies = auth()->user()->companies;

                                        // Check if user has companies  
                                        if($companies->count() > 0)
                                        {
                                            ?>
                                                <label for="company_id">Company</label>
                                                <select name="company_id" id="company_id" class="form-control">
                                                    <option value="">Select company</option>
                                                    @foreach($companies as $company)
                                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                                    @endforeach
                                                </select>
                                            <?php
                                        }else{
                                            ?>
                                                <label for="company_id">Company</label>
                                                <p>You need to create a company before you can create a job. <a href="{{ route('companies.create') }}">Create Company</a></p>
                                            <?php
                                        }
                                        ?>
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
                                        <label for="skills">Skills</label>
                                        <input type="text" name="skills" id="skill" class="form-control" value="{{ old('skills') }}">
                                    </div>
                                    <div class="form-input">
                                        <label for="requirements">Requirements</label>
                                        <textarea name="requirements" id="requirements" class="form-control">{{ old('requirements') }}</textarea>
                                    </div>
                                    <div class="form-input">
                                        <label for="responsibilities">Responsibilities</label>
                                        <textarea name="responsibilities" id="responsibilities" class="form-control">{{ old('responsibilities') }}</textarea>
                                    </div>
                                    <div class="form-input">
                                        <label for="benefits">Benefits</label>
                                        <textarea name="benefits" id="benefits" class="form-control">{{ old('benefits') }}</textarea>
                                    </div>
                                    <div class="form-input">
                                        <label for="job_category">Job Category</label>
                                        <select name="job_category" id="job_category" class="form-control">
                                            <option value="">Select job category</option>
                                            <?php
                                            // Get job categories
                                            $job_categories = ["accounting","administrative","advertising","banking","business","community","construction","customer-service","design","education","engineering","finance","healthcare","hospitality","human-resources","information-technology","legal","management","manufacturing","marketing","media","non-profit","real-estate","retail","sales","science","security","skilled-labor","transportation","other"];
                                            ?>
                                            @foreach($job_categories as $job_category)
                                                <option value="{{ $job_category }}">{{ ucwords($job_category) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="inline-form-group">
                                        <div class="form-input">
                                            <label for="salary">Salary</label>
                                            <input type="text" name="salary" id="salary" class="form-control" value="{{ old('salary') }}">
                                        </div>
                                        <div class="form-input">
                                            <label for="job_salary_type">Salary Type</label>
                                            <select name="job_salary_type" id="job_salary_type" class="form-control">
                                                <option value="hourly">Hourly</option>
                                                <option value="salaried">Salaried</option>
                                                <option value="commission">Commission</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="inline-form-group">
                                        <div class="form-input">
                                            <label for="job_status">Job Type</label>
                                            <select name="job_status" id="job_status" class="form-control">
                                                <option value="full-time">Full Time</option>
                                                <option value="part-time">Part Time</option>
                                                <option value="contract">Contract</option>
                                                <option value="temporary">Temporary</option>
                                                <option value="internship">Internship</option>
                                            </select>
                                        </div>
                                        <div class="form-input">
                                            <label for="location">Location</label>
                                            <input type="text" name="location" id="location" class="form-control" value="{{ old('location') }}">
                                        </div>
                                    </div>
                                    <div class="inline-form-group">
                                        <div class="form-input">
                                            <label for="experience_level">Experience Level</label>
                                            <select name="experience_level" id="experience_level" class="form-control">
                                                <option value="internship">Internship</option>
                                                <option value="entry-level">Entry Level</option>
                                                <option value="mid-senior-level">Mid Level</option>
                                                <option value="senior-level">Director</option>
                                            </select>
                                        </div>
                                        <div class="form-input">
                                            <label for="education_level">Education Level</label>
                                            <select name="education_level" id="education_level" class="form-control">
                                                <option value="high-school">High School</option>
                                                <option value="certificate">Certificate</option>
                                                <option value="associate">Associate</option>
                                                <option value="bachelor">Bachelor</option>
                                                <option value="master">Master</option>
                                                <option value="doctorate">Doctorate</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-input">
                                        <label for="employment_location_type">Schedule Type</label>
                                        <select name="employment_location_type" id="employment_location_type" class="form-control">
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
                <div class="jobs-content col-lg-3">
                    <div class="jobs-content-inner">

                    </div>
                </div>
           </div>
        </div>
    </div>
@endsection