<div class="flex flex-col items-center justify-center">

    @foreach ($posts as $post)
        <livewire:post-item :post="$post" wire:key="{{$post->id}}"/>
    @endforeach

    {{ $posts->links() }}
</div>
