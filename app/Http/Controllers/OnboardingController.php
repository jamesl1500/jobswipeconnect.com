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
        return view('onboarding.onboarding_step1');
    }

    /** ShowStep2
     * Show step 2 of onboarding
     * 
     * @param Request $request
     */
    public function showStep2(Request $request)
    {
        return view('onboarding.onboarding_step2');
    }

    /**
     * ProcessStep1
     * Process step 1 of onboarding
     * 
     * @param Request $request
     */
    public function processStep1(Request $request)
    {
        // Process step 1
        $request->user()->update([
            'onboarding_step1' => true
        ]);

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
        // Process step 2
        $request->user()->update([
            'onboarding_step2' => true
        ]);

        return redirect()->route('dashboard');
    }
}
