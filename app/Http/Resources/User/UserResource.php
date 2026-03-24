<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'UserResource',
    description: 'User resource schema',
    properties: [
        new OAT\Property(property: 'id', type: 'integer', example: 1),
        new OAT\Property(property: 'name', type: 'string', example: 'Yuriy'),
        new OAT\Property(property: 'email', type: 'string', format: 'email', example: 'user@example.com'),
        new OAT\Property(property: 'role', ref: '#/components/schemas/UserRole'),
        new OAT\Property(property: 'created_at', type: 'string', example: '2024-03-20 15:30:00'),
        new OAT\Property(property: 'posts', type: 'array', items: new OAT\Items(type: 'object')),
        new OAT\Property(property: 'comments', type: 'array', items: new OAT\Items(type: 'object')),
        new OAT\Property(property: 'pages', type: 'array', items: new OAT\Items(type: 'object')),
    ],
    type: 'object'
)]
class UserResource extends JsonResource
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
            'email' => $this->email,
            'role' => $this->role,
            'created_at' => $this->created_at->toDateTimeString(),
            'posts' => $this->whenLoaded('posts'),
            'comments' => $this->whenLoaded('comments'),
            'pages' => $this->whenLoaded('pages'),
        ];
    }
}
