<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnboardingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Redirect back to verify notice page if user has not verified their email
        if( !$request->user()->hasVerifiedEmail() )
        {
            return redirect()->route('verification.notice');
        }

        // See if user has completed onboarding step 1
        if( !$request->user()->hasCompletedOnboardingStep1() )
        {
            return redirect()->route('onboarding.step1');
        }

        // See if user has completed onboarding step 2
        if( !$request->user()->hasCompletedOnboardingStep2() )
        {
            return redirect()->route('onboarding.step2');
        }
        
        return $next($request);
    }
}
