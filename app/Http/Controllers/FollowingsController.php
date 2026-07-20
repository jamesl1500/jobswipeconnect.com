<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FollowingsController extends Controller
{
    public function follow(Request $request): RedirectResponse
    {
        if (!User::where('id', $request->user_id)->exists()) {
            return back()->with('error', 'User does not exist.');
        }

        if (Auth::user()->id == $request->user_id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        if (Auth::user()->followings->contains('user_id', $request->user_id)) {
            return back()->with('error', 'You are already following this user.');
        }

        DB::table('followings')->insert([
            'following_id' => $request->user_id,
            'user_id' => Auth::user()->id,
        ]);

        return back()->with('success', 'You are now following this user.');
    }

    public function unfollow(Request $request): RedirectResponse
    {
        if (!User::where('id', $request->user_id)->exists()) {
            return back()->with('error', 'User does not exist.');
        }

        if (Auth::user()->id == $request->user_id) {
            return back()->with('error', 'You cannot follow yourself.');
        }

        if (!Auth::user()->followings->contains('user_id', $request->user_id)) {
            return back()->with('error', 'You are not following this user.');
        }

        DB::table('followings')->where('following_id', $request->user_id)->where('user_id', Auth::user()->id)->delete();

        return back()->with('success', 'You have unfollowed this user');
    }
}
