<?php

namespace App\Actions\Post;

use App\Models\Post;

class PostUpdateAction
{
    public function __construct(Post $post, public PostCreateAction $action)
    {
    }

    public function handle(Post $post, array $data): Post
    {
        $mappedData = $this->action->mappedData($post, $data);

        $mappedData->update();

        return $mappedData;
    }
}
