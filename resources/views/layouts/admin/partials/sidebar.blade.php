@php
    $menu = config('admin_menu', []);
    $isActive = function(array $item): bool {
        $patterns = $item['active'] ?? [$item['route'] ?? ''];
        foreach ($patterns as $pat) {
            if (request()->routeIs($pat)) return true;
        }
        return false;
    };
    $iconSvg = function(string $name, string $classes='w-5 h-5') {
        // Ikon minimal (heroicons outline subset) — ganti sesuai selera
        return match($name) {
            'home'  => '<svg xmlns="http://www.w3.org/2000/svg" class="'.$classes.'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10.5L12 3l9 7.5M4.5 9.75V21h5.25v-6h4.5v6H19.5V9.75"/></svg>',
            'users' => '<svg xmlns="http://www.w3.org/2000/svg" class="'.$classes.'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19.5a3.75 3.75 0 00-7.5 0M18 20.25V18a4.5 4.5 0 00-4.5-4.5h-3A4.5 4.5 0 006 18v2.25M12 11.25a3.75 3.75 0 100-7.5 3.75 3.75 0 000 7.5z"/></svg>',
            'cog'   => '<svg xmlns="http://www.w3.org/2000/svg" class="'.$classes.'" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.594 3.375A1.125 1.125 0 0110.5 3h3a1.125 1.125 0 01.906.375l.852.955a1.125 1.125 0 001.125.3l1.2-.36a1.125 1.125 0 011.41.796l.72 2.76c.097.37-.03.762-.318 1.017l-.96.861c-.24.215-.36.53-.318.845l.165 1.242c.045.343.27.638.588.788l1.128.54a1.125 1.125 0 01.606 1.348l-.96 2.76a1.125 1.125 0 01-1.41.705l-1.2-.36a1.125 1.125 0 00-1.125.3l-.852.955A1.125 1.125 0 0113.5 21h-3a1.125 1.125 0 01-.906-.375l-.852-.955a1.125 1.125 0 00-1.125-.3l-1.2.36a1.125 1.125 0 01-1.41-.706l-.96-2.76a1.125 1.125 0 01.606-1.348l1.128-.54a1.125 1.125 0 00.588-.788l.165-1.242a1.125 1.125 0 00-.318-.845l-.96-.861a1.125 1.125 0 01-.318-1.017l.72-2.76a1.125 1.125 0 011.41-.796l1.2.36a1.125 1.125 0 001.125-.3l.852-.955zM12 9.75a2.25 2.25 0 110 4.5 2.25 2.25 0 010-4.5z"/></svg>',
            default => '<svg xmlns="http://www.w3.org/2000/svg" class="'.$classes.'" viewBox="0 0 20 20" fill="currentColor"><path d="M10 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1z"/></svg>',
        };
    };
@endphp

<div class="h-16 flex items-center px-4 border-b">
    <a href="{{ route('admin.dashboard') }}" class="text-lg font-semibold tracking-tight">
        {{ config('app.name') }} <span class="text-primary-600">Admin</span>
    </a>
</div>

<nav class="flex-1 overflow-y-auto py-4">
    <ul class="space-y-1 px-2">
        @foreach($menu as $item)
            @php $active = $isActive($item); @endphp
            <li>
                <a
                    href="{{ isset($item['route']) ? route($item['route']) : '#' }}"
                    @if($active) aria-current="page" @endif
                    class="group flex items-center gap-3 rounded-md px-3 py-2 text-sm
                        {{ $active ? 'bg-gray-100 text-primary-700 font-medium' : 'text-gray-700 hover:bg-gray-50' }}"
                >
                    {!! $iconSvg($item['icon'] ?? 'dot','w-5 h-5 shrink-0 ' . ($active ? 'text-primary-700':'text-gray-400 group-hover:text-gray-600')) !!}
                    <span class="truncate">{{ $item['label'] ?? 'Menu' }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</nav>

<div class="p-4 border-t">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full inline-flex items-center justify-center rounded-md px-3 py-2 text-sm font-medium bg-gray-900 text-white hover:bg-gray-800">
            Logout
        </button>
    </form>
</div>
