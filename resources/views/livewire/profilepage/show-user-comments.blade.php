<div>
    @foreach ($comments as $comment)
        <div wire:key="comment-{{ $comment->id }}" class="flex flex-col justify-start my-3 bg-white p-4">
            <span class="text-base italic font-light">{{ $comment->content }}</span>
            <a href="{{ route('posts.show', $comment->post->slug) }}"><span class="text-sm">{{ $comment->created_at->diffForHumans() }}</span></a>
        </div>
    @endforeach
</div>
