<div>
    @foreach ($post->comments as $comment)
        <div class="flex flex-col items-start">
            <span class="font-bold">{{ $comment->user->name }}</span>
            <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <div class="p-4 bg-gray-100 m-2 text-secondary-800 border rounded border-l-slate-700">
            {{ $comment->content }}
        </div>
        <div class="flex flex-row justify-end">
            <a href="" class="text-blue-600">Reply</a>
        </div>
    @endforeach
</div>
