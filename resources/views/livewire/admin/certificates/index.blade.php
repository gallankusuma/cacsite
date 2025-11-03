<div class="p-6 grid md:grid-cols-2 gap-8">
    <div class="space-y-4">
        <h2 class="text-lg font-semibold flex items-center gap-2">
            Certificates
            @if (session('ok')) <span class="text-emerald-600 text-sm">{{ session('ok') }}</span> @endif
        </h2>

        <table class="w-full text-sm border">
            <thead class="bg-slate-100 text-left">
                <tr>
                    <th class="p-2">Title</th>
                    <th class="p-2">Issuer</th>
                    <th class="p-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $c)
                <tr class="border-t">
                    <td class="p-2">
                        <div class="font-semibold">{{ $c->title }}</div>
                        <div class="text-xs text-slate-500">{{ $c->issue_date }}</div>
                    </td>
                    <td class="p-2 text-slate-500">{{ $c->issuer }}</td>
                    <td class="p-2 text-right space-x-2">
                        <button class="text-emerald-600 underline" wire:click="edit({{ $c->id }})">Edit</button>
                        <button class="text-red-500 underline" wire:click="delete({{ $c->id }})">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <p class="text-xs text-slate-500">Upload PDF or image proof of certificate.</p>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold">Edit / Create Certificate</h2>

        <form wire:submit.prevent="save" class="space-y-4 text-sm">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Title *</label>
                    <input type="text" wire:model="title" class="w-full border rounded p-2 text-sm">
                    @error('title')<div class="text-red-500 text-xs">{{ $message }}</div>@enderror
                </div>
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Issuer</label>
                    <input type="text" wire:model="issuer" class="w-full border rounded p-2 text-sm">
                </div>
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Issue Date</label>
                <input type="date" wire:model="issue_date" class="w-full border rounded p-2 text-sm">
            </div>

            <div class="space-y-2 border rounded p-3">
                <div class="text-xs font-semibold text-slate-700">Certificate File (PDF/Image)</div>
                <input type="file" wire:model="file_upload" class="w-full text-xs">
            </div>

            <div class="flex items-center gap-2 text-xs">
                <input type="checkbox" wire:model="is_published" class="border rounded">
                <span>Published</span>
            </div>

            <button class="bg-emerald-600 text-white text-sm font-semibold px-4 py-2 rounded-md">
                Save Certificate
            </button>
        </form>
    </div>
</div>
