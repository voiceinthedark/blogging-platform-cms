<x-guest-layout>
    <nav class="bg-white w-full" x-data="{ open: false }">
        <!-- Primary Navigation Menu -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('welcome') }}">
                            <x-application-mark class="block h-9 w-auto" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                    <div class="px-4 self-center">
                        <label for="search-posts" class="sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input type="text" id="search-posts" x-on:input.debounce.500ms="Livewire.emitTo('show-posts', 'searchValueChange', $event.target.value)"
                                class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Search for posts">
                        </div>
                    </div>
                </div>

                <!-- Authentication -->
                @if (auth()->check())
                <div class="flex flex-row">
                    <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-nav-link class="mt-4" href="{{ route('logout') }}"
                                         @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-nav-link>
                            </form>

                </div>


                @else
                <div class="flex flex-row">
                    <x-nav-link class="mr-3" href="{{ route('login') }}" :active="request()->routeIs('login')">
                        {{ __('Login') }}</x-nav-link>
                    <x-nav-link
                        class="ml-3 self-center bg-blue-200 border border-gray-200 rounded-md focus:ring-4 focus:ring-blue-300"
                        href="{{ route('register') }}" :active="request()->routeIs('register')">
                        {{ __('Register') }}</x-nav-link>

                </div>

                @endif


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
        <div
            class="flex flex-col justify-center items-center min-w-[1200px] py-8 px-4 mx-auto w-9/12 max-w-screen-xl lg:py-16">
            <h1 class="text-3xl md:text-5xl font-extrabold font-mono">Blogging Platform</h1>
        </div>
    </header>

    <div>
        <livewire:show-posts :posts="$posts" />
    </div>


</x-guest-layout>
