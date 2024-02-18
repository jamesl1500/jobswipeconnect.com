<?php
use App\Libraries\Matchmaker;

use App\Models\Companies;

$matchmaker = new Matchmaker();

// Lets get all filter query strings from url
$job_title = request()->job_title;
$job_category = request()->job_category;
$job_location = request()->job_location;
$job_type = request()->job_type;
$location_type = request()->location_type;

// Create array of filters
$filters = [
    'job_title' => $job_title,
    'job_category' => $job_category,
    'job_location' => $job_location,
    'job_type' => $job_type,
    'location_type' => $location_type
];

// Since this is a job seeker, we will get all the job postings
$job_posting = $matchmaker->getJobPostings($filters);

// Get company details
$company_id = $job_posting->company_id;
$company = Companies::where('id', $company_id)->first();
?>
<div class="matchmaker job-seeker-version">
    <div class="matchmaker-inner">
        <div class="company-info-top">
            <div class="company-logo">
                <img src="{{ asset('storage/'.$company->logo) }}" alt="{{ $company->name }}">
            </div>
            <div class="company-info">
                <h3>{{ $company->name }}</h3>
                <p>{{ $company->industry }}</p>
            </div>
        </div>
        <div class="job-info">
            <h3>{{ $job_posting->title }}</h3>
            <p>{{ ucwords($job_posting->employment_location_type) }} &middot; {{ ucwords($job_posting->job_category) }}</p>
            <p>
                <span><b>Experience Level:</b></span>
                {{ $job_posting->experience_level }}
            </p>
        </div>
        <div class="job-description">
            <!-- if description is too long, we will cut it off and add a read more link -->
            <h5>Description</h5>

            <?php if(strlen($job_posting->description) > 350){ ?>
                <p>{{ substr($job_posting->description, 0, 350) }}... <a href="">Read More</a></p>
            <?php }else{ ?>
                <p>{{ $job_posting->description }}</p>
            <?php } ?>
            <p>Skills: {{ $job_posting->skills }}</p>
        </div>
        <div class="apply-now">
            <!-- Show a dislike and like button -->
            <div class="dislike">
                <form action="{{ route('matchmaker.job_seeker.dislike') }}" method="post">
                    @csrf
                    <input type="hidden" name="job_posting_id" value="{{ $job_posting->id }}">
                    <button type="submit" class="btn btn-danger">Dislike</button>
                </form>
            </div>
            <div class="like">
                <!-- Include modal for applying to job -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#applyModal">Like</button>

                <!-- Modal -->
                <div class="modal fade" id="applyModal" tabindex="-1" role="dialog" aria-labelledby="applyModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="applyModalLabel">Apply to {{ $job_posting->title }}</h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('matchmaker.job_seeker.like') }}" method="post">
                                <div class="modal-body">
                                    <p style="text-align: left;">Let's apply to this job and send the job poster your cover letter and skills. Your resume will lautomatically be sent too!</p>
                                    @csrf
                                    <input type="hidden" name="job_posting_id" value="{{ $job_posting->id }}">
                                    
                                    <div class="form-group">
                                        <div class="form-input">
                                            <label for="cover_letter" style="text-align: left;">Cover Letter</label>
                                            <textarea name="cover_letter" id="cover_letter" cols="30" rows="10">{{ auth()->user()->cover_letter }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-input">
                                            <label for="skills" style="text-align: left;">Skills</label>
                                            <input type="text" name="skills" id="skills" value="{{ auth()->user()->skills }}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a type="button" class="btn btn-secondary" href="" data-bs-dismiss="modal">Close</a>
                                    <button type="submit" class="btn btn-success">Like & Apply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
