<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function index(): View
    {
        return view('pages.settings.index');
    }

    public function indexPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'phone' => 'string',
        ]);

        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $request->user()->update($validated);

        return redirect()->route('settings.index')->with('success', 'Profile updated successfully');
    }

    public function changePassword(): View
    {
        return view('pages.settings.change_password');
    }

    public function changePasswordPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (!Hash::check($validated['current_password'], $request->user()->password)) {
            return redirect()->route('settings.change_password')->with('error', 'The current password is incorrect');
        }

        $request->user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        return redirect()->route('settings.change_password')->with('success', 'Password updated successfully');
    }

    public function changeEmail(): View
    {
        return view('pages.settings.change_email');
    }

    public function changeEmailPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        $request->user()->update($validated);

        return redirect()->route('settings.change_email')->with('success', 'Email updated successfully');
    }

    public function privacySettings(): View
    {
        return view('pages.settings.privacy_settings');
    }

    public function privacySettingsPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'show_email' => 'required|boolean',
            'show_phone' => 'required|boolean',
            'show_location' => 'required|boolean',
            'show_resume' => 'required|boolean',
        ]);

        $request->user()->privacySettings()->update($validated);

        return redirect()->route('settings.privacy_settings')->with('success', 'Privacy settings updated successfully');
    }

    public function changeNotificationSettings(): View
    {
        return view('pages.settings.change_notification_settings');
    }

    public function socialMedia(): View
    {
        return view('pages.settings.change_social_media');
    }

    public function socialMediaPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'portfolio' => 'nullable|string|max:255',
        ]);

        $request->user()->update($validated);

        return redirect()->route('settings.social_media')->with('success', 'Social media settings updated successfully');
    }

    public function changeRole(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'role' => 'required|string|in:job-seeker,job-poster',
        ]);

        $request->user()->update($validated);

        return response()->json(['success' => 'Role updated successfully']);
    }

    public function changeResume(): View
    {
        return view('pages.settings.change_resume');
    }

    public function changeResumePost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Store resume metadata as JSON in the database
        $validated['resume'] = [
            'name' => $request->file('resume')->getClientOriginalName(),
            'path' => $request->file('resume')->store('resumes', 'public'),
            'extension' => $request->file('resume')->extension(),
            'date' => now(),
        ];

        $request->user()->update($validated);

        return redirect()->route('settings.change_resume')->with('success', 'Resume updated successfully');
    }
}
