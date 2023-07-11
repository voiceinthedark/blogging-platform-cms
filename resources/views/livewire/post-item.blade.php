<div class="flex flex-col justify-center min-w-[1200px] py-8 px-4 mx-auto w-9/12 max-w-screen-xl lg:py-10"
    x-data="{ showPopover: false, }">
    <div class="p-8 mb-8 border border-gray-200 rounded-lg bg-gray-50 md:p-12">

        <!-- Tags list -->
        <div class="flex flex-row">
            @foreach ($post->tags as $tag)
                <a href="#"
                    class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                    <x-icons.tag :name="$tag->slug" class="w-6 h-6 mx-2" />
                    {{ $tag->slug }}
                </a>
            @endforeach
        </div>
        <!-- Post title -->
        <h1 class="mb-2 text-3xl font-extrabold text-gray-900 md:text-5xl">{{ $post->title }}</h1>
        <!-- Post excerpt -->
        <p class="mb-6 text-lg font-normal text-gray-500">
            {{ $post->excerpt }}
        </p>
        <div class="flex flex-row justify-between">
            <div>
                <a href="{{ route('posts.show', $post->slug) }}"
                    class="inline-flex justify-center items-center py-2.5 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 ">
                    Read more
                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <!-- Edit if user is logged in-->
                @if (Auth::check())
                    @if ($post->user_id == Auth::user()->id)
                        <a href="{{ route('posts.edit', $post->id) }}"
                            class="inline-flex justify-center items-center py-2.5 px-5 text-base font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 ">
                            Edit Post
                            <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </a>
                    @endif
                @endif

            </div>
            <!-- Author -->
            <div class="flex flex-col">
                <a href="{{ route('profilepage.show', $post->user->userprofile->username) }}" class="text-indigo-500">
                    <span x-on:mouseover="showPopover = true"
                        x-on:click.outside="showPopover = false">{{ $post->user->name }}</span>
                </a>
                <span class="text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>

    @auth

    <!-- Author popover -->
    <div class="relative" id="post-{{ $post->id }}" key="post-{{ $post->id }}">
        <div id="popover-user-profile" role="tooltip" x-show="showPopover"
            class="absolute right-0 z-10 w-64 text-sm text-gray-500 duration-300 bg-white border border-gray-200 rounded-lg shadow-sm bottom-32 dark:text-gray-400 dark:bg-gray-800 dark:border-gray-600">
            <div class="p-3">
                <div class="flex items-center justify-between mb-2">
                    <a href="#">
                        <x-avatar size="w-10 h-10" src="{{ $post->user->userprofile->profile_photo_url }}" />
                    </a>
                    <div>
                        <button type="button"
                            wire:click.stop="$emitUp('follow', {{ auth()->user()->id }}, {{ $post->user->id }})"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-xs px-3 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">{{ auth()->user()->following->find($post->user->id)? 'Unfollow': 'Follow' }}</button>
                    </div>
                </div>
                <p class="text-base font-semibold leading-none text-gray-900 dark:text-white">
                    <a href="#">{{ $post->user->name }}</a>
                </p>
                <p class="mb-3 text-sm font-normal">
                    <a href="#" class="hover:underline">{{ '@' . $post->user->userprofile->username }}</a>
                </p>
                {{-- <p class="mb-4 text-sm">{{ $post->user->bio }}</p> --}}
                <ul class="flex text-sm">
                    <li class="mr-2">
                        <a href="#" class="hover:underline">
                            <span
                                class="font-semibold text-gray-900 dark:text-white">{{ $post->user->following->count() }}</span>
                            <span>Following</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:underline">
                            <span
                                class="font-semibold text-gray-900 dark:text-white">{{ $post->user->followers->count() }}</span>
                            <span>Followers</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @endauth

</div>
