<x-guest-layout>
    @include('navigation-menu-guest')

    <div class="w-full flex flex-col justify-center items-center">
        <div class="flex flex-col w-[80%] mx-auto justify-center items-center bg-white mt-4 px-5 py-4 shadow-lg shadow-gray-300">
            <div class="mb-10 tracking-tighter text-5xl text-center font-bold mt-8 w-96">{{ $post->title }}</div>
            <div class="flex flex-row justify-between">
                <div class="w-6/12 mr-2">
                    @foreach ( $post->tags as $tag)
                        <a href="#"
                            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                            <x-icons.tag :name="$tag->slug" class="w-6 h-6 mx-2" />
                            {{ $tag->slug }}
                        </a>
                    @endforeach
                </div>
                <div class="w-6/12 ml-2">
                    @foreach ( $post->categories as $category)
                        <a href="#"
                            class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded-md  mb-2 mx-2">
                            #{{ $category->slug }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="flex mt-8 w-full justify-evenly">
                    <a href="{{ route('profilepage.show', $post->user->userprofile->username) }}"><span class="font-bold text-lg text-sky-900 hover:underline ">{{ $post->user->name }}</span></a>
                    <span>{{ $post->created_at->diffForHumans() }}</span>
            </div>
            <div class="flex flex-col mt-9 pb-6">
                <article class="prose lg:prose-xl indent-8 prose-headings:underline prose-a:text-blue-600 hover:prose-a:text-blue-400 first-letter:text-7xl first-letter:font-bold first-letter:float-left first-letter:mr-3 first-line:uppercase">{!! $post->content !!}</article>
            </div>
            <!-- Likes and Dislikes section -->
            <div class="mt-8 self-end">
                <livewire:post.like-form />
            </div>
            <!-- About the Author and QR code section -->
            <div>

            </div>
        </div>
        <!-- Comments section -->
        <div class="mt-8 bg-white shadow rounded px-4 py-4 w-[50%]">
            <div class="flex justify-between">
                <span class="font-bold text-2xl">Comments</span>
                <span class="font-semibold">{{ $post->comments->count() }} comments</span>
            </div>
            <x-section-border />
            <livewire:comments.show-comments :comments="$comments" :post="$post"/>
        </div>
    </div>

</x-guest-layout>
