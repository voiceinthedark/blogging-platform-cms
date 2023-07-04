<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Jetstream\HasProfilePhoto;

class UserProfile extends Model
{
    use HasFactory;
    use HasProfilePhoto;

    protected $fillable = [
        'user_id',
        'profile_photo_path',
        'bio',
        'page_visits_count',
        'username',
        'twitter',
        'facebook',
        'instagram',
        'github',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relationship to user
    public function user() : BelongsTo{
        return $this->belongsTo(User::class);
    }
}
