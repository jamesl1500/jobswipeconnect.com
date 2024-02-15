<?php
use App\Libraries\Matchmaker;

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
$job_postings = $matchmaker->getJobPostings($filters);
print_r($job_postings);
?>
<div class="matchmaker">
    <div class="matchmaker-inner">

    </div>
</div>
