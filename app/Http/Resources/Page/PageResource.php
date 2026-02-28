<?php

namespace App\Http\Resources\Page;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

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
