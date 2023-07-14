<x-app-layout>
    <div class="grid grid-cols-6 ">
        <div>
            @livewire('user.feed.sidebar')
        </div>

        <div class="col-span-4 col-start-2 col-end-5 border border-cyan-400">
            @livewire('user.feed.posts-list', ['posts' => $posts])
        </div>
    </div>
</x-app-layout>
