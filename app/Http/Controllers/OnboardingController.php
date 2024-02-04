<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    /**
     * ShowStep1
     * Show step 1 of onboarding
     * 
     * @param Request $request
     */
    public function showStep1(Request $request)
    {
        /**
         * Lets make sure the person is in onboarding step one, if they're in
         * step 2, we should redirect them to step 2. 
         */
        if ($request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step2');
        }

        return view('pages.onboarding.onboarding_step1');
    }

    /** ShowStep2
     * Show step 2 of onboarding
     * 
     * @param Request $request
     */
    public function showStep2(Request $request)
    {
        /**
         * Lets make sure the person is in onboarding step one, if they're in
         * step 2, we should redirect them to step 2. 
         */
        if (!$request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step1');
        }

        /**
         * Make sure this person is a "Job Seeker" before they can proceed to step 2
         */
        if ($request->user()->role !== 'job-seeker') {
            return redirect()->route('dashboard');
        }
         
        return view('pages.onboarding.onboarding_step2');
    }

    /**
     * ProcessStep1
     * Process step 1 of onboarding
     * 
     * @param Request $request
     */
    public function processStep1(Request $request)
    {
               /**
         * Lets make sure the person is in onboarding step one, if they're in
         * step 2, we should redirect them to step 2. 
         */
        if ($request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step2');
        }

        /**
         * Validate request
         * -----------------
         * We should be validating the uploaded profile picture and 
         * address fields (Address, City, State, Zip, Country) here.
         */
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|numeric|max:99999',
            'country' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$request->user()->id,
        ]);
        
        // Process step 1
        if($request->user()->update([
            'onboarding_step_1' => true,
            'profile_picture' => $request->file('profile_picture')->store('profile_pictures', 'public'),
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => $request->country,
            'username' => $request->username
        ]))
        {
            return redirect()->route('onboarding.step2');
        }else{
            return back()->with('error', 'There was an error processing your request');
        }

        return redirect()->route('onboarding.step2');
    }

    /**
     * ProcessStep2
     * Process step 2 of onboarding
     * 
     * @param Request $request
     */
    public function processStep2(Request $request)
    {
        /**
         * Lets make sure the person is in onboarding step two
         */
        if (!$request->user()->onboarding_step_1) {
            return redirect()->route('onboarding.step1');
        }

        /**
         * Make sure this person is a "Job Seeker" before they can proceed to step 2
         */
        if ($request->user()->role !== 'job-seeker') {
            return redirect()->route('dashboard');
        }

        // Validation
        $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'cover_letter' => 'required|string|max:255',
            'skills' => 'required|string|max:255',
        ]);

        // Upload resume
        $resume = $request->file('resume')->store('resumes', 'public');

        // Process step 2
        if($request->user()->update([
            'onboarding_step_2' => true,
            'resume' => $resume,
            'cover_letter' => $request->cover_letter,
            'skills' => $request->skills
        ]))
        {
            return redirect()->route('dashboard');
        }else{
            return back()->with('error', 'There was an error processing your request');
        }
        
        return redirect()->route('dashboard');
    }
}
