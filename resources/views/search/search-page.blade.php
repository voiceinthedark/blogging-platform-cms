<x-app-layout>
    <livewire:search.search-by-type :items="$items" :type="request()->route('type')"/>
</x-app-layout>
