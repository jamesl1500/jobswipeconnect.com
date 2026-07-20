<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function index(string $username): View
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        // Record a profile view when someone other than the owner visits
        if (auth()->check() && auth()->id() !== $user->id) {
            $user->profileViews()->create([
                'ip_address' => request()->ip(),
                'profile_id' => $user->id,
                'user_id' => auth()->id(),
            ]);
        }

        $posts = $user->posts()->latest()->get();

        return view('pages.profile.profile', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function about(string $username): View
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        return view('pages.profile.about', [
            'user' => $user,
        ]);
    }

    public function editCoverLetterPost(Request $request, string $username): RedirectResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'cover_letter' => 'required|string|max:5000',
        ]);

        $user->cover_letter = $request->cover_letter;
        $user->save();

        return redirect()->route('profile.about', $username)->with('success', 'Cover letter saved successfully');
    }

    public function editSkillsPost(Request $request, string $username): RedirectResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'skills' => 'required|string|max:5000',
        ]);

        $user->skills = $request->skills;
        $user->save();

        return redirect()->route('profile.about', $username)->with('success', 'Skills saved successfully');
    }

    public function addExperiencePost(Request $request, string $username): RedirectResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'description' => 'nullable|string|max:5000',
            'is_current_job' => 'boolean',
            'employment_type' => 'required|in:full-time,part-time,internship,freelance,contract,temporary,remote',
        ]);

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

    public function deleteExperiencePost(Request $request, string $username): JsonResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'expid' => 'required|exists:experiences,id',
        ]);

        // Make sure logged in user is the owner of the experience
        if ($user->id !== auth()->id()) {
            abort(403);
        }

        $user->experiences()->where('id', $request->expid)->delete();

        return response()->json([
            'message' => 'Experience deleted successfully',
            'code'    => 200,
        ]);
    }

    public function addEducationPost(Request $request, string $username): RedirectResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

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

        $user->educations()->create($request->all());

        return redirect()->route('profile.about', $username)->with('success', 'Education saved successfully');
    }

    public function deleteEducationPost(Request $request, string $username): JsonResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'eduid' => 'required|exists:educations,id',
        ]);

        // Make sure logged in user is the owner of the education
        if ($user->id !== auth()->id()) {
            abort(403);
        }

        $user->educations()->where('id', $request->eduid)->delete();

        return response()->json([
            'message' => 'Education deleted successfully',
            'code'    => 200,
        ]);
    }

    public function resume(string $username): View
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        return view('pages.profile.resume', [
            'user' => $user,
        ]);
    }

    public function resumePost(Request $request, string $username): RedirectResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

        $request->validate([
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        $user->resume = $request->file('resume')->store('resumes', 'public');
        $user->save();

        return redirect()->route('profile.resume', $username)->with('success', 'Resume saved successfully');
    }

    public function getExperiencePost(Request $request, string $username): JsonResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'code'    => 404,
            ], 404);
        }

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

        $experience = $user->experiences()->where('id', $request->expid)->first();

        return response()->json([
            'message' => 'Experience retrieved successfully',
            'code'    => 200,
            'data'    => $experience,
        ]);
    }

    public function editExperiencePost(Request $request, string $username): RedirectResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            abort(404);
        }

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
            abort(403);
        }

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

    public function updateExperienceOrder(Request $request, string $username): JsonResponse
    {
        $user = User::where('username', $username)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found',
                'code'    => 404,
            ], 404);
        }

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

        foreach ($request->expid as $key => $expid) {
            $user->experiences()->where('id', $expid)->update(['position' => $key + 1]);
        }

        return response()->json([
            'message' => 'Experience list order updated successfully',
            'code'    => 200,
        ]);
    }
}
