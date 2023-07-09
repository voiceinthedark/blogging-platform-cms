<x-guest-layout>
    <div>
        @include('navigation-menu-guest')
        <livewire:profilepage.show :user="$user" />
    </div>
</x-guest-layout>
