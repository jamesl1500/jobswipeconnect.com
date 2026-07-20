<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OnboardingMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response|RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse
    {
        if (! $request->user()->hasVerifiedEmail()) {
            return redirect()->route('verification.notice');
        }

        if (! $request->user()->hasCompletedOnboardingStep1()) {
            return redirect()->route('onboarding.step1');
        }

        if ($request->user()->role === 'job-seeker' && ! $request->user()->hasCompletedOnboardingStep2()) {
            return redirect()->route('onboarding.step2');
        }

        return $next($request);
    }
}
