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
        return view('pages.dashboard.posts');
    }
}
