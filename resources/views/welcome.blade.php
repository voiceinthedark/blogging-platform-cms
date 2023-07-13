<x-guest-layout>

    @guest
        @include('navigation-menu-guest')
    @else
        @include('navigation-menu')
    @endguest

    <!-- Jumbotron -->
    <header>
        <div
            class="flex flex-col justify-center items-center min-w-[1200px] py-8 px-4 mx-auto w-9/12 max-w-screen-xl lg:py-16">
            <h1 class="font-mono text-3xl font-extrabold md:text-5xl">Blogging Platform</h1>
        </div>
    </header>

    <div class="flex flex-row justify-center">
        <div>
            <livewire:show-posts :posts="$posts" />
        </div>
        <div class="h-full max-w-xs p-2 mt-10 bg-white rounded-lg shadow-lg">
            <livewire:post.show-latest />
        </div>
    </div>


</x-guest-layout>
