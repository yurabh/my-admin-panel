<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

/**
 * @property mixed $created_at
 * @property mixed $updated_at
 * @property mixed $image
 * @property mixed $is_published
 * @property mixed $content
 * @property mixed $slug
 * @property mixed $title
 * @property mixed $id
 * @property mixed $user_id
 * @property mixed $image_url
 */
#[OAT\Schema(
    schema: 'PageResource',
    description: 'Page resource schema for API response',
    properties: [
        new OAT\Property(property: 'id', type: 'integer', example: 1),
        new OAT\Property(property: 'title', type: 'string', example: 'About Us'),
        new OAT\Property(property: 'slug', type: 'string', example: 'about-us'),
        new OAT\Property(property: 'content', type: 'string', example: 'Page content goes here...'),
        new OAT\Property(property: 'is_published', type: 'boolean', example: true),
        new OAT\Property(property: 'user_id', type: 'integer', example: 1),
        new OAT\Property(property: 'image', description: 'Internal path to the image', type: 'string', example: 'pages/image.jpg', nullable: true),
        new OAT\Property(property: 'image_url', description: 'Full URL to the image on S3', type: 'string', format: 'uri', example: 'https://amazon.com', nullable: true),
    ],
    type: 'object'
)]
class PageResource extends JsonResource
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
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'user_id' => $this->user_id,
            'image' => $this->image,
            'image_url' => $this->image_url,
        ];
    }
}
