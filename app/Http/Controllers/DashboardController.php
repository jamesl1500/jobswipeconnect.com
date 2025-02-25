<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function jobsFeeds()
    {
        return view('pages.dashboard.jobs');
    }

    public function postsFeed()
    {
        // Get logged in users followings
        $followings = auth()->user()->followings;

        // Get posts from the logged in users followings
        $posts = [];

        foreach ($followings as $following) {
            if (!empty($following->posts)) {
                $posts[] = $following->posts;
            }
        }

        // Add logged in users posts to the posts array
        $posts[] = auth()->user()->posts;

        // Order the posts by created_at date
        $posts = collect($posts)->flatten()->sortByDesc('created_at');

        // Get rid of the empty array at index "0"
        $posts = $posts->values()->all();

        return view('pages.dashboard.feed', ['posts' => $posts]);
    }
}
