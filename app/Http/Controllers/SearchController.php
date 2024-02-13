<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Jobs;
use App\Models\User;
use App\Models\Companies;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        // Initiate variables
        $all_jobs = [];

        // Get the search query
        $query = $request->input('query');

        // If the query is not empty, perform the search
        if (!empty($query)) {
            // Perform search for jobs
            $jobs = Jobs::where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('skills', 'like', '%' . $query . '%')
                ->limit(10)
                ->orderBy('created_at', 'desc')
                ->get()->toArray();

            // Perform search for users
            $users = User::where('name', 'like', '%' . $query . '%')
                ->orWhere('username', 'like', '%' . $query . '%')
                ->orWhere('cover_letter', 'like', '%' . $query . '%')
                ->orWhere('skills', 'like', '%' . $query . '%')
                // Limit to 5
                ->limit(5)
                ->get();

            // Perform search for companies
            $companies = Companies::where('name', 'like', '%' . $query . '%')
                ->limit(5)
                ->get();

            // Foreach company get the jobs
            foreach ($companies as $company) {
                $all_jobs[] = Jobs::where('company_id', $company->id)->get()->toArray();
            }

            // Merge jobs into all_jobs
            $all_jobs[] = $jobs;

            // Return the search results
            return view('pages.search.index', [
                'query' => $query,
                'jobs' => $all_jobs,
                'users' => $users,
                'companies' => $companies,
            ]);
        }

        // If the query is empty, return an empty response
        return view('pages.search.index', [
            'query' => '',
        ]);
    }

    /**
     * Search for jobs
     * ----------------
     * 
     */
    public function jobs(Request $request)
    {
        // Get the search query
        $query = $request->input('query');

        // If the query is not empty, perform the search
        if (!empty($query)) {
            // Perform search for jobs
            $jobs = Jobs::where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('skills', 'like', '%' . $query . '%')
                ->limit(10)
                ->orderBy('created_at', 'desc')
                ->get();

            // Return the search results
            return view('pages.search.jobs', [
                'query' => $query,
                'jobs' => $jobs,
            ]);
        }

        // If the query is empty, return an empty response
        return view('pages.search.jobs', [
            'query' => '',
        ]);
    }
}
