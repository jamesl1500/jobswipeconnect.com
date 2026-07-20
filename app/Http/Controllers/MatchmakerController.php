<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use App\Models\JobApplicants;
use App\Models\JobPosterMatchLikes;
use App\Models\JobSeekerMatchLikes;
use App\Models\Matches;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MatchmakerController extends Controller
{
    public function job_seeker_like(Request $request): JsonResponse
    {
        $job_id = $request->job_posting_id;
        $job_seeker_id = auth()->user()->id;

        // Check if job_seeker has liked the job
        $like = JobSeekerMatchLikes::where('job_id', $job_id)
            ->where('job_seeker_id', $job_seeker_id)
            ->first();

        if ($like) {
            // If job_seeker has liked the job, update the like
            $like->type = "like";
            $like->save();

            return response()->json(["code" => "job-liked", "message" => "Job liked"]);
        }

        // If job_seeker has not liked the job, create a new like
        JobSeekerMatchLikes::create([
            "job_id" => $job_id,
            "job_seeker_id" => $job_seeker_id,
            "type" => "like",
        ]);

        // Add a job application
        JobApplicants::create([
            "job_id" => $job_id,
            "user_id" => $job_seeker_id,
            "status" => "applied",
            "cover_letter" => $request->cover_letter,
            "skills" => $request->skills,
            "resume" => auth()->user()->resume,
        ]);

        // Get job poster from job
        $job = Jobs::find($job_id);
        $job_poster_id = $job->user_id;

        // Notify job poster
        //Notification::send(User::find($job_poster_id), new NewJobApplicant($job_id, $job_seeker_id));

        // See if job poster has liked the job_seeker
        $jp_like = JobPosterMatchLikes::where('job_id', $job_id)
            ->where('job_poster_id', $job_poster_id)
            ->where('job_seeker_id', $job_seeker_id)
            ->where('type', 'like')
            ->first();

        if ($jp_like) {
            // If job poster has liked the job_seeker, create a match
            Matches::firstOrCreate([
                "job_id" => $job_id,
                "job_seeker_id" => $job_seeker_id,
                "job_poster_id" => $job_poster_id,
            ]);

            // Notify job poster
            //Notification::send(User::find($job_poster_id), new NewJobSeekerMatch($job_id, $job_seeker_id));

            // Notify job_seeker
            //Notification::send(User::find($job_seeker_id), new NewJobPosterMatch($job_id, $job_poster_id));

            return response()->json(["code" => "job-matched", "message" => "Job matched!"]);
        }

        return response()->json(["code" => "job-liked", "message" => "Job liked!"]);
    }

    public function job_seeker_dislike(Request $request): JsonResponse
    {
        auth()->user()->jobSeekerMatchLikes()->updateOrCreate(
            ["job_id" => $request->job_posting_id],
            ["type" => "dislike"]
        );

        return response()->json(["code" => "job-disliked", "message" => "Job disliked"]);
    }

    public function job_poster_like(Request $request): JsonResponse
    {
        $job_id = $request->job_id;
        $job_seeker_id = $request->job_seeker_id;
        $job_poster_id = auth()->user()->id;

        auth()->user()->jobPosterMatchLikes()->updateOrCreate(
            ["job_id" => $job_id, "job_seeker_id" => $job_seeker_id],
            ["type" => "like"]
        );

        // See if the job_seeker has liked this job
        $js_like = JobSeekerMatchLikes::where('job_id', $job_id)
            ->where('job_seeker_id', $job_seeker_id)
            ->where('type', 'like')
            ->first();

        if ($js_like) {
            // If the job_seeker has liked the job, create a match
            Matches::firstOrCreate([
                "job_id" => $job_id,
                "job_seeker_id" => $job_seeker_id,
                "job_poster_id" => $job_poster_id,
            ]);

            return response()->json(["code" => "job-matched", "message" => "Matched!"]);
        }

        return response()->json(["code" => "applicant-liked", "message" => "Applicant liked"]);
    }

    public function job_poster_dislike(Request $request): JsonResponse
    {
        auth()->user()->jobPosterMatchLikes()->updateOrCreate(
            ["job_id" => $request->job_id, "job_seeker_id" => $request->job_seeker_id],
            ["type" => "dislike"]
        );

        return response()->json(["code" => "applicant-disliked", "message" => "Applicant disliked"]);
    }
}
