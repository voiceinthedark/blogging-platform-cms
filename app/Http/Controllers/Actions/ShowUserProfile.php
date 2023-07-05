<?php

namespace App\Http\Controllers\Actions;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class ShowUserProfile extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($username)
    {
        $userProfile = UserProfile::where('username', $username)->firstOrFail();
        $user = $userProfile->user;
        return view('livewire.profile.showuser', [
            'user' => $user,
        ]);
    }
}
