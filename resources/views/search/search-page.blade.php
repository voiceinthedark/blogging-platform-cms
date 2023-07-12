<x-app-layout>
    <livewire:search.search-by-type :items="$items" :type="request()->route('type')" :name="$name" />
</x-app-layout>
