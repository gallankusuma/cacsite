<div class="p-6 grid md:grid-cols-2 gap-8">
    <div class="space-y-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            Branches / Factories / Labs
            @if (session('ok')) <span class="text-emerald-600 text-sm">{{ session('ok') }}</span> @endif
        </h2>

        <table class="w-full text-sm border">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="p-2">Location</th>
                    <th class="p-2">Type</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $b)
                <tr class="border-t">
                    <td class="p-2">
                        <div class="font-semibold">{{ $b->country }} {{ $b->city ? '• '.$b->city : '' }}</div>
                        <div class="text-xs text-slate-500">{{ $b->address }}</div>
                        <div class="text-xs text-slate-500">{{ $b->phone }} {{ $b->email }}</div>
                    </td>
                    <td class="p-2 text-slate-500 capitalize">{{ $b->type }}</td>
                    <td class="p-2 text-right space-x-2">
                        <button class="text-emerald-600 underline" wire:click="edit({{ $b->id }})">Edit</button>
                        <button class="text-red-500 underline" wire:click="delete({{ $b->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-xs text-slate-500">These show on "Global Presence / Intelligent Factory / Lab" section.</p>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold">Edit / Create Location</h2>

        <form wire:submit.prevent="save" class="space-y-4 text-sm">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Country *</label>
                    <input type="text" wire:model="country" class="w-full border rounded p-2 text-sm">
                    @error('country')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">City</label>
                    <input type="text" wire:model="city" class="w-full border rounded p-2 text-sm">
                </div>
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Address</label>
                <textarea wire:model="address" rows="2" class="w-full border rounded p-2 text-sm"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Phone</label>
                    <input type="text" wire:model="phone" class="w-full border rounded p-2 text-sm">
                </div>
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Email</label>
                    <input type="email" wire:model="email" class="w-full border rounded p-2 text-sm">
                </div>
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Type</label>
                <select wire:model="type" class="w-full border rounded p-2 text-sm">
                    <option value="branch">Branch</option>
                    <option value="factory">Factory</option>
                    <option value="lab">Lab</option>
                </select>
            </div>

            <div class="flex items-center gap-2 text-xs">
                <input type="checkbox" wire:model="is_published" class="border rounded">
                <span>Published</span>
            </div>

            <button class="bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
                Save Location
            </button>
        </form>
    </div>
</div>
