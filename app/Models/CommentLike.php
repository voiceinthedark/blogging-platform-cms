<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentLike extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_id',
        'user_id',
        'like_status'
    ];

    public function comment(): BelongsTo{
        return $this->belongsTo(Comment::class);
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }
}
