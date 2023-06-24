<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Relationship to user
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Relationship to Comments
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    // Relationship to Categories
    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    // Relationship to Tags
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
