<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Query\Builder;
use OpenApi\Attributes as OAT;


#[OAT\Schema(
    schema: 'PostResource',
    description: 'Post model schema',
    properties: [
        new OAT\Property(property: 'id', type: 'integer', readOnly: true, example: 1),
        new OAT\Property(property: 'user_id', type: 'integer', example: 1),
        new OAT\Property(property: 'category_id', type: 'integer', example: 5, nullable: true),
        new OAT\Property(property: 'title', type: 'string', example: 'My Awesome Post Title'),
        new OAT\Property(property: 'slug', type: 'string', example: 'my-awesome-post-title'),
        new OAT\Property(property: 'content', type: 'string', example: 'Full content of the article goes here...'),
        new OAT\Property(property: 'is_published', type: 'boolean', example: true),
        new OAT\Property(property: 'published_at', type: 'string', format: 'date-time', example: '2024-03-20T15:30:00Z', nullable: true),
        new OAT\Property(property: 'created_at', type: 'string', format: 'date-time', readOnly: true),
        new OAT\Property(property: 'updated_at', type: 'string', format: 'date-time', readOnly: true),
    ],
    type: 'object'
)]
/**
 * @property mixed $user
 * @method static factory()
 */
class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'is_published',
        'published_at',
        'category_id',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }
}
