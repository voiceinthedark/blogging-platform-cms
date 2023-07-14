<div class="grid grid-cols-6 ">
    <div>
        @livewire('user.feed.sidebar')
    </div>

    <div class="col-span-4 col-start-2 col-end-5 border border-cyan-400">
        @switch($component)
            @case('posts-list')
                @livewire('user.feed.posts-list')
                @break
            @case('followers')
                @livewire('user.feed.followers')
                @break

            @default

        @endswitch
    </div>
</div>
