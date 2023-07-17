<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasProfilePhoto;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    // Current user liked a post?
    public function liked(Post|Comment $post): bool{
        // check typeof $post
        if(typeOf($post) === Post::class){
            return PostLike::where('user_id', $this->id)->where('post_id', $post->id)->exists();
        } else{
            return CommentLike::where('user_id', $this->id)->where('comment_id', $post->id)->exists();
        }
    }


    // Relationship to user profile
    public function userProfile(): HasOne{
        return $this->hasOne(UserProfile::class);
    }

    // Relationship to posts
    public function posts() : HasMany{
        return $this->hasMany(Post::class);
    }

    // Relationship to comments
    public function comments() : HasMany{
        return $this->hasMany(Comment::class);
    }

    // Relationship to roles
    public function roles() : BelongsToMany{
        return $this->belongsToMany(Role::class)
            ->withTimestamps();
    }

    // Latest post
    public function latestPost(): HasOne{
        return $this->hasOne(Post::class)->latestOfMany();
    }

    // Oldest Post
    public function oldestPost(): HasOne{
        return $this->hasOne(Post::class)->oldestOfMany();
    }

    // Latest comments
    public function latestComments(): HasOne{
        return $this->hasOne(Comment::class)->latestOfMany();
    }

    public function likes(): HasMany{
        return $this->hasMany(PostLike::class);
    }

    // likes comments
    public function likesComments(): HasMany{
        return $this->hasMany(CommentLike::class);
    }

    // *Following System
    public function followers(): BelongsToMany{
        return $this->belongsToMany(User::class, 'user_followers', 'followed_id', 'follower_id');
    }

    public function following(): BelongsToMany{
        return $this->belongsToMany(User::class, 'user_followers', 'follower_id', 'followed_id');
    }

    public function received_messages(): HasMany{
        return $this->hasMany(Message::class, 'recipient_id', 'id');
    }

    public function sent_messages(): HasMany{
        return $this->hasMany(Message::class, 'sender_id', 'id');
    }
}
