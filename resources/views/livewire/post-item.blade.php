{{-- <div class="flex flex-col font-sans my-2 w-[600px] bg-gray-200 rounded py-2 px-4" wire:model="post">

    <h2 class="text-2xl">{{ $post->title }}</h2>
    <p class="mt-2">
        {{ $post->excerpt }}
    </p>
    <div class="flex justify-between">
        <span>{{ $post->created_at->diffForHumans() }}</span>
        <span>{{ $post->user->name }}</span>
    </div>

</div> --}}


<section>
    <div class="flex flex-col justify-center min-w-[1200px] py-8 px-4 mx-auto w-9/12 max-w-screen-xl lg:py-16">
        <div class="bg-gray-50  border border-gray-200  rounded-lg p-8 md:p-12 mb-8">

            <div class="flex flex-row">
                @foreach ($post->tags as $tag)
                    <a href="#"
                        class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                        <x-icons.category :name="$tag->slug" class="w-6 h-6 mx-2"/>
                        {{ $tag->name }}

                    </a>
                @endforeach
            </div>
            <h1 class="text-gray-900  text-3xl md:text-5xl font-extrabold mb-2">{{ $post->title }}</h1>
            <p class="text-lg font-normal text-gray-500 mb-6">
                {{ $post->excerpt }}
            </p>
            <a href="#"
                class="inline-flex justify-center items-center py-2.5 px-5 text-base font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 ">
                Read more
                <svg aria-hidden="true" class="ml-2 -mr-1 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
