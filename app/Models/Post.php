<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Hash;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'content',
        'excerpt',
        'slug',
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

    public function likes(): HasMany{
        return $this->hasMany(PostLike::class);
    }

    public function likesCount(){
        return $this->likes()->where('like_status',1)->count();
    }

    public function dislikesCount(){
        return $this->likes()->where('like_status', -1)->count();
    }
}
