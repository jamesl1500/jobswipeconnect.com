<?php
namespace App\Libraries;

class Matchmaker
{
    public function __construct()
    {
        // 
    }

    /**
     * getJobPostings
     * ---------------------
     * Returns all job postings
     */
    public function getJobPostings($filters)
    {
        $jobs = [];

        // See if filters are set
        if ($filters['job_title'] != "" || $filters['job_type'] != "" || $filters['job_location'] != "" || $filters['job_category'] != "" || $filters['location_type'] != "") {
            // If a filter is set add a where clause to the query
            $jobs = \App\Models\Jobs::inRandomOrder()
                ->when($filters['job_title'], function ($query, $job_title) {
                    return $query->where('title', 'like', '%' . $job_title . '%');
                })
                ->when($filters['job_type'], function ($query, $job_type) {
                    return $query->where('job_status', $job_type);
                })
                ->when($filters['job_location'], function ($query, $job_location) {
                    return $query->where('location', 'like', '%' . $job_location . '%');
                })
                ->when($filters['job_category'], function ($query, $job_category) {
                    return $query->where('job_category', $job_category);
                })
                ->when($filters['location_type'], function ($query, $location_type) {
                    return $query->where('employment_location_type', $location_type);
                })
                // Join job_applications to make sure logged user has not applied
                ->leftJoin('job_applicants', function ($join) {
                    $join->on('jobs.id', '=', 'job_applicants.job_id')
                        ->where('job_applicants.user_id', '!=', auth()->user()->id);
                })
                // Join job_seeker_match_likes to make sure logged user has not liked
                ->leftJoin('job_seeker_match_likes', function ($join) {
                    $join->on('jobs.id', '=', 'job_seeker_match_likes.job_id')
                        ->where('job_seeker_match_likes.job_seeker_id', '!=', auth()->user()->id);
                })
                ->limit(1)->first();
        } else {
            // Get all jobs at random limit 1
            $jobs = \App\Models\Jobs::inRandomOrder()->limit(1)->first();
        }

        return $jobs;
    }
}
