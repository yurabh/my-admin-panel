<?php

namespace App\Http\Resources\Category;

use App\Http\Resources\Post\PostResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'CategoryResource',
    description: 'Category resource with posts and statistics',
    properties: [
        new OAT\Property(property: 'id', type: 'integer', example: 1),
        new OAT\Property(property: 'name', type: 'string', example: 'Technology'),
        new OAT\Property(property: 'slug', type: 'string', example: 'technology'),
        new OAT\Property(
            property: 'posts',
            description: 'List of posts in this category (included when loaded)',
            type: 'array',
            items: new OAT\Items(ref: '#/components/schemas/PostResource')
        ),
        new OAT\Property(property: 'posts_count', description: 'Total number of posts', type: 'integer', example: 5),
        new OAT\Property(property: 'created_at', type: 'string', example: '16.03.2024'),
    ],
    type: 'object'
)]
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
