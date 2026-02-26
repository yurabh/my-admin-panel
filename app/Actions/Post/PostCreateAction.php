<?php

namespace App\Actions\Post;

use App\Events\PostCreatedEvent;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Str;

class PostCreateAction
{
    public function __construct()
    {
    }

    public function handle(array $data): PostResource
    {
        $data['user_id'] = auth()->id();
        $data['slug'] = Str::slug($data['title']);
        $data['published_at'] = $data['is_published'] ? now() : null;
        $post = Post::query()->create($data);
        $post->tags()->sync($data['tags'] ?? []);
        PostCreatedEvent::dispatch($post);
        return $post;
    }
}
