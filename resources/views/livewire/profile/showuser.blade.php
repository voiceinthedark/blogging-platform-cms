<x-guest-layout>
    @include('navigation-menu-guest')

    <livewire:profilepage.show :user="$user" />
</x-guest-layout>
