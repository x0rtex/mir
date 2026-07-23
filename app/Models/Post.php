<?php

namespace App\Models;

use Database\Factories\PostFactory;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Attributes\Appends;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

#[Appends(['body_html'])]
#[Fillable(['title', 'slug', 'body', 'excerpt', 'published_at', 'user_id'])]
class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('M j, Y');
    }

    protected function bodyHtml(): Attribute
    {
        return Attribute::make(
            get: fn () => Str::markdown($this->body),
        );
    }

    /** @return BelongsTo<User, $this> */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** @return HasMany<Comment, $this> */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }
}
