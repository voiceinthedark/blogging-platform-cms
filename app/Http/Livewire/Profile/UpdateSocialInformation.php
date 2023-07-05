<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UpdateSocialInformation extends Component
{

    use HasAttributes;

    protected $listeners = [
        'saved' => '$refresh',
    ];

    public $username;
    public $bio;
    public $twitter;
    public $facebook;
    public $instagram;
    public $github;

    public User $user;
    // public UserProfile $userProfile;

    public function mount()
    {
        $this->user = User::find(auth()->user()->id);
        $this->username = $this->user->userprofile->username;
        $this->bio = $this->user->userprofile->bio;
        $this->twitter = $this->user->userprofile->twitter;
        $this->facebook = $this->user->userprofile->facebook;
        $this->instagram = $this->user->userprofile->instagram;
        $this->github = $this->user->userprofile->github;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function update(){
        // TODO: uniqueness of username. Validation must only happen when the field has been modified

        $validated = $this->validate();

        $this->user->userProfile->update($validated);

        $this->emitSelf('saved');
    }

    public function rules(){
        $userId = $this->user->id;

        return [
            'username' => [
                'required',
                'min:5',
                'max:15',
                // Rule::unique('user_profiles')->ignore($userId, 'user_id')->when(function () {
                //     // Only apply the uniqueness rule when the 'username' field has been modified
                //     // $modifiedFields = $this->user->getDirty();
                //     // return array_key_exists('username', $modifiedFields);
                //     return $this->user->isDirty('username');
                // }),
            ],
            'bio' => 'nullable|string',
            'twitter' => ['nullable', 'max:25', 'string'],
            'facebook' => ['nullable', 'max:25', 'string'],
            'instagram' => ['nullable', 'max:25', 'string'],
            'github' => ['nullable', 'max:25', 'string'],
        ];
    }


    public function render()
    {
        return view('livewire.profile.update-social-information');
    }
}
