<div class="p-6 grid md:grid-cols-2 gap-8" x-data>
    <div class="space-y-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            Products
            @if (session('ok')) <span class="text-emerald-600 text-sm">{{ session('ok') }}</span> @endif
        </h2>

        <table class="w-full text-sm border">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="p-2">Product</th>
                    <th class="p-2">Category</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $p)
                <tr class="border-t">
                    <td class="p-2">
                        <div class="font-semibold">{{ $p->name }}</div>
                        <div class="text-xs text-slate-500">{{ $p->slug }}</div>
                    </td>
                    <td class="p-2 text-slate-500">{{ optional($p->category)->name }}</td>
                    <td class="p-2 text-right space-x-2">
                        <button class="text-emerald-600 underline" wire:click="edit({{ $p->id }})">Edit</button>
                        <button class="text-red-500 underline" wire:click="delete({{ $p->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-xs text-slate-500">Upload PDF datasheet + hero image + SEO OG image. Specs is JSON.</div>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold">Edit / Create Product</h2>

        <form wire:submit.prevent="save" class="space-y-4 text-sm">
            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Category *</label>
                <select wire:model="category_id" class="w-full border rounded p-2 text-sm">
                    <option value="">-- choose --</option>
                    @foreach($cats as $c)
                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                    @endforeach
                </select>
                @error('category_id')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Name *</label>
                    <input type="text" wire:model="name" wire:change="makeSlug" class="w-full border rounded p-2 text-sm">
                    @error('name')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Slug *</label>
                    <input type="text" wire:model="slug" class="w-full border rounded p-2 text-sm">
                    @error('slug')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
                </div>
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Summary</label>
                <textarea wire:model="summary" rows="2" class="w-full border rounded p-2 text-sm"></textarea>
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Description (HTML ok)</label>
                <textarea wire:model="description" rows="4" class="w-full border rounded p-2 text-sm"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2 border rounded p-3">
                    <div class="text-xs font-semibold text-slate-700">Hero Image</div>
                    <input type="file" wire:model="hero_file" class="w-full text-xs">
                </div>
                <div class="space-y-2 border rounded p-3">
                    <div class="text-xs font-semibold text-slate-700">SEO OG Image</div>
                    @if($og_image)
                        <img src="{{ $og_image }}" class="rounded max-h-24 object-cover">
                    @endif
                    <input type="file" wire:model="og_file" class="w-full text-xs">
                </div>
            </div>

            <div class="space-y-2 border rounded p-3">
                <div class="text-xs font-semibold text-slate-700">Datasheet (PDF)</div>
                <input type="file" wire:model="datasheet_file" class="w-full text-xs">
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Specs (JSON)</label>
                <textarea wire:model="specs_json" rows="4" class="w-full border rounded p-2 font-mono text-xs"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Meta Title</label>
                    <input type="text" wire:model="meta_title" class="w-full border rounded p-2 text-sm">
                </div>
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Meta Description</label>
                    <input type="text" wire:model="meta_description" class="w-full border rounded p-2 text-sm">
                </div>
            </div>

            <div class="flex items-center gap-2 text-xs">
                <input type="checkbox" wire:model="is_published" class="border rounded">
                <span>Published</span>
            </div>

            <button class="bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
                Save Product
            </button>
        </form>
    </div>
</div>
