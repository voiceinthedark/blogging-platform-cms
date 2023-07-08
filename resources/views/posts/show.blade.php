<x-guest-layout>
    @include('navigation-menu-guest')

    <div class="w-full flex flex-col justify-center items-center">
        <div
            class="flex flex-col w-[80%] mx-auto justify-center items-center bg-white mt-4 px-5 py-4 shadow-lg shadow-gray-300">
            <div class="mb-10 tracking-tighter text-5xl text-center font-bold mt-8 w-96">{{ $post->title }}</div>
            <div class="flex flex-row justify-between">
                <div class="w-6/12 mr-2">
                    @foreach ($post->tags as $tag)
                        <a href="#"
                            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                            <x-icons.tag :name="$tag->slug" class="w-6 h-6 mx-2" />
                            {{ $tag->slug }}
                        </a>
                    @endforeach
                </div>
                <div class="w-6/12 ml-2">
                    @foreach ($post->categories as $category)
                        <a href="#"
                            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                            #{{ $category->slug }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="flex mt-8 w-full justify-evenly">
                <a href="{{ route('profilepage.show', $post->user->userprofile->username) }}"><span
                        class="font-bold text-lg text-gray-600 hover:underline ">{{ $post->user->name }}</span></a>
                <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex w-full justify-center items-center">
                <span class="text-sm mx-2 text-gray-500">{{ $post->word_count }} words</span>
                <span class="text-gray-500">|</span>
                <span class="text-sm mx-2 text-gray-500">{{ $post->minutes }} mins read</span>
                <span class="text-gray-500">|</span>
                <div class="flex flex-row items-center">
                    <span class="text-sm mx-2 text-gray-500">{{ $post->views }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-gray-500">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>

                </div>
            </div>
            <div class="flex flex-col mt-9 pb-6">
                <article
                    class="prose lg:prose-xl indent-8 prose-headings:underline prose-a:text-blue-600 hover:prose-a:text-blue-400 first-letter:text-7xl first-letter:font-bold first-letter:float-left first-letter:mr-3 first-line:uppercase">
                    {!! $post->content !!}</article>
            </div>
            <!-- Likes and Dislikes section -->
            <div class="mt-8 self-end">
                <livewire:post.like-form :post="$post" />
            </div>
            <x-section-border />
            <!-- About the Author and QR code section -->
            <div class="flex flex-row justify-evenly items-center">
                <div class="grid grid-cols-2 mt-8 gap-1 w-[35%] self-start">
                    <div class="row-span-2">
                        <x-avatar size="w-36 h-36" src="{{  $post->user->userprofile->profile_path_url }}" />
                    </div>
                    <div>
                        <span class="font-bold text-2xl">{{ $post->user->name }}</span>
                        <span class="block text-sm text-gray-500">{{ $post->user->email }}</span>
                    </div>
                    <div>
                        <span>{{ Str::words($post->user->userProfile->bio, 10) }}</span>
                    </div>
                </div>
                <!-- Page QR Code -->
                <div class="justify-self-end">
                    {!! QrCode::generate(Request::url('/posts/' . $post->slug )) !!}
                </div>
            </div>

        </div>
        <!-- Comments section -->
        <div class="mt-8 bg-white shadow rounded px-4 py-4 w-[50%]">
            <div class="flex justify-between">
                <span class="font-bold text-2xl">Comments</span>
                <span class="font-semibold">{{ $post->comments->count() }} comments</span>
            </div>
            <x-section-border />
            <livewire:comments.show-comments :comments="$comments" :post="$post" />
        </div>
    </div>

</x-guest-layout>
