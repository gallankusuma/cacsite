<header class="sticky top-0 z-30 bg-white border-b">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <button class="md:hidden inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:bg-gray-100"
                    @click="open = !open" aria-label="Toggle sidebar">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5"/>
                </svg>
            </button>
            <div class="text-sm text-gray-500">
                @yield('title')
            </div>
        </div>

        <div class="flex items-center gap-3">
            <div class="hidden sm:block text-sm text-gray-600">
                {{ auth()->user()->name ?? 'User' }}
            </div>

            {{-- Quick logout on topbar (opsional; sidebar sudah punya tombol logout) --}}
            <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                @csrf
                <button type="submit" class="inline-flex items-center rounded-md px-3 py-1.5 text-sm bg-gray-900 text-white hover:bg-gray-800">
                    Logout
                </button>
            </form>
        </div>
    </div>
</header>
