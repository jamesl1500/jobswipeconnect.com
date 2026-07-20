<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function index(): View
    {
        return view('pages.posts.index');
    }

    public function createPost(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'content' => 'required|string',
        ]);

        $request->user()->posts()->create($validated);

        return redirect()->route('dashboard.feed')->with('success', 'Post created successfully');
    }

    public function deletePost(Request $request, int $id): JsonResponse
    {
        $post = $request->user()->posts()->find($id);

        if ($post) {
            $post->delete();
        }

        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function likePost(Request $request, int $id): JsonResponse
    {
        $post = $request->user()->posts()->find($id);

        if ($post->likes()->where('user_id', $request->user()->id)->exists()) {
            return response()->json(['message' => 'Post already liked']);
        }

        if ($post) {
            $post->likes()->create(['user_id' => $request->user()->id], ['post_id' => $post->id]);
        } else {
            return response()->json(['message' => 'Post not found']);
        }

        $likesCount = $post->likes()->count();

        return response()->json(['message' => 'Post liked successfully', 'likes_count' => $likesCount]);
    }

    public function unlikePost(Request $request, int $id): JsonResponse
    {
        $post = $request->user()->posts()->find($id);

        if (!$post->likes()->where('user_id', $request->user()->id)->exists()) {
            return response()->json(['message' => 'Post not liked']);
        }

        if ($post) {
            $post->likes()->where('user_id', $request->user()->id)->delete();
        } else {
            return response()->json(['message' => 'Post not found']);
        }

        $likesCount = $post->likes()->count();

        return response()->json(['message' => 'Post unliked successfully', 'likes_count' => $likesCount]);
    }

    public function commentPost(Request $request, int $id): JsonResponse
    {
        $post = $request->user()->posts()->find($id);

        $validated = $request->validate([
            'comment' => 'required|string',
        ]);

        if ($post) {
            $post->comments()->create([
                'user_id' => $request->user()->id,
                'post_id' => $post->id,
                'comment' => $validated['comment'],
            ]);
        } else {
            return response()->json(['message' => 'Post not found']);
        }

        $commentsCount = $post->comments()->count();

        return response()->json(['message' => 'Post commented successfully', 'comments_count' => $commentsCount, 'post_id' => $post->id]);
    }
}
