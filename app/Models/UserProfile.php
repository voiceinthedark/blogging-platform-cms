<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Jetstream\HasProfilePhoto;

class UserProfile extends Model
{
    use HasFactory;
    use HasProfilePhoto;

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // Relationship to user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
