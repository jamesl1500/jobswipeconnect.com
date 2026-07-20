<?php

namespace App\Libraries;

use App\Models\JobApplicants;
use App\Models\Jobs;
use App\Models\User;

class Matchmaker
{
    /**
     * getMatchedJobSeekers
     * ---------------------
     * Returns matched job postings in a random way
     */
    public function getMatchedJobSeekers(array $filters = []): ?User
    {
        $methods = ['getRandomJobSeekers', 'getJobSeekersWhoApplied', 'getJobSeekersByFilters'];
        $method = $methods[array_rand($methods)];

        return $this->$method($filters);
    }

    /**
     * getJobSeekersByFilters
     * ---------------------
     * Returns job seekers based on filters
     */
    public function getJobSeekersByFilters(array $filters): ?User
    {
        return User::inRandomOrder()
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
            // If the education is not empty, find users with that education level
            ->when($filters['education'] ?? null, function ($query, $education) {
                return $query->whereHas('educations', function ($query) use ($education) {
                    $query->where('education_level', $education);
                });
            })
            ->limit(1)->first();
    }

    /**
     * getRandomJobSeekers
     * ---------------------
     * Returns random job seekers
     */
    public function getRandomJobSeekers(): ?User
    {
        return User::inRandomOrder()
            ->where('role', 'job-seeker')
            ->where('id', '!=', auth()->user()->id)->limit(1)->first();
    }

    /**
     * getJobSeekersWhoApplied
     * ---------------------
     * Returns job seekers who applied to our jobs
     */
    public function getJobSeekersWhoApplied(): ?User
    {
        $owned_jobs = auth()->user()->jobs->pluck('id')->toArray();

        return User::inRandomOrder()
            ->where('role', '=', 'job-seeker')
            // Find and return job seekers who have applied to our jobs
            ->whereHas('jobApplicants', function ($query) use ($owned_jobs) {
                $query->whereIn('job_id', $owned_jobs);
            })
            ->where('id', '!=', auth()->user()->id)
            ->limit(1)->first();
    }

    /**
     * getJobPostings
     * ---------------------
     * Returns all job postings
     */
    public function getJobPostings(array $filters): ?Jobs
    {
        $query = Jobs::query()
            ->where('user_id', '!=', auth()->user()->id)
            // Don't resurface jobs the user has already applied to
            ->whereDoesntHave('applicants', function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            // Don't resurface jobs the user has already liked or disliked
            ->whereDoesntHave('seekerMatchLikes', function ($query) {
                $query->where('job_seeker_id', auth()->user()->id);
            });

        // See if filters are set
        if ($filters['job_title'] != "" || $filters['job_type'] != "" || $filters['job_location'] != "" || $filters['job_category'] != "" || $filters['location_type'] != "") {
            $query
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
                });
        }

        return $query->inRandomOrder()->limit(1)->first();
    }

    /**
     * resolveJobForJobSeeker
     * ---------------------
     * Resolves which of the authenticated job poster's jobs a candidate should be
     * matched against: prefers a job the candidate actually applied to, falling
     * back to the poster's most recent job posting. Returns null if the poster
     * has no job postings to match against.
     */
    public function resolveJobForJobSeeker(User $job_seeker): ?Jobs
    {
        $owned_job_ids = auth()->user()->jobs()->pluck('id');

        if ($owned_job_ids->isEmpty()) {
            return null;
        }

        $applied_job_id = JobApplicants::where('user_id', $job_seeker->id)
            ->whereIn('job_id', $owned_job_ids)
            ->value('job_id');

        if ($applied_job_id) {
            return Jobs::find($applied_job_id);
        }

        return auth()->user()->jobs()->latest()->first();
    }
}
