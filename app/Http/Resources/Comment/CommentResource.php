<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->content,
            'is_approved' => (bool)$this->is_approved,
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'role' => $this->user->role->value,
            ],
            'post' => [
                'post_id' => $this->post->id,
                'post_title' => $this->post->title,
                'created_at' => $this->created_at->format('d.m.Y H:i'),
            ],
        ];
    }
}
