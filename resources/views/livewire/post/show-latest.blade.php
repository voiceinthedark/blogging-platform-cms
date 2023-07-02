<div class="flex flex-1 flex-col items-start">
    <span class="font-bold text-xl px-4 py-2">Latest Posts</span>
    <hr class="bg-gray-500">
    @foreach ($posts as $post)
        <div class="hover:bg-sky-100 flex flex-row flex-wrap items-center px-4 py-2">
            <a href="{{ route('posts.show', $post->slug)}}"><span class="mt-2 whitespace-break-spaces px-2 text-ellipsis text-blue-700 hover:text-blue-800 transition-colors cursor-pointer">{{ $post->title }}</span></a>
            <span class="ml-2 text-sm text-gray-600 text-right">{{ $post->created_at->diffForHumans() }}</span>
        </div>
    @endforeach
</div>
