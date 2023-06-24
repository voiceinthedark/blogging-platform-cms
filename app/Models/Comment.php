<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'body',
        'parent_id',
    ];

    protected $touches = ['post'];

    // Relationship to user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship to post
    public function post(){
        return $this->belongsTo(Post::class);
    }
}
