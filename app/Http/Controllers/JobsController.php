<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobsController extends Controller
{
    //
    public function index()
    {
        $jobs = [];

        // Lets see if we have job_title, job_type, job_location, job_category, location_type filters
        $filters = [
            'job_title' => request('job_title'),
            'job_type' => request('job_type'),
            'job_location' => request('job_location'),
            'job_category' => request('job_category'),
            'location_type' => request('location_type'),
        ];

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
                })->paginate(5);
        } else {
            // Get all jobs at random limit 1
            if(auth()->user()){
                $jobs = \App\Models\Jobs::inRandomOrder()->where('user_id', '!=', auth()->user()->id)->paginate(5);
            }else{
                $jobs = \App\Models\Jobs::inRandomOrder()->paginate(5);
            }
        }

        // Return the view
        return view('pages.jobs.index', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Show | Job
     * -------------------------------------
     * Show the job details
     */
    public function show($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Get the company details
        $company = \App\Models\Companies::find($job->company_id);

        // Make sure the company exists
        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        return view('pages.jobs.show', [
            'job' => $job,
            'company' => $company,
        ]);
    }

    /**
     * Applicants | Job
     * -------------------------------------
     * Show the job details
     */
    public function applicants($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure the user is the owner of the job
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        // Get the company details
        $company = \App\Models\Companies::find($job->company_id);

        // Make sure the company exists
        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        // Get applicants for the job
        $applicants = \App\Models\JobApplicants::where('job_id', $job->id)->paginate(10);

        return view('pages.jobs.show.applicants', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    

     /**
     * Interviewing | Applicants | Job
     * -------------------------------------
     * Show interviewing applicants for the job
     */
    public function applicantsInterviewing($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure the user is the owner of the job
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        // Get the company details
        $company = \App\Models\Companies::find($job->company_id);

        // Make sure the company exists
        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        // Get applicants for the job
        $applicants = \App\Models\JobApplicants::where('job_id', $job->id)->where('status', 'interviewing')->paginate(10);

        return view('pages.jobs.applicants.interviewing', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    /**
     * Hired | Applicants | Job
     * -------------------------------------
     * Show interviewing applicants for the job
     */
    public function applicantsHired($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure the user is the owner of the job
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        // Get the company details
        $company = \App\Models\Companies::find($job->company_id);

        // Make sure the company exists
        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        // Get applicants for the job
        $applicants = \App\Models\JobApplicants::where('job_id', $job->id)->where('status', 'hired')->paginate(10);

        return view('pages.jobs.applicants.hires', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    /**
     * Rejected | Applicants | Job
     * -------------------------------------
     * Show interviewing applicants for the job
     */
    public function applicantsRejected($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure the user is the owner of the job
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        // Get the company details
        $company = \App\Models\Companies::find($job->company_id);

        // Make sure the company exists
        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        // Get applicants for the job
        $applicants = \App\Models\JobApplicants::where('job_id', $job->id)->where('status', 'rejected')->paginate(10);

        return view('pages.jobs.applicants.rejected', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    /**
     * Create | Job
     * -------------------------------------
     * Show the job creation form
     */
    public function create()
    {
        return view('pages.jobs.create');
    }

    /**
     * Store | Job
     * -------------------------------------
     * Store the job details
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:10',
            'skills' => 'required|min:10',
            'requirements' => 'required',
            'responsibilities' => 'required',
            'employment_location_type' => 'required',
            'salary' => 'required',
            'job_salary_type' => 'required',
            'experience_level' => 'required',
            'education_level' => 'required',
            'skills' => 'required',
            'job_status' => 'required',
            'company_id' => 'required',
            'job_category' => 'required',
            'location' => 'required',
            'benefits' => 'required',
        ]);

        // Create the job
        $job = \App\Models\Jobs::create([
            'title' => $request->name,
            'description' => $request->description,
            'skills' => $request->skills,
            'requirements' => $request->requirements,
            'responsibilities' => $request->responsibilities,
            'employment_location_type' => $request->employment_location_type,
            'salary' => $request->salary,
            'job_salary_type' => $request->job_salary_type,
            'experience_level' => $request->experience_level,
            'education_level' => $request->education_level,
            'skills' => $request->skills,
            'job_status' => $request->job_status,
            'company_id' => $request->company_id,
            'job_category' => $request->job_category,
            'location' => $request->location,
            'user_id' => auth()->user()->id,
            'benefits' => $request->benefits,
            'created_at' => now(),
        ]);

        // Redirect to the job details page
        return redirect()->route('jobs.show', $job->id)->with('success', 'Job created successfully');
    }

    /**
     * My Jobs 
     * -------------------------------------
     * Show the jobs created by the user
     */
    public function myJobs()
    {
        $jobs = \App\Models\Jobs::where('user_id', auth()->user()->id)->paginate(5);

        return view('pages.jobs.my_jobs', [
            'jobs' => $jobs,
        ]);
    }

    /**
     * Edit | Index | Job
     * -------------------------------------
     * Show the job edit form
     */
    public function edit($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure job belongs to the user
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.index', [
            'job' => $job,
        ]);
    }

    /**
     * Edit Responsibilities | Job
     * -------------------------------------
     * Show the job edit responsibilities form
     */
    public function editResponsibilities($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure job belongs to the user
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.responsibilities', [
            'job' => $job,
        ]);
    }

    /**
     * Update Responsibilities | Job
     * -------------------------------------
     * Update the job responsibilities
     */
    public function updateResponsibilities(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'responsibilities' => 'required|min:10',
        ]);

        // Get the job
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Update the job
        $job->update([
            'responsibilities' => $request->responsibilities,
            'updated_at' => now(),
        ]);

        // Redirect to the job details page
        return redirect()->route('jobs.edit.responsibilities', $job->id)->with('success', 'Job updated successfully');
    }

    /**
     * Edit Requirements | Job
     * -------------------------------------
     * Show the job edit requirements form
     */
    public function editRequirements($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure job belongs to the user
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.requirements', [
            'job' => $job,
        ]);
    }

    /**
     * Update Requirements | Job
     * -------------------------------------
     * Update the job requirements
     */
    public function updateRequirements(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'requirements' => 'required|min:10',
        ]);

        // Get the job
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Update the job
        $job->update([
            'requirements' => $request->requirements,
            'updated_at' => now(),
        ]);

        // Redirect to the job details page
        return redirect()->route('jobs.edit.requirements', $job->id)->with('success', 'Job updated successfully');
    }

    /**
     * Edit Benefits | Job
     * -------------------------------------
     * Show the job edit benefits form
     */
    public function editBenefits($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure job belongs to the user
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.benefits', [
            'job' => $job,
        ]);
    }

    /**
     * Update Benefits | Job
     * -------------------------------------
     * Update the job benefits
     */
    public function updateBenefits(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'benefits' => 'required|min:10',
        ]);

        // Get the job
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Update the job
        $job->update([
            'benefits' => $request->benefits,
            'updated_at' => now(),
        ]);

        // Redirect to the job details page
        return redirect()->route('jobs.edit.benefits', $job->id)->with('success', 'Job updated successfully');
    }

    /**
     * Update | Job
     * -------------------------------------
     * Update the job details
     */
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
            'skills' => 'required|min:10',
            'employment_location_type' => 'required',
            'salary' => 'required',
            'job_salary_type' => 'required',
            'experience_level' => 'required',
            'education_level' => 'required',
            'skills' => 'required',
            'job_status' => 'required',
            'company_id' => 'required',
            'job_category' => 'required',
            'location' => 'required',
        ]);

        // Get the job
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Update the job
        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'skills' => $request->skills,
            'employment_location_type' => $request->employment_location_type,
            'salary' => $request->salary,
            'job_salary_type' => $request->job_salary_type,
            'experience_level' => $request->experience_level,
            'education_level' => $request->education_level,
            'skills' => $request->skills,
            'job_status' => $request->job_status,
            'company_id' => $request->company_id,
            'job_category' => $request->job_category,
            'location' => $request->location,
            'updated_at' => now(),
        ]);

        // Redirect to the job details page
        return redirect()->route('jobs.edit', $job->id)->with('success', 'Job updated successfully');
    }

    /**
     * Apply | Job
     * -------------------------------------
     * Apply for a job
     */
    public function apply(Request $request, $id)
    {
        // Validate resume, cover letter, and skills
        $request->validate([
            'resume' => 'required|min:10',
            'cover_letter' => 'required|min:10',
            'skills' => 'required|min:10',
        ]);

        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure the user is not the owner of the job
        if ($job->user_id == auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You cannot apply for your own job');
        }

        // Check if the user has already applied for the job
        $applied = \App\Models\JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        // If the user has already applied for the job
        if ($applied) {
            return redirect()->route('jobs.index')->with('error', 'You have already applied for this job');
        }

        // Apply for the job
        $application = \App\Models\JobApplicants::create([
            'job_id' => $job->id,
            'user_id' => auth()->user()->id,
            'status' => 'applied',
            'resume' => $request->resume,
            'cover_letter' => $request->cover_letter,
            'skills' => $request->skills,
            'created_at' => now(),
        ]);

        // Redirect to the job details page
        return redirect()->route('jobs.show', $job->id)->with('success', 'Job application submitted successfully');
    }

    /**
     * Apply | Page | Job
     * -------------------------------------
     * Show the job application form
     */
    public function applyPage($id){
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        // Make sure the user is not the owner of the job
        if ($job->user_id == auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You cannot apply for your own job');
        }

        // Check if the user has already applied for the job
        $applied = \App\Models\JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        // If the user has already applied for the job
        if ($applied) {
            return redirect()->route('jobs.index')->with('error', 'You have already applied for this job');
        }

        $company = \App\Models\Companies::find($job->company_id);

        return view('pages.jobs.apply', [
            'job' => $job,
            'company' => $company,
        ]);
    }

    /**
     * My Application
     * -------------------------------------
     * Show the user's job application for this job
     */
    public function myApplication($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $application = \App\Models\JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        // Make sure the user has applied for the job
        if (!$application) {
            return redirect()->route('jobs.index')->with('error', 'You have not applied for this job');
        }

        // Get the company details
        $company = \App\Models\Companies::find($job->company_id);

        return view('pages.jobs.my_application', [
            'job' => $job,
            'company' => $company,
            'application' => $application,
        ]);
    }

    /**
     * Withdraw Application
     * -------------------------------------
     * Withdraw the user's job application for this job
     */
    public function withdrawApplication($id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $application = \App\Models\JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        // Make sure the user has applied for the job
        if (!$application) {
            return redirect()->route('jobs.index')->with('error', 'You have not applied for this job');
        }

        // Withdraw the application
        $application->delete();

        // Redirect to the job details page
        return redirect()->route('jobs.show', $job->id)->with('success', 'Job application withdrawn successfully');
    }

    /** 
     * Start Interview | Job
     * -------------------------------------
     * Start the interview process for the job with an applicant
     */
    public function startInterview(Request $request, $id, $applicant_id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $applicant = \App\Models\JobApplicants::find($applicant_id);

        // Make sure the applicant exists
        if (!$applicant) {
            return redirect()->route('jobs.index')->with('error', 'Applicant not found');
        }

        // Make sure the user is the owner of the job
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        // Validate the request
        $request->validate([
            'message' => 'required|min:10',
            'interview_date' => 'required',
            'interview_time' => 'required',
            'interview_location' => 'required',
        ]);

        // Start the interview
        $applicant->update([
            'status' => 'interviewing',
            'interview_date' => $request->interview_date,
            'interview_time' => $request->interview_time,
            'interview_location' => $request->interview_location,
        ]);

        // Start conversation with the applicant
        $conversation = \App\Models\Conversations::create([
            'user_id' => auth()->user()->id,
            'receiver_id' => $applicant->user_id,
            'job_id' => $job->id,
            'message' => $request->message,
            'created_at' => now(),
        ]);



        // Redirect to the job details page
        return redirect()->route('jobs.applicants', $job->id)->with('success', 'Interview started successfully');
    }

    /**
     * ViewApplicant | Job
     * -------------------------------------
     * View the applicant details
     */
    public function viewApplicant($id, $applicant_id)
    {
        $job = \App\Models\Jobs::find($id);

        // Make sure the job exists
        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $applicant = \App\Models\JobApplicants::find($applicant_id);

        // Make sure the applicant exists
        if (!$applicant) {
            return redirect()->route('jobs.index')->with('error', 'Applicant not found');
        }

        // Make sure the user is the owner of the job
        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        // Get the company details
        $company = \App\Models\Companies::find($job->company_id);

        // Get user data from applicant
        $applicant->user = \App\Models\User::find($applicant->user_id);

        // Make sure user exists
        if (!$applicant->user) {
            return redirect()->route('jobs.index')->with('error', 'User not found');
        }

        return view('pages.jobs.applicants.view', [
            'job' => $job,
            'company' => $company,
            'applicant' => $applicant,
            'user' => $applicant->user,
        ]);
    }
}
