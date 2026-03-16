<?php

namespace App\Http\Resources\Tag;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'TagResource',
    description: 'Tag resource schema',
    properties: [
        new OAT\Property(property: 'id', type: 'integer', example: 1),
        new OAT\Property(property: 'name', type: 'string', example: 'Laravel'),
        new OAT\Property(property: 'slug', type: 'string', example: 'laravel'),
        new OAT\Property(property: 'description', type: 'string', example: 'All posts about Laravel framework', nullable: true),
        new OAT\Property(property: 'is_active', type: 'boolean', example: true),
        new OAT\Property(
            property: 'posts_count',
            description: 'Total number of posts associated with this tag (only if counted)',
            type: 'integer',
            example: 12,
            nullable: true
        ),
    ],
    type: 'object'
)]
class TagResource extends JsonResource
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
            'description' => $this->description,
            'is_active' => $this->is_active,
            'posts_count' => $this->whenCounted('posts'),
        ];
    }
}
