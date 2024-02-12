<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function index(Request $request)
    {
        // Get the search query
        $query = $request->input('query');

        // If the query is empty, return an empty response
        return view('pages.search.index', [
            'query' => $query,
        ]);
    }
}
