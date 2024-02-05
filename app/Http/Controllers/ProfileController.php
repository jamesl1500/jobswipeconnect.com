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

        return view('pages.profile.profile', [
            'user' => $user,
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
}
