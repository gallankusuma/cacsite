<div class="p-6 max-w-xl space-y-6">
    <h2 class="text-lg font-semibold flex items-center gap-2">
        Site Stats
        @if (session('ok')) <span class="text-emerald-600 text-sm">{{ session('ok') }}</span> @endif
    </h2>

    <form wire:submit.prevent="save" class="space-y-4 text-sm">
        @foreach($stats as $k => $v)
        <div>
            <label class="text-xs font-medium text-slate-700 block mb-1 capitalize">{{ $k }}</label>
            <input type="number" wire:model="stats.{{ $k }}" class="w-full border rounded p-2 text-sm">
        </div>
        @endforeach

        <button class="bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
            Save Stats
        </button>
    </form>

    <p class="text-xs text-slate-500">These numbers power the counters: branches, factories, countries served, product registrations.</p>
</div>
