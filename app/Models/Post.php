<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'title',
        'user_id',
        'content',
        'excerpt',
        'slug',
        'word_count',
        'minutes',
    ];

    // Relationship to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to Comments
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    // Relationship to Categories
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    // Relationship to Tags
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    // Relationship tp Post_likes

    public function likes(): HasMany
    {
        return $this->hasMany(PostLike::class);
    }

    /**
     * Returns the count of likes with a like status of 1.
     *
     * @return int The count of likes.
     */
    public function likesCount()
    {
        // Use the likes() method to get the likes relationship and filter it by like status of 1.
        // Then, use the count() method to get the count of likes.
        return $this->likes()->where('like_status', 1)->count();
    }

    public function dislikesCount()
    {
        return $this->likes()->where('like_status', -1)->count();
    }

    /**
     * Get the positive likes associated with the post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function positiveLikes(): HasMany
    {
        // Retrieve the post likes that have a like_status of 1
        return $this->hasMany(PostLike::class)->where('like_status', 1);
    }

    /**
     * Get the negative likes for this post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function negativeLikes(): HasMany
    {
        // Return the PostLike records where the like status is -1.
        return $this->hasMany(PostLike::class)->where('like_status', -1);
    }

    public function searchableAs() : string{
        return 'posts_index';
    }
}
