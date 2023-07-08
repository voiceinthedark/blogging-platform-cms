<div class="grid grid-cols-3 break-after-avoid-page my-3 mx-3 h-screen">
    <div class="flex flex-col justify-start items-start mx-6">
        <img class="object-cover rounded-full w-[250px] h-[250px]" src="{{ url($user->userprofile->profile_photo_url) }}" />
        <div class="text-2xl">{{ $user->name }}</div>
        <div class="text-lg mb-5">{{ '@' . $user->userprofile->username }}</div>
        <div class="flex items-center">
            <img src="{{ asset('storage/logo/icons8-twitter.svg') }}" class="h-8 w-8" alt="twitter-icon" />
            <a href="https://twitter.com/{{ $user->userProfile->twitter }}"><span class="text-lg text-sky-700">{{ '@' . $user->userProfile->twitter }}</span></a>
        </div>
        <div class="flex items-center">
            <img class="h-8 w-8" src="{{ asset('storage/logo/icons8-instagram.svg') }}" alt="instagram-icon" />
            <a href="https://instagram.com/{{ $user->userProfile->instagram }}"><span class="text-lg text-sky-700">{{ '@' . $user->userProfile->instagram }}</span></a>
        </div>
        <div class="flex items-center">
            <img class="h-8 w-8" src="{{ asset('storage/logo/icons8-facebook.svg') }}" alt="facebook-icon" />
            <a href="https://facebook.com/{{ $user->userProfile->facebook }}"><span class="text-lg text-sky-700">{{ '@' . $user->userProfile->facebook }}</span></a>
        </div>
        <div class="flex items-center">
            <img class="h-8 w-8" src="{{ asset('storage/logo/icons8-github.svg') }}" alt="github-icon" />
            <a href="https://github.com/{{ $user->userProfile->github }}"><span class="text-lg text-sky-700">{{ '@' . $user->userProfile->github }}</span></a>
        </div>
        <div class="text-lg mt-5 p-4 shadow-sm rounded-sm border border-dashed border-gray-400 bg-gray-100">
            {{ $user->userProfile->bio }}
        </div>
        <!-- User QR Code -->
        <div class="mt-4">
            {!! QrCode::generate(
                $user->email
                ) !!}
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

