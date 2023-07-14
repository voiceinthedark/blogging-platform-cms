<div>
    @foreach ($user->followers as $follower)
        <div class="grid grid-cols-2 p-2 bg-white shadow-sm ">
            <div class="flex flex-row align-middle">
                <x-avatar lg src="{{ $follower->userprofile->profile_photo_url }}" />
                    <div class="flex flex-col items-start justify-center">
                        <span class="font-bold">{{ $follower->name }}</span>
                        <span class="text-gray-700">{{'@'.$follower->userprofile->username }}</span>
                    </div>
                </div>
            <div class="flex flex-row items-center">
                <span class="font-light text-gray-700">{{ $follower->following->count() }} following</span>
                <span>|</span>
                <span class="font-light text-gray-700">{{ $follower->followers->count()}} followers</span>
            </div>
        </div>
    @endforeach
</div>
