<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Conversations;
use App\Models\Jobs;
use App\Models\JobApplicants;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobsController extends Controller
{
    public function index(): View
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
            $jobs = Jobs::inRandomOrder()
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
        } elseif (auth()->user()) {
            $jobs = Jobs::inRandomOrder()->where('user_id', '!=', auth()->user()->id)->paginate(5);
        } else {
            $jobs = Jobs::inRandomOrder()->paginate(5);
        }

        $popularCategories = Jobs::query()
            ->selectRaw('job_category, count(*) as jobs_count')
            ->groupBy('job_category')
            ->orderByDesc('jobs_count')
            ->limit(6)
            ->get();

        return view('pages.jobs.index', [
            'jobs' => $jobs,
            'popularCategories' => $popularCategories,
            'totalJobsCount' => Jobs::count(),
            'totalCompaniesCount' => Companies::count(),
        ]);
    }

    public function show(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $company = Companies::find($job->company_id);

        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        return view('pages.jobs.show', [
            'job' => $job,
            'company' => $company,
        ]);
    }

    public function applicants(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        $company = Companies::find($job->company_id);

        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        $applicants = JobApplicants::where('job_id', $job->id)->paginate(10);

        return view('pages.jobs.show.applicants', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    public function applicantsInterviewing(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        $company = Companies::find($job->company_id);

        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        $applicants = JobApplicants::where('job_id', $job->id)->where('status', 'interviewing')->paginate(10);

        return view('pages.jobs.applicants.interviewing', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    public function applicantsHired(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        $company = Companies::find($job->company_id);

        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        $applicants = JobApplicants::where('job_id', $job->id)->where('status', 'hired')->paginate(10);

        return view('pages.jobs.applicants.hires', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    public function applicantsRejected(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        $company = Companies::find($job->company_id);

        if (!$company) {
            return redirect()->route('jobs.index')->with('error', 'Company not found');
        }

        $applicants = JobApplicants::where('job_id', $job->id)->where('status', 'rejected')->paginate(10);

        return view('pages.jobs.applicants.rejected', [
            'job' => $job,
            'company' => $company,
            'applicants' => $applicants,
        ]);
    }

    public function create(): View
    {
        return view('pages.jobs.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required|min:10',
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

        $job = Jobs::create([
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
            'job_status' => $request->job_status,
            'company_id' => $request->company_id,
            'job_category' => $request->job_category,
            'location' => $request->location,
            'user_id' => auth()->user()->id,
            'benefits' => $request->benefits,
            'created_at' => now(),
        ]);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job created successfully');
    }

    public function myJobs(): View
    {
        $jobs = Jobs::where('user_id', auth()->user()->id)->paginate(5);

        return view('pages.jobs.my_jobs', [
            'jobs' => $jobs,
        ]);
    }

    public function edit(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.index', [
            'job' => $job,
        ]);
    }

    public function editResponsibilities(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.responsibilities', [
            'job' => $job,
        ]);
    }

    public function updateResponsibilities(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'responsibilities' => 'required|min:10',
        ]);

        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $job->update([
            'responsibilities' => $request->responsibilities,
            'updated_at' => now(),
        ]);

        return redirect()->route('jobs.edit.responsibilities', $job->id)->with('success', 'Job updated successfully');
    }

    public function editRequirements(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.requirements', [
            'job' => $job,
        ]);
    }

    public function updateRequirements(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'requirements' => 'required|min:10',
        ]);

        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $job->update([
            'requirements' => $request->requirements,
            'updated_at' => now(),
        ]);

        return redirect()->route('jobs.edit.requirements', $job->id)->with('success', 'Job updated successfully');
    }

    public function editBenefits(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        return view('pages.jobs.edit.benefits', [
            'job' => $job,
        ]);
    }

    public function updateBenefits(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'benefits' => 'required|min:10',
        ]);

        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $job->update([
            'benefits' => $request->benefits,
            'updated_at' => now(),
        ]);

        return redirect()->route('jobs.edit.benefits', $job->id)->with('success', 'Job updated successfully');
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|min:10',
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

        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $job->update([
            'title' => $request->title,
            'description' => $request->description,
            'skills' => $request->skills,
            'employment_location_type' => $request->employment_location_type,
            'salary' => $request->salary,
            'job_salary_type' => $request->job_salary_type,
            'experience_level' => $request->experience_level,
            'education_level' => $request->education_level,
            'job_status' => $request->job_status,
            'company_id' => $request->company_id,
            'job_category' => $request->job_category,
            'location' => $request->location,
            'updated_at' => now(),
        ]);

        return redirect()->route('jobs.edit', $job->id)->with('success', 'Job updated successfully');
    }

    public function apply(Request $request, int $id): RedirectResponse
    {
        $request->validate([
            'resume' => 'required|min:10',
            'cover_letter' => 'required|min:10',
            'skills' => 'required|min:10',
        ]);

        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id == auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You cannot apply for your own job');
        }

        $applied = JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        if ($applied) {
            return redirect()->route('jobs.index')->with('error', 'You have already applied for this job');
        }

        JobApplicants::create([
            'job_id' => $job->id,
            'user_id' => auth()->user()->id,
            'status' => 'applied',
            'resume' => $request->resume,
            'cover_letter' => $request->cover_letter,
            'skills' => $request->skills,
            'created_at' => now(),
        ]);

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job application submitted successfully');
    }

    public function applyPage(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        if ($job->user_id == auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You cannot apply for your own job');
        }

        $applied = JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        if ($applied) {
            return redirect()->route('jobs.index')->with('error', 'You have already applied for this job');
        }

        $company = Companies::find($job->company_id);

        return view('pages.jobs.apply', [
            'job' => $job,
            'company' => $company,
        ]);
    }

    public function myApplication(int $id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $application = JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        if (!$application) {
            return redirect()->route('jobs.index')->with('error', 'You have not applied for this job');
        }

        $company = Companies::find($job->company_id);

        return view('pages.jobs.my_application', [
            'job' => $job,
            'company' => $company,
            'application' => $application,
        ]);
    }

    public function withdrawApplication(int $id): RedirectResponse
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $application = JobApplicants::where('job_id', $job->id)->where('user_id', auth()->user()->id)->first();

        if (!$application) {
            return redirect()->route('jobs.index')->with('error', 'You have not applied for this job');
        }

        $application->delete();

        return redirect()->route('jobs.show', $job->id)->with('success', 'Job application withdrawn successfully');
    }

    public function startInterview(Request $request, int $id, int $applicant_id): RedirectResponse
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $applicant = JobApplicants::find($applicant_id);

        if (!$applicant) {
            return redirect()->route('jobs.index')->with('error', 'Applicant not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        $request->validate([
            'message' => 'required|min:10',
            'interview_date' => 'required',
            'interview_time' => 'required',
            'interview_location' => 'required',
        ]);

        $applicant->update([
            'status' => 'interviewing',
            'interview_date' => $request->interview_date,
            'interview_time' => $request->interview_time,
            'interview_location' => $request->interview_location,
        ]);

        // Start conversation with the applicant
        Conversations::create([
            'user_id' => auth()->user()->id,
            'receiver_id' => $applicant->user_id,
            'job_id' => $job->id,
            'message' => $request->message,
            'created_at' => now(),
        ]);

        return redirect()->route('jobs.applicants', $job->id)->with('success', 'Interview started successfully');
    }

    public function viewApplicant(int $id, int $applicant_id): RedirectResponse|View
    {
        $job = Jobs::find($id);

        if (!$job) {
            return redirect()->route('jobs.index')->with('error', 'Job not found');
        }

        $applicant = JobApplicants::find($applicant_id);

        if (!$applicant) {
            return redirect()->route('jobs.index')->with('error', 'Applicant not found');
        }

        if ($job->user_id != auth()->user()->id) {
            return redirect()->route('jobs.index')->with('error', 'You are not authorized to view this page');
        }

        $company = Companies::find($job->company_id);

        $applicant->user = User::find($applicant->user_id);

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
