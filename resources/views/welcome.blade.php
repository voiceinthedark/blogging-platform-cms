<x-guest-layout>

    @include('navigation-menu-guest')

    <!-- Jumbotron -->
    <header>
        <div
            class="flex flex-col justify-center items-center min-w-[1200px] py-8 px-4 mx-auto w-9/12 max-w-screen-xl lg:py-16">
            <h1 class="text-3xl md:text-5xl font-extrabold font-mono">Blogging Platform</h1>
        </div>
    </header>

    <div class="flex flex-row flex-2">
        <div>
            <livewire:show-posts :posts="$posts" />
        </div>
        <div class="bg-white h-full max-w-xs rounded-lg shadow-lg p-2 mt-10">
            <livewire:post.show-latest />
        </div>
    </div>


</x-guest-layout>
