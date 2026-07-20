<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OnboardingController extends Controller
{
    public function showStep1(Request $request): RedirectResponse|View
    {
        // If the person has already completed step 1, move them along to step 2
        if ($request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step2');
        }

        return view('pages.onboarding.onboarding_step1');
    }

    public function showStep2(Request $request): RedirectResponse|View
    {
        // Step 2 requires step 1 to be completed first
        if (!$request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step1');
        }

        // Make sure this person is a "Job Seeker" before they can proceed to step 2
        if ($request->user()->role !== 'job-seeker') {
            return redirect()->route('dashboard.jobs');
        }

        return view('pages.onboarding.onboarding_step2');
    }

    public function processStep1(Request $request): RedirectResponse
    {
        if ($request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step2');
        }

        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|numeric|max:99999',
            'country' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,' . $request->user()->id,
        ]);

        $updated = $request->user()->update([
            'onboarding_step_1' => true,
            'profile_picture' => $request->file('profile_picture')->store('profile_pictures', 'public'),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'username' => $request->username,
        ]);

        if ($updated) {
            return redirect()->route('onboarding.step2');
        }

        return back()->with('error', 'There was an error processing your request');
    }

    public function processStep2(Request $request): RedirectResponse
    {
        if (!$request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step1');
        }

        // Make sure this person is a "Job Seeker" before they can proceed to step 2
        if ($request->user()->role !== 'job-seeker') {
            return redirect()->route('dashboard.jobs');
        }

        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
        ]);

        $resume = $request->file('resume')->store('resumes', 'public');

        $updated = $request->user()->update([
            'onboarding_step_2' => true,
            'resume' => $resume,
            'cover_letter' => $request->cover_letter,
            'skills' => $request->skills,
        ]);

        if ($updated) {
            return redirect()->route('dashboard.jobs');
        }

        return back()->with('error', 'There was an error processing your request');
    }
}
