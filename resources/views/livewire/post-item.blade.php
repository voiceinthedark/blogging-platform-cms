<div class="flex flex-col justify-center min-w-[1200px] py-8 px-4 mx-auto w-9/12 max-w-screen-xl lg:py-10">
    <div class="bg-gray-50  border border-gray-200  rounded-lg p-8 md:p-12 mb-8">

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
        <h1 class="text-gray-900  text-3xl md:text-5xl font-extrabold mb-2">{{ $post->title }}</h1>
        <!-- Post excerpt -->
        <p class="text-lg font-normal text-gray-500 mb-6">
            {{ $post->excerpt }}
        </p>
        <div class="flex flex-row justify-between">
            <div>
                <a href="{{route('posts.show', $post->slug)}}"
                    class="inline-flex justify-center items-center py-2.5 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 ">
                    Read more
                    <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
                <!-- Edit if user is logged in-->
                @if(Auth::check())
                    @if ($post->user_id == Auth::user()->id)
                        <a href="{{route('posts.edit', $post->id)}}"
                            class="inline-flex justify-center items-center py-2.5 px-5 text-base font-medium text-center text-white rounded-lg bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 ">
                            Edit Post
                            <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
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
                <a href="#" class="text-indigo-500"><span>{{ $post->user->name }}</span></a>
                <span class="text-gray-500">{{ $post->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</div>
