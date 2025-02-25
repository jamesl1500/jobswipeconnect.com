<?php
namespace App\Libraries;

class Matchmaker
{
    public function __construct()
    {
        // 
    }

    /**
     * getMatchedJobPostings
     * ---------------------
     * Returns matched job postings in a random way
     */
    public function getMatchedJobSeekers($filters = [])
    {
        $methods = [ 'getRandomJobSeekers', 'getJobSeekersWhoApplied', 'getJobSeekersByFilters' ];
        $method = $methods[array_rand($methods)];

        return $this->$method($filters);
    }

    /**
     * getJobSeekersByFilters
     * ---------------------
     * Returns job seekers based on filters
     */
    public function getJobSeekersByFilters($filters)
    {
        $job_seekers = \App\Models\User::inRandomOrder()
        ->where('role', '=', 'job-seeker')
        ->where('id', '!=', auth()->user()->id)
        // If the skills are not empty, find users with the skills
        ->when($filters['skills'], function ($query, $skills) {
            return $query->where('skills', 'like', '%' . $skills . '%');
        })
        // If the experience is not empty, find users with the experience
        ->when($filters['experience'], function ($query, $experience) {
            return $query->whereHas('experiences', function ($query) use ($experience) {
                $query->where('title', 'like', '%' . $experience . '%');
           });
        })
        ->limit(1)->first();

        return $job_seekers;
    }

    /**
     * getRandomJobSeekers
     * ---------------------
     * Returns random job seekers
     */
    public function getRandomJobSeekers()
    {
        $job_seekers = \App\Models\User::inRandomOrder()
        ->where('role', 'job-seeker')
        ->where('id', '!=', auth()->user()->id)->limit(1)->first();

        return $job_seekers;
    }

    /**
     * getJobSeekersWhoApplied
     * ---------------------
     * Returns job seekers who applied to our jobs
     */
    public function getJobSeekersWhoApplied()
    {
        $owned_jobs = auth()->user()->jobs->pluck('id')->toArray();

        $job_seekers = \App\Models\User::inRandomOrder()
        ->where('role', '=', 'job-seeker')
        // Find and return job seekers who have applied to our jobs
        ->whereHas('jobApplicants', function ($query) use ($owned_jobs) {
            $query->whereIn('job_id', $owned_jobs);
        })
        ->where('id', '!=', auth()->user()->id)
        ->limit(1)->first();

        return $job_seekers;
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
            $jobs = \App\Models\Jobs::inRandomOrder()->where('user_id', '!=', auth()->user()->id)->limit(1)->first();
        }

        return $jobs;
    }
}
