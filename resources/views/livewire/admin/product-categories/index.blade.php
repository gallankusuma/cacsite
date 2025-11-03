<div class="p-6 grid md:grid-cols-2 gap-8">
    <div class="space-y-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            Product Categories
            @if (session('ok')) <span class="text-emerald-600 text-sm">{{ session('ok') }}</span> @endif
        </h2>

        <table class="w-full text-sm border">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="p-2">Name</th>
                    <th class="p-2">Slug</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $c)
                <tr class="border-t">
                    <td class="p-2">{{ $c->name }}</td>
                    <td class="p-2 text-slate-500">{{ $c->slug }}</td>
                    <td class="p-2 text-right space-x-2">
                        <button class="text-emerald-600 underline" wire:click="edit({{ $c->id }})">Edit</button>
                        <button class="text-red-500 underline" wire:click="delete({{ $c->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-xs text-slate-500">These categories appear on Products landing &amp; home page grid.</p>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold">Edit / Create Category</h2>

        <form wire:submit.prevent="save" class="space-y-4 text-sm">
            <div>
                <label class="font-medium text-slate-700 text-xs block mb-1">Name *</label>
                <input type="text" wire:model="name" class="w-full border rounded p-2 text-sm">
                @error('name')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="font-medium text-slate-700 text-xs block mb-1">Slug *</label>
                <input type="text" wire:model="slug" class="w-full border rounded p-2 text-sm">
                @error('slug')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="font-medium text-slate-700 text-xs block mb-1">Short Description</label>
                <textarea wire:model="short_desc" rows="3" class="w-full border rounded p-2 text-sm"></textarea>
            </div>

            <button class="bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
                Save Category
            </button>
        </form>
    </div>
</div>
