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
            'title' => 'string|max:255',
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
        return redirect()->route('dashboard.feed')->with('success', 'Post created successfully');
    }

    /**
     * Delete Post
     * ---------------------
     * Deletes a post
     */
    public function deletePost(Request $request, $id)
    {
        /**
         * Find the post
         */
        $post = $request->user()->posts()->find($id);

        /**
         * If the post exists, delete it
         */
        if ($post) {
            $post->delete();
        }

        // Return json response
        return response()->json(['message' => 'Post deleted successfully']);
    }

    /**
     * Like Post
     * ---------------------
     * Likes a post
     */
    public function likePost(Request $request, $id)
    {
        /**
         * Find the post
         */
        $post = $request->user()->posts()->find($id);

        /**
         * Check if the user has already liked the post
         */
        if ($post->likes()->where('user_id', $request->user()->id)->exists()) {
            return response()->json(['message' => 'Post already liked']);
        }

        /**
         * If the post exists, like it
         */
        if ($post) {
            $post->likes()->create(['user_id' => $request->user()->id], ['post_id' => $post->id]);
        }else{
            return response()->json(['message' => 'Post not found']);
        }

        // Get the post likes count
        $likesCount = $post->likes()->count();

        // Return json response
        return response()->json(['message' => 'Post liked successfully', 'likes_count' => $likesCount]);
    }

    /**
     * Unlike Post
     * ---------------------
     * Unlikes a post
     */
    public function unlikePost(Request $request, $id)
    {
        /**
         * Find the post
         */
        $post = $request->user()->posts()->find($id);

        /**
         * Check if the user has already liked the post
         */
        if (!$post->likes()->where('user_id', $request->user()->id)->exists()) {
            return response()->json(['message' => 'Post not liked']);
        }

        /**
         * If the post exists, unlike it
         */
        if ($post) {
            $post->likes()->where('user_id', $request->user()->id)->delete();
        }else{
            return response()->json(['message' => 'Post not found']);
        }

        // Get the post likes count
        $likesCount = $post->likes()->count();

        // Return json response
        return response()->json(['message' => 'Post unliked successfully', 'likes_count' => $likesCount]);
    }

    /**
     * Comment Post
     * ---------------------
     * Comments on a post
     */
    public function commentPost(Request $request, $id)
    {
        /**
         * Find the post
         */
        $post = $request->user()->posts()->find($id);

        /**
         * Form validation
         * ----------------
         * Here we validate the form data
         */
        $validated = request()->validate([
            'comment' => 'required|string',
        ]);

        /**
         * If the post exists, comment on it
         */
        if ($post) {
            $post->comments()->create([
                'user_id' => $request->user()->id,
                'post_id' => $post->id,
                'comment' => $validated['comment'],
            ]);
        }else{
            return response()->json(['message' => 'Post not found']);
        }

        // Get the post comments count
        $commentsCount = $post->comments()->count();

        // Return json response
        return response()->json(['message' => 'Post commented successfully', 'comments_count' => $commentsCount, 'post_id' => $post->id]);
    }
}
