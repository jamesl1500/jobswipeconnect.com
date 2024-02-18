<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;

use App\Notifications\NewJobApplicant;
use App\Notifications\NewJobPosterLike;
use App\Notifications\NewJobSeekerLike;
use App\Notifications\NewJobPosterMatch;
use App\Notifications\NewJobSeekerMatch;


class MatchmakerController extends Controller
{
    //
    public function job_seeker_like(Request $request)
    {
        $job_id = $request->job_posting_id;
        $job_seeker_id = auth()->user()->id;

        // Check if job_seeker has liked the job
        $like = \App\Models\JobSeekerMatchLikes::where('job_id', $job_id)
            ->where('job_seeker_id', $job_seeker_id)
            ->first();

        if ($like) {
            // If job_seeker has liked the job, update the like
            $like->type = "like";
            $like->save();
        } else {
            // If job_seeker has not liked the job, create a new like
            \App\Models\JobSeekerMatchLikes::create([
                "job_id" => $job_id,
                "job_seeker_id" => $job_seeker_id,
                "type" => "like"
            ]);

            // Add a job application
            \App\Models\JobApplicants::create([
                "job_id" => $job_id,
                "user_id" => $job_seeker_id,
                "status" => "applied",
                "cover_letter" => $request->cover_letter,
                "skills" => $request->skills,
                "resume" => auth()->user()->resume,
            ]);

            // Get job poster from job
            $job = \App\Models\Jobs::find($job_id);
            $job_poster_id = $job->user_id;

            // Notify job poster
            //Notification::send(User::find($job_poster_id), new NewJobApplicant($job_id, $job_seeker_id));

            // See if job poster has liked the job_seeker
            $jp_like = \App\Models\JobPosterMatchLikes::where('job_id', $job_id)
                ->where('job_poster_id', $job_poster_id)
                ->where('job_seeker_id', $job_seeker_id)
                ->first();

            if ($jp_like) {
                // If job poster has liked the job_seeker, create a match
                \App\Models\Matches::create([
                    "job_id" => $job_id,
                    "job_seeker_id" => $job_seeker_id,
                    "job_poster_id" => $job_poster_id,
                ]);

                // Notify job poster
                //Notification::send(User::find($job_poster_id), new NewJobSeekerMatch($job_id, $job_seeker_id));

                // Notify job_seeker
                //Notification::send(User::find($job_seeker_id), new NewJobPosterMatch($job_id, $job_poster_id));

                return response()->json(["code" => "job-matched", "message" => "Job matched!"]);
            }else{
                return response()->json(["code" => "job-liked", "message" => "Job liked!"]);
            }
        }

        return response()->json(["code" => "job-liked", "message" => "Job liked"]);
    }
}
