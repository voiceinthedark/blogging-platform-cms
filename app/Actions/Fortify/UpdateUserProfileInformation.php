<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        $userProfile = $user->userProfile;

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'bio' => ['nullable', 'string'],
            'twitter' => ['nullable', 'string'],
            'facebook' => ['nullable', 'string'],
            'instagram' => ['nullable', 'string'],
            'github' => ['nullable', 'string'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $userProfile->updateProfilePhoto($input['photo']);
        }
        // Update the Bio
        if(isset($input['bio'])) {
            $user->userProfile->update(['bio' => $input['bio']]);
        }

        // Update the username
        if(isset($input['username'])) {
            $user->userProfile->update(['username' => $input['username']]);
        }

        // Update the social media handles
        if(isset($input['twitter'])) {
            $user->userProfile->update(['twitter' => $input['twitter']]);
        }
        if(isset($input['facebook'])) {
            $user->userProfile->update(['facebook' => $input['facebook']]);
        }
        if(isset($input['instagram'])) {
            $user->userProfile->update(['instagram' => $input['instagram']]);
        }
        if(isset($input['github'])) {
            $user->userProfile->update(['github' => $input['github']]);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
