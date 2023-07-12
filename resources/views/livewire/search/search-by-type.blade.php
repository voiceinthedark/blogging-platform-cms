
<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Search by ') . $type }}
        </h2>
    </x-slot>
    <div class="flex flex-row justify-center gap-2 mt-20">
        {{-- @dd($items) --}}

        @foreach ($items as $item)
            <button type="button" wire:click.prevent="searchBy('{{ $item->slug }}', '{{ $type }}')">
                <x-badge rounded dark label="{{ $item->name }}" />
            </button>
        @endforeach
    </div>

    @isset($results)
        @forelse ($results as $result)
            <div>
                <livewire:post-item :post="$result" :key="$result->id" />
            </div>

        @empty
        @endforelse
        {{-- @if (!empty($results))
            {{ $results->links() }}
        @endif --}}

    @endisset($results)

</div>
