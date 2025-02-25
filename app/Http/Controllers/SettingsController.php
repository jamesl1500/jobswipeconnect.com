<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    /**
     * Index | Settings page
     * -------------------------------------
     * Show the main settings page
     */
    public function index()
    {
        return view('pages.settings.index');
    }

    /**
     * Index Post | Settings page
     * -------------------------------------
     * Process the main settings page
     */
    public function indexPost(Request $request)
    {
        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',   
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|numeric',
            'phone' => 'string',
        ]);

        // If the user uploaded a new profile picture
        if ($request->hasFile('profile_picture')) {
            $validated['profile_picture'] = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        /**
         * Update the user's profile
         * --------------------------
         * Here we update the user's profile with the new data
         */
        $request->user()->update($validated);

        /**
         * Redirect back to the settings page
         */
        return redirect()->route('settings.index')->with('success', 'Profile updated successfully');
    }

    /**
     * Change Password | Profile settings page
     * -------------------------------------
     * Show the change password settings page
     */
    public function changePassword()
    {
        return view('pages.settings.change_password');
    }

    /**
     * Change Password Post | Profile settings page
     * -------------------------------------
     * Process the change password settings page
     */
    public function changePasswordPost(Request $request)
    {
        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        /**
         * Check if the current password is correct
         * ----------------------------------------
         * Here we check if the current password is correct
         */
        if (!\Hash::check($validated['current_password'], $request->user()->password)) {
            return redirect()->route('settings.change_password')->with('error', 'The current password is incorrect');
        }

        /**
         * Update the user's password
         * --------------------------
         * Here we update the user's password with the new data
         */
        $request->user()->update([
            'password' => Hash::make($validated['new_password']),
        ]);

        /**
         * Redirect back to the settings page
         */
        return redirect()->route('settings.change_password')->with('success', 'Password updated successfully');
    }


    /**
     * Change Email | Profile settings page
     * -------------------------------------
     * Show the change email settings page
     */
    public function changeEmail()
    {
        return view('pages.settings.change_email');
    }

    /**
     * Change Email Post | Profile settings page
     * -------------------------------------
     * Process the change email settings page
     */
    public function changeEmailPost(Request $request)
    {
        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'email' => 'required|email|unique:users,email',
        ]);

        /**
         * Update the user's email
         * --------------------------
         * Here we update the user's email with the new data
         */
        $request->user()->update($validated);

        /**
         * Redirect back to the settings page
         */
        return redirect()->route('settings.change_email')->with('success', 'Email updated successfully');
    }

    /**
     * Privacy Settings | Profile settings page
     * -------------------------------------
     * Show the privacy settings page
     */
    public function privacySettings()
    {
        return view('pages.settings.privacy_settings');
    }

    /**
     * Privacy Settings Post | Profile settings page
     * -------------------------------------
     * Process the privacy settings page
     */
    public function privacySettingsPost(Request $request)
    {
        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'show_email' => 'required|boolean',
            'show_phone' => 'required|boolean',
            'show_location' => 'required|boolean',
            'show_resume' => 'required|boolean',
        ]);

        /**
         * Update the user's privacy settings
         * --------------------------
         * Here we update the user's privacy settings with the new data
         */
        $request->user()->privacySettings()->update($validated);

        /**
         * Redirect back to the settings page
         */
        return redirect()->route('settings.privacy_settings')->with('success', 'Privacy settings updated successfully');
    }

    /**
     * Change Notification Settings | Profile settings page
     * -------------------------------------
     * Show the change notification settings page
     */
    public function changeNotificationSettings()
    {
        return view('pages.settings.change_notification_settings');
    }

    /**
     * Chaange social media settings | Profile settings page
     * -------------------------------------
     * Show the change social media settings page
     */
    public function socialMedia()
    {
        return view('pages.settings.change_social_media');
    }

    /**
     * Change social media settings Post | Profile settings page
     * -------------------------------------
     * Process the change social media settings page
     */
    public function socialMediaPost(Request $request)
    {
        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'portfolio' => 'nullable|string|max:255',
        ]);

        /**
         * Update the user's social media settings
         * --------------------------
         * Here we update the user's social media settings with the new data
         */
        $request->user()->update($validated);

        /**
         * Redirect back to the settings page
         */
        return redirect()->route('settings.social_media')->with('success', 'Social media settings updated successfully');
    }

    /**
     * Change role post | Profile settings page
     * -------------------------------------
     * Show the change role settings page
     */
    public function changeRole(Request $request)
    {
        // Validate the form data
        $validated = request()->validate([
            'role' => 'required|string|in:job-seeker,job-poster',
        ]);

        // Update the user's role
        $request->user()->update($validated);

        // Return json response
        return response()->json(['success' => 'Role updated successfully']);
    }

    /** 
     * Change resume
     * -------------------------------------
     * Show the change resume settings page
     */
    public function changeResume()
    {
        return view('pages.settings.change_resume');
    }

    /** 
     * Change resume post
     * -------------------------------------
     * Process the change resume settings page
     */
    public function changeResumePost(Request $request)
    {
        // Validate the form data
        $validated = request()->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        // Save resume name, path, extension, and date as JSON in the database
        $validated['resume'] = [
            'name' => $request->file('resume')->getClientOriginalName(),
            'path' => $request->file('resume')->store('resumes', 'public'),
            'extension' => $request->file('resume')->extension(),
            'date' => now(),
        ];

        // Update the user's resume
        $request->user()->update($validated);

        // Redirect back to the settings page
        return redirect()->route('settings.change_resume')->with('success', 'Resume updated successfully');
    }

}
