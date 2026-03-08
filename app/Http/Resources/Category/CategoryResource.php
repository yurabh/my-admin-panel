<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'posts' => PostResource::collection($this->whenLoaded('posts')),
            'posts_count' => $this->whenCounted('posts'),
            'created_at' => $this->created_at->format('d.m.Y'),
        ];
    }
}
