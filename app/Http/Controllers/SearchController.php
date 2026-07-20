<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Jobs;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request): View
    {
        $all_jobs = [];

        $query = $request->input('query');

        if (empty($query)) {
            return view('pages.search.index', [
                'query' => '',
            ]);
        }

        $jobs = Jobs::where('title', 'like', '%' . $query . '%')
            ->orWhere('description', 'like', '%' . $query . '%')
            ->orWhere('skills', 'like', '%' . $query . '%')
            ->limit(10)
            ->orderBy('created_at', 'desc')
            ->get()->toArray();

        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('username', 'like', '%' . $query . '%')
            ->orWhere('cover_letter', 'like', '%' . $query . '%')
            ->orWhere('skills', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        $companies = Companies::where('name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get();

        // Include jobs from each matching company
        foreach ($companies as $company) {
            $all_jobs[] = Jobs::where('company_id', $company->id)->get()->toArray();
        }

        $all_jobs[] = $jobs;

        return view('pages.search.index', [
            'query' => $query,
            'jobs' => $all_jobs,
            'users' => $users,
            'companies' => $companies,
        ]);
    }

    public function jobs(Request $request): View
    {
        $query = $request->input('query');

        $employment_location_type = $request->input('employment_location_type');
        $experience_level = $request->input('experience_level');

        if (empty($query)) {
            return view('pages.search.jobs', [
                'query' => '',
            ]);
        }

        if ($employment_location_type) {
            $jobs = Jobs::where('employment_location_type', $employment_location_type)
                ->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('skills', 'like', '%' . $query . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        } elseif ($experience_level) {
            $jobs = Jobs::where('experience_level', $experience_level)
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('skills', 'like', '%' . $query . '%')
                ->where('title', 'like', '%' . $query . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        } else {
            $jobs = Jobs::where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->orWhere('skills', 'like', '%' . $query . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(5);
        }

        return view('pages.search.jobs', [
            'query' => $query,
            'jobs' => $jobs,
        ]);
    }

    public function users(Request $request): View
    {
        $query = $request->input('query');

        if (empty($query)) {
            return view('pages.search.users', [
                'query' => '',
            ]);
        }

        $users = User::where('name', 'like', '%' . $query . '%')
            ->orWhere('username', 'like', '%' . $query . '%')
            ->orWhere('cover_letter', 'like', '%' . $query . '%')
            ->orWhere('skills', 'like', '%' . $query . '%')
            ->paginate(5);

        return view('pages.search.users', [
            'query' => $query,
            'users' => $users,
        ]);
    }
}
