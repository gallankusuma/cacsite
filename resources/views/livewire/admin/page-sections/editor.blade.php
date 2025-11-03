<div class="p-6 grid md:grid-cols-2 gap-8" x-data="{
    dragIds: [],
    startDrag(){
        this.dragIds=[...$refs.rows.querySelectorAll('[data-id]')].map(r=>r.dataset.id);
    },
    endDrag(){
        $wire.reorderSections(this.dragIds);
    }
}">
    <div class="space-y-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            Sections for: {{ $page->title }}
            @if (session('ok')) <span class="text-emerald-600 text-sm">{{ session('ok') }}</span> @endif
        </h2>

        <div class="text-xs text-slate-500">Drag the handle (☰) to sort.</div>

        <ul class="space-y-2" x-ref="rows">
            @foreach($items as $s)
            <li class="border rounded p-3 bg-white flex items-start gap-3" data-id="{{ $s->id }}"
                draggable="true"
                @dragstart="startDrag()"
                @dragend="endDrag()"
                @dragover.prevent
                @drop.prevent="
                    const from = dragIds.indexOf('{{ $s->id }}');
                    const overId = $event.currentTarget.dataset.id;
                    const to = dragIds.indexOf(overId);
                    dragIds.splice(to,0,dragIds.splice(from,1)[0]);
                ">
                <div class="cursor-move select-none text-slate-400 pr-2">☰</div>
                <div class="flex-1 text-sm">
                    <div class="font-semibold">{{ $s->title ?: '(no title)' }}</div>
                    <div class="text-xs text-slate-500">{{ $s->key }}</div>
                    <div class="text-xs text-slate-400 line-clamp-2">{{ Str::limit(strip_tags($s->body),120) }}</div>
                    @if($s->media_path)
                        <div class="text-xs text-emerald-600 mt-1">Media: {{ $s->media_path }}</div>
                    @endif
                    <div class="text-xs text-slate-500 mt-1 flex items-center gap-3">
                        <button class="text-emerald-600 underline" wire:click="edit({{ $s->id }})">Edit</button>
                        <button class="text-red-500 underline" wire:click="delete({{ $s->id }})">Delete</button>
                        <span class="inline-block text-[10px] px-2 py-0.5 rounded-full {{ $s->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                            {{ $s->is_published ? 'Published' : 'Hidden' }}
                        </span>
                    </div>
                </div>
                <div class="text-[10px] text-slate-400 pl-2">#{{ $s->sort_order }}</div>
            </li>
            @endforeach
        </ul>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold">Edit / Create Section</h2>

        <form wire:submit.prevent="save" class="space-y-4 text-sm">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Block Key</label>
                    <input type="text" wire:model="key" class="w-full border rounded p-2 text-sm">
                </div>
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Sort Order</label>
                    <input type="number" wire:model="sort_order" class="w-full border rounded p-2 text-sm">
                </div>
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Title</label>
                <input type="text" wire:model="title" class="w-full border rounded p-2 text-sm">
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Body (HTML / text)</label>
                <textarea wire:model="body" rows="4" class="w-full border rounded p-2 text-sm"></textarea>
            </div>

            <div class="space-y-2 border rounded p-3">
                <div class="text-xs font-semibold text-slate-700 flex items-center justify-between">
                    <div>Media (image / pdf etc)</div>
                    @if($media_path)
                      <button type="button" class="text-red-500 text-xs underline" wire:click="clearMedia">Remove media</button>
                    @endif
                </div>

                @if($media_path)
                    <div class="text-xs text-emerald-600 break-all">{{ $media_path }}</div>
                @endif

                <input type="file" wire:model="media_file" class="w-full text-xs">
            </div>

            <div class="flex items-center gap-2 text-xs">
                <input type="checkbox" wire:model="is_published" class="border rounded">
                <span>Published</span>
            </div>

            <button class="bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
                Save Section
            </button>
        </form>
    </div>
</div>
