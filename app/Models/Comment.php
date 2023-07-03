<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'parent_id',
        'is_approved',
    ];

    // A comment added will update the parent post updated_at field
    protected $touches = ['post'];

    // Relationship to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Relationship to post
    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    // May have many replies
    public function replies() : HasMany{
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Comment::class, 'parent_id', 'id');
    }

    // Defining a local scope to filter comments based on their parent
    public function scopeRootComments($query){
        return $query->whereNull('parent_id');
    }

}
