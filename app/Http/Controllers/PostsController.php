<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    //
    public function index()
    {
        return view('pages.posts.index');
    }

    /**
     * Create Post
     * ---------------------
     * Creates a new post
     */
    public function createPost(Request $request)
    {
        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        /**
         * Create the new post
         * --------------------------
         * Here we create the new post
         */
        $request->user()->posts()->create($validated);

        /**
         * Redirect back to the posts page
         */
        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
}
