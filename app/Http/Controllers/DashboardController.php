<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function jobsFeeds(): View
    {
        return view('pages.dashboard.jobs');
    }

    public function postsFeed(): View
    {
        $followingIds = auth()->user()->followings()->pluck('following_id');

        $posts = Posts::whereIn('user_id', $followingIds)
            ->orWhere('user_id', auth()->id())
            ->latest()
            ->get();

        $suggestedUsers = User::whereNot('id', auth()->id())
            ->whereNotIn('id', $followingIds)
            ->inRandomOrder()
            ->limit(5)
            ->get();

        return view('pages.dashboard.feed', [
            'posts' => $posts,
            'suggestedUsers' => $suggestedUsers,
        ]);
    }
}
