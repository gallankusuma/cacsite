<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title','Admin') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full bg-gray-50 text-gray-800">
    <div x-data="{ open:false }" class="min-h-screen">
        {{-- Sidebar desktop --}}
        <aside class="hidden md:flex md:flex-col md:w-64 md:fixed md:inset-y-0 bg-white border-r">
            @include('layouts.admin.partials.sidebar')
        </aside>

        {{-- Sidebar mobile (drawer) --}}
        <div class="md:hidden" x-show="open" x-transition.opacity>
            <div class="fixed inset-0 z-40 bg-black/40" @click="open=false"></div>
            <aside class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r">
                @include('layouts.admin.partials.sidebar')
            </aside>
        </div>

        {{-- Main area --}}
        <div class="md:pl-64 flex flex-col min-h-screen">
            @include('layouts.admin.partials.topbar')

            <main class="flex-1">
                <div class="mx-auto max-w-7xl p-4 sm:p-6 lg:p-8">
                    {{ $slot ?? '' }}
                </div>
            </main>

            {{-- Footer opsional --}}
            {{-- @include('layouts.admin.partials.footer') --}}
        </div>
    </div>

    @livewireScripts
    {{-- Alpine (jika belum di-bundle) — aman dihapus jika sudah ada di app.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
