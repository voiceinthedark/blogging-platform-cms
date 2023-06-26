<x-guest-layout>
    <nav class="bg-white w-full" x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('dashboard') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                </div>

                <!-- Authentication -->
                <div class="flex flex-row">
                    <x-nav-link class="mr-3" href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}</x-nav-link>
                    <x-nav-link
                        class="ml-3 self-center bg-blue-200 border border-gray-200 rounded-md focus:ring-4 focus:ring-blue-300"
                        href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}</x-nav-link>

                </div>

                <!-- Hamburger -->
                <div class="-mr-2 flex items-center sm:hidden">
                    <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                        <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                            <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                                stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Jumbotron -->
    <header>
            <div class="flex flex-col justify-center items-center min-w-[1200px] py-8 px-4 mx-auto w-9/12 max-w-screen-xl lg:py-16">
                <h1 class="text-3xl md:text-5xl font-extrabold font-mono">Blogging Platform</h1>
            </div>
    </header>

    <div>
        <livewire:show-posts :posts="$posts" />
    </div>


</x-guest-layout>
