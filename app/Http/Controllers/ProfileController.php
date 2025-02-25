<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index($username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Add profile view
         */
        if(auth()->check() && auth()->id() !== $user->id){
            $user->profileViews()->create([
                'ip_address' => request()->ip(),
                'profile_id' => $user->id,
                'user_id' => auth()->id(),
            ]);
        }

        /**
         * Get the user's posts
         */
        $posts = $user->posts()->latest()->get();

        return view('pages.profile.profile', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    /**
     * About profile page
     * ---------------------
     */
    public function about($username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        return view('pages.profile.about', [
            'user' => $user,
        ]);
    }

    /**
     * EditCoverLetter Post
     * ---------------------
     * Save the cover letter
     */
    public function editCoverLetterPost(Request $request, $username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'cover_letter' => 'required|string|max:5000',
        ]);

        /**
         * Save the cover letter
         */
        $user->cover_letter = $request->cover_letter;
        $user->save();

        return redirect()->route('profile.about', $username)->with('success', 'Cover letter saved successfully');
    }

    /**
     * EditSkills Post
     * ---------------------
     * Save the skills
     */
    public function editSkillsPost(Request $request, $username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'skills' => 'required|string|max:5000',
        ]);

        /**
         * Save the skills
         */
        $user->skills = $request->skills;
        $user->save();

        return redirect()->route('profile.about', $username)->with('success', 'Skills saved successfully');
    }

    /**
     * AddExperience post
     * --------------------
     * Save the experience
     */
    public function addExperiencePost(Request $request, $username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string|max:5000',
            'is_current_job' => 'boolean',
            'employment_type' => 'required|in:full-time,part-time,internship,freelance,contract,temporary,remote',
        ]);

        /**
         * Save the experience
         */
        $user->experiences()->create([
            'title' => $request->title,
            'company' => $request->company,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'is_current_job' => $request->is_current_job,
            'employment_type' => $request->employment_type,
            'position' => $user->experiences()->count() + 1,
        ]);

        // Increment the position of the other experiences
        $user->experiences()->where('id', '!=', $user->experiences()->latest()->first()->id)->increment('position');

        return redirect()->route('profile.about', $username)->with('success', 'Experience saved successfully');
    }

    /**
     * Delete Experience Post
     * ---------------------
     * Delete the experience
     */
    public function deleteExperiencePost(Request $request, $username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'expid' => 'required|exists:experiences,id',
        ]);

        // Make sure logged in user is the owner of the experience
        if ($user->id !== auth()->id()) {
            return abort(403);
        }

        /**
         * Delete the experience
         */
        $user->experiences()->where('id', $request->expid)->delete();

       // Return json response
        return response()->json([
            'message' => 'Experience deleted successfully',
            'code'    => 200,
        ]);
    }

    /**
     * AddEducation post
     * --------------------
     * Save the education
     */
    public function addEducationPost(Request $request, $username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'school' => 'required|string|max:255',
            'degree' => 'required|string|max:255',
            'field_of_study' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string|max:5000',
            'is_current_study' => 'boolean',
            'education_level' => 'required|in:high-school,diploma,certificate,associate,bachelor,master,other',
        ]);

        /**
         * Save the education
         */
        $user->educations()->create($request->all());

        return redirect()->route('profile.about', $username)->with('success', 'Education saved successfully');
    }

    /**
     * Delete Education Post
     * ---------------------
     * Delete the education
     */
    public function deleteEducationPost(Request $request, $username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'eduid' => 'required|exists:educations,id',
        ]);

        // Make sure logged in user is the owner of the education
        if ($user->id !== auth()->id()) {
            return abort(403);
        }

        /**
         * Delete the education
         */
        $user->educations()->where('id', $request->eduid)->delete();

        // Return json response
        return response()->json([
            'message' => 'Education deleted successfully',
            'code'    => 200,
        ]);
    }
    
    /**
     * Resume profile page
     * ---------------------
     */
    public function resume($username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        return view('pages.profile.resume', [
            'user' => $user,
        ]);
    }

    /**
     * Save resume
     * ---------------------
     */
    public function resumePost(Request $request, $username)
    {
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return abort(404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        /**
         * Save the resume
         */
        $user->resume = $request->file('resume')->store('resumes', 'public');
        $user->save();

        return redirect()->route('profile.resume', $username)->with('success', 'Resume saved successfully');
    }

    /**
     * Get Experience Post
     * ---------------------
     * Get the experience
     */
    public function getExperiencePost(Request $request, $username){
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'code'    => 404,
            ], 404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'expid' => 'required|exists:experiences,id',
        ]);

        // Make sure logged in user is the owner of the experience
        if ($user->id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized',
                'code'    => 403,
            ], 403);
        }

        /**
         * Get the experience
         */
        $experience = $user->experiences()->where('id', $request->expid)->first();

        return response()->json([
            'message' => 'Experience retrieved successfully',
            'code'    => 200,
            'data'    => $experience,
        ]);
    }

    /**
     * Edit Experience Post
     * ---------------------
     * Edit the experience
     */
    public function editExperiencePost(Request $request, $username){
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'code'    => 404,
            ], 404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'edit_experience_id' => 'required|exists:experiences,id',
            'exp_edit_title' => 'required|string|max:255',
            'exp_edit_company' => 'required|string|max:255',
            'exp_edit_start_date' => 'required|date',
            'exp_edit_end_date' => 'nullable|date',
            'exp_edit_description' => 'nullable|string|max:5000',
            'exp_edit_is_current_job' => 'boolean',
            'exp_edit_employment_type' => 'required|in:full-time,part-time,internship,freelance,contract,temporary,remote',
        ]);

        // Make sure logged in user is the owner of the experience
        if ($user->id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized',
                'code'    => 403,
            ], 403);
        }

        /**
         * Edit the experience
         */
        $experience = $user->experiences()->where('id', $request->edit_experience_id)->first();
        $experience->update([
            'title' => $request->exp_edit_title,
            'company' => $request->exp_edit_company,
            'start_date' => $request->exp_edit_start_date,
            'end_date' => $request->exp_edit_end_date,
            'description' => $request->exp_edit_description,
            'is_current_job' => $request->exp_edit_is_current_job,
            'employment_type' => $request->exp_edit_employment_type,
        ]);

        return redirect()->route('profile.about', $username)->with('success', 'Experience saved successfully');
    }

    /**
     * Update Experience list order
     * ---------------------
     * Update the experience list order
     */
    public function updateExperienceOrder(Request $request, $username){
        /**
         * Check if user exists
         */
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'code'    => 404,
            ], 404);
        }

        /**
         * Validate the request
         */
        $request->validate([
            'expid' => 'required|array',
        ]);

        // Make sure logged in user is the owner of the experience
        if ($user->id !== auth()->id()) {
            return response()->json([
                'message' => 'Unauthorized',
                'code'    => 403,
            ], 403);
        }

        // Update the experience list order
        foreach ($request->expid as $key => $expid) {
            $user->experiences()->where('id', $expid)->update(['position' => $key + 1]);
        }

        return response()->json([
            'message' => 'Experience list order updated successfully',
            'code'    => 200,
        ]);
    }
}
