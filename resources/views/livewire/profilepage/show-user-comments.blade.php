<div>
    @foreach ($comments as $comment)
        <div key="comment-{{ $comment->id }}" class="flex flex-col justify-start my-3 bg-white p-4">
            <a href="{{ route('posts.show', $comment->post->slug) }}"><span class="font-bold text-sm text-sky-800">{{ $comment->post->title }}</span></a>
            <span class="text-xs italic font-light">{{ Str::words($comment->content, 10) }}</span>
            <a href="{{ route('posts.show', $comment->post->slug) }}"><span class="text-xs">{{ $comment->created_at->diffForHumans() }}</span></a>
        </div>
    @endforeach
    {{ $comments->links() }}
</div>
