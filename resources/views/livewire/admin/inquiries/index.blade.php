<div class="p-6 grid md:grid-cols-2 gap-8">
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold">Inquiries</h2>
            <div class="text-xs space-x-2">
                <button class="underline {{ $filter==='all'?'text-emerald-600':'' }}" wire:click="$set('filter','all')">All</button>
                <button class="underline {{ $filter==='new'?'text-emerald-600':'' }}" wire:click="$set('filter','new')">New</button>
                <button class="underline {{ $filter==='contact'?'text-emerald-600':'' }}" wire:click="$set('filter','contact')">Contact</button>
                <button class="underline {{ $filter==='career'?'text-emerald-600':'' }}" wire:click="$set('filter','career')">Career</button>
            </div>
        </div>

        <div class="border rounded divide-y max-h-[32rem] overflow-y-auto text-sm bg-white">
            @foreach($items as $inq)
            <div class="p-3 flex flex-col gap-1 cursor-pointer hover:bg-emerald-50"
                 wire:click="read({{ $inq->id }})"
                 wire:dblclick="markRead({{ $inq->id }})">
                <div class="flex items-center justify-between">
                    <div class="font-semibold text-slate-800">{{ $inq->name }}</div>
                    <div class="text-[10px] px-2 py-0.5 rounded-full {{ $inq->status==='new' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                        {{ $inq->status }}
                    </div>
                </div>
                <div class="text-xs text-slate-500">{{ $inq->email }} • {{ $inq->phone }}</div>
                <div class="text-xs text-slate-400 line-clamp-2">{{ Str::limit($inq->message,100) }}</div>
                <div class="text-[10px] text-slate-400">{{ $inq->created_at }}</div>
            </div>
            @endforeach
        </div>
        <p class="text-xs text-slate-500">Single click: preview. Double click: mark read.</p>
    </div>

    <div class="space-y-4">
        <h2 class="text-lg font-semibold">Preview</h2>

        @if($reading)
        <div class="border rounded p-4 bg-white text-sm space-y-2">
            <div class="flex items-center justify-between">
                <div class="font-semibold text-slate-800">{{ $reading->name }}</div>
                <div class="text-[10px] px-2 py-0.5 rounded-full {{ $reading->status==='new' ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                    {{ $reading->status }}
                </div>
            </div>
            <div class="text-xs text-slate-500">{{ $reading->email }} • {{ $reading->phone }}</div>
            <div class="text-xs text-slate-500">Type: {{ $reading->type }} | {{ $reading->created_at }}</div>
            <div class="text-xs text-slate-400">Subject: {{ $reading->subject }}</div>
            <div class="text-slate-700 whitespace-pre-line">{{ $reading->message }}</div>

            @if(is_array($reading->meta))
            <div class="text-xs text-slate-500 border-t pt-2">
                @foreach($reading->meta as $mk=>$mv)
                <div><span class="font-semibold">{{ $mk }}:</span> {{ $mv }}</div>
                @endforeach
            </div>
            @endif
        </div>
        @else
        <div class="text-xs text-slate-500">Select a message from the left.</div>
        @endif
    </div>
</div>
