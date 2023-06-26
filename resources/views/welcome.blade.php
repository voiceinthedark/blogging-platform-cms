<x-guest-layout>

    <div class="flex flex-col items-center justify-center">
        @foreach ($posts as $post)
        <livewire:post-item :post="$post"/>
        @endforeach
    </div>
</x-guest-layout>
