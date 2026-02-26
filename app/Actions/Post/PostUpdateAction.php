<?php

namespace App\Actions\Post;

use App\Models\Post;
use Illuminate\Support\Str;

class PostUpdateAction
{
    public function __construct(Post $post)
    {
    }

    public function handle(string $id, array $data): Post
    {
        $post = Post::query()->find($id);
        $data['slug'] = Str::slug($data['title']);
        $data['published_at'] = !empty($data['is_published']) ? now() : null;
        $post->update($data);
        if (isset($data['tags'])) {
            $post->tags()->sync($data['tags']);
        } else {
            $post->tags()->sync([]);
        }

        return $post;
    }
}
