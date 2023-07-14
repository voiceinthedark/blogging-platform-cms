<div>
    @foreach ($posts as $post)
        @livewire('user.feed.posts-list-item', ['post' => $post])
    @endforeach
</div>
