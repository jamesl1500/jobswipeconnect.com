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

        return view('pages.profile', [
            'user' => $user
        ]);
    }
}
