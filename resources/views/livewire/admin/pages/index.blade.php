<div class="p-6 grid md:grid-cols-2 gap-8" x-data>
    <div class="space-y-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            Pages
            @if (session('ok')) <span class="text-emerald-600 text-sm">{{ session('ok') }}</span> @endif
        </h2>

        <table class="w-full text-sm border">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="p-2">Title</th>
                    <th class="p-2">Slug</th>
                    <th class="p-2">Type</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $p)
                <tr class="border-t">
                    <td class="p-2">{{ $p->title }}</td>
                    <td class="p-2 text-slate-500">{{ $p->slug }}</td>
                    <td class="p-2 text-slate-500">{{ $p->type }}</td>
                    <td class="p-2 text-right space-x-2">
                        <button class="text-emerald-600 underline" wire:click="edit({{ $p->id }})">Edit</button>
                        <a class="text-blue-600 underline" href="{{ route('admin.pages.sections',$p) }}">Sections</a>
                        <button class="text-red-500 underline" wire:click="delete({{ $p->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-xs text-slate-500">Click "Sections" to drag &amp; drop reorder sections and upload media per block.</p>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold">Edit / Create Page</h2>

        <form wire:submit.prevent="save" class="space-y-4 text-sm">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="font-medium text-slate-700 text-xs block mb-1">Slug *</label>
                    <input type="text" wire:model="slug" class="w-full border rounded p-2 text-sm">
                    @error('slug')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="font-medium text-slate-700 text-xs block mb-1">Type</label>
                    <select wire:model="type" class="w-full border rounded p-2 text-sm">
                        <option value="standard">Standard</option>
                        <option value="landing">Landing</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="font-medium text-slate-700 text-xs block mb-1">Title *</label>
                    <input type="text" wire:model="title" class="w-full border rounded p-2 text-sm">
                    @error('title')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="font-medium text-slate-700 text-xs block mb-1">Subtitle</label>
                    <input type="text" wire:model="subtitle" class="w-full border rounded p-2 text-sm">
                </div>
            </div>

            <div>
                <label class="font-medium text-slate-700 text-xs block mb-1">Body (HTML / text)</label>
                <textarea wire:model="body" rows="4" class="w-full border rounded p-2 text-sm"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2 border rounded p-3">
                    <div class="text-xs font-semibold text-slate-700">Hero Image</div>
                    @if($hero_image)
                        <img src="{{ $hero_image }}" class="rounded max-h-24 object-cover">
                        <button type="button" class="text-red-500 text-xs underline" wire:click="clearHero">Remove</button>
                    @endif
                    <input type="file" wire:model="hero_file" class="w-full text-xs">
                </div>

                <div class="space-y-2 border rounded p-3">
                    <div class="text-xs font-semibold text-slate-700">OG Image (social share)</div>
                    @if($og_image)
                        <img src="{{ $og_image }}" class="rounded max-h-24 object-cover">
                        <button type="button" class="text-red-500 text-xs underline" wire:click="clearOg">Remove</button>
                    @endif
                    <input type="file" wire:model="og_file" class="w-full text-xs">
                </div>
            </div>

            <div class="border rounded p-3 space-y-3">
                <div class="flex items-center justify-between">
                    <div class="text-xs font-semibold text-slate-700">Hero Video (mp4)</div>
                    @if($hero_video_url)
                        <button type="button" class="text-red-500 text-xs underline" wire:click="clearVideo">Remove video</button>
                    @endif
                </div>

                @if($hero_video_url)
                    <video class="w-full rounded bg-black max-h-40" controls poster="{{ $hero_video_poster ?? '' }}">
                        <source src="{{ $hero_video_url }}" type="video/mp4">
                    </video>
                @endif

                <input type="file" wire:model="video_file" class="w-full text-xs">

                <div class="text-xs text-slate-600">
                    Poster (preview frame). Auto-generate from first frame if blank, or upload custom:
                </div>
                @if($hero_video_poster)
                    <img src="{{ $hero_video_poster }}" class="rounded max-h-24 object-cover">
                @endif
                <input type="file" wire:model="poster_file" class="w-full text-xs">
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
                Save Page
            </button>
        </form>
    </div>
</div>
