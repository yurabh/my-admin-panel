<?php

namespace App\Http\Resources\Setting;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: 'SettingResource',
    description: 'System setting resource schema',
    properties: [
        new OAT\Property(property: 'id', type: 'integer', example: 1),
        new OAT\Property(property: 'key', type: 'string', example: 'site_name'),
        new OAT\Property(property: 'value', type: 'string', example: 'My Awesome Admin'),
        new OAT\Property(property: 'updated_at', type: 'string', example: '2024-03-20 15:30:00'),
    ],
    type: 'object'
)]
class SettingResource extends JsonResource
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
            'key' => $this->key,
            'value' => $this->value,
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
