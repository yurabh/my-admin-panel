<?php

namespace App\Http\Controllers;

use App\Actions\Post\PostCreateAction;
use App\Actions\Post\PostUpdateAction;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with(['tags', 'category', 'user'])->get();

        return PostResource::collection($posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, PostCreateAction $action)
    {
        $data = $request->validated();

        $postResource = $action->handle($data);

        return PostResource::make($postResource);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $post = Post::with(['tags', 'category', 'user'])->findOrFail($id);
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $post = Post::with('tags', 'category')
            ->findOrFail($id);

        return view('admin.posts.edit', [
            'posts' => $post,
            'categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, PostUpdateAction $action, string $id)
    {
        $data = $request->validated();

        $updatedPost = $action->handle($id, $data);

        return PostResource::make($updatedPost);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::query()->find($id);

        if (!$post) {
            return response()->json([
                'message' => "Post with id {$id} not found"
            ], 404);
        }

        $post->delete();

        return response()->json([
            'message' => 'Post deleted successfully',
            'post_id' => $id
        ]);
    }
}
