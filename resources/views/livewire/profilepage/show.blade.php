<div class="grid grid-cols-3 break-after-avoid-page my-3 mx-3 h-screen">
    <div class="flex flex-col justify-start items-start mx-6">
        <img class="object-cover rounded-full w-[250px] h-[250px]"
            src="{{ url($user->userprofile->profile_photo_url) }}" />
        <div class="text-2xl">{{ $user->name }}</div>
        <div class="flex flex-row items-center mb-5">
            <span class="text-lg">{{ '@' . $user->userprofile->username }}</span>

            @auth
                <button type="button" wire:click="follow({{ auth()->user()->id }},  {{ $user->id }})"
                    class="ml-2 font-semibold bg-emerald-600 text-white py-2 px-4 rounded-lg hover:bg-emerald-700 transition-colors">{{ auth()->user()->following->find($user->id)? 'Unfollow': 'Follow' }}</button>
            @endauth
        </div>
        <!-- Followers listing -->
        <div class="flex flex-row items-center mb-2">
            <span data-popover-target="popover-followers" class="font-light text-gray-700 mr-2">{{ $user->followers->count() }} followers</span>
            <span class="font-extralight text-gray-700">|</span>
            <span data-popover-target="popover-following" class="font-light text-gray-700 ml-2">{{ $user->following->count() }} following</span>
        </div>
        <!-- Follower popover -->
        <div data-popover id="popover-followers" role="tooltip"
            class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
            <div
                class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $user->name }} followers</h3>
            </div>
            <div class="px-3 py-2">
                <ul>
                    @forelse ($user->followers as $follower)
                        <li>{{ $follower->name }}</li>
                    @empty
                        <p>No followers</p>
                    @endforelse
                </ul>
            </div>
            <div data-popper-arrow></div>
        </div>

        <!-- following popover -->
        <div data-popover id="popover-following" role="tooltip"
            class="absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
            <div
                class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                <h3 class="font-semibold text-gray-900 dark:text-white">{{ $user->name }} is following</h3>
            </div>
            <div class="px-3 py-2">
                <ul>
                    @forelse ($user->following as $followed)
                        <li>{{ $followed->name }}</li>
                    @empty
                        <p>Not following anyone</p>
                    @endforelse
                </ul>
            </div>
            <div data-popper-arrow></div>
        </div>


        <div class="flex items-center">
            <img src="{{ asset('storage/logo/icons8-twitter.svg') }}" class="h-8 w-8" alt="twitter-icon" />
            <a href="https://twitter.com/{{ $user->userProfile->twitter }}"><span
                    class="text-lg text-sky-700">{{ '@' . $user->userProfile->twitter }}</span></a>
        </div>
        <div class="flex items-center">
            <img class="h-8 w-8" src="{{ asset('storage/logo/icons8-instagram.svg') }}" alt="instagram-icon" />
            <a href="https://instagram.com/{{ $user->userProfile->instagram }}"><span
                    class="text-lg text-sky-700">{{ '@' . $user->userProfile->instagram }}</span></a>
        </div>
        <div class="flex items-center">
            <img class="h-8 w-8" src="{{ asset('storage/logo/icons8-facebook.svg') }}" alt="facebook-icon" />
            <a href="https://facebook.com/{{ $user->userProfile->facebook }}"><span
                    class="text-lg text-sky-700">{{ '@' . $user->userProfile->facebook }}</span></a>
        </div>
        <div class="flex items-center">
            <img class="h-8 w-8" src="{{ asset('storage/logo/icons8-github.svg') }}" alt="github-icon" />
            <a href="https://github.com/{{ $user->userProfile->github }}"><span
                    class="text-lg text-sky-700">{{ '@' . $user->userProfile->github }}</span></a>
        </div>
        <div class="text-lg mt-5 p-4 shadow-sm rounded-sm border border-dashed border-gray-400 bg-gray-100">
            {{ $user->userProfile->bio }}
        </div>
        <!-- User QR Code -->
        <div class="mt-4 mb-2 pb-5">
            {!! QrCode::eye('circle')->size(125)->generate($user->email) !!}
        </div>
    </div>
    <div class="flex flex-col justify-start items-center mx-4 mt-20">
        <span
            class="text-2xl font-semibold mb-5">{{ $user->name . ' has ' . $user->posts->count() . ' articles' }}</span>
        <livewire:profilepage.show-user-articles :user="$user" :posts="$user->posts" />
    </div>
</div>
<div class="flex flex-col justify-start items-center mt-20">
    <span
        class="text-2xl font-semibold mb-5">{{ $user->name . ' has ' . $user->comments->count() . ' comments' }}</span>
    <livewire:profilepage.show-user-comments :user="$user" />
</div>
