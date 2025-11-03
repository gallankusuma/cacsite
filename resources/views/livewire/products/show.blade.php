@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-4xl">
    <div class="grid md:grid-cols-2 gap-8">
        <div>
            @if($p->hero_image)
            <img src="{{ $p->hero_image }}" class="w-full rounded-xl bg-slate-100 object-cover max-h-[320px]">
            @endif

            @if($p->datasheet_path)
            <a href="{{ $p->datasheet_path }}" class="block mt-4 text-xs text-emerald-600 underline" target="_blank">Download datasheet (PDF)</a>
            @endif
        </div>

        <div class="text-sm">
            <div class="text-slate-400 uppercase tracking-wide text-[10px] font-semibold mb-1">{{ optional($p->category)->name }}</div>
            <h1 class="text-2xl font-bold text-slate-800">{{ $p->name }}</h1>
            <div class="text-slate-500 mt-2 leading-relaxed">{{ $p->summary }}</div>

            <div class="mt-6">
                <h2 class="font-semibold text-slate-800 text-sm mb-1">Description</h2>
                <div class="text-slate-700 text-sm leading-relaxed">{!! $p->description !!}</div>
            </div>

            @if($p->specs && is_array($p->specs))
            <div class="mt-6">
                <h2 class="font-semibold text-slate-800 text-sm mb-1">Specs</h2>
                <ul class="text-slate-700 text-sm leading-relaxed list-disc ml-4">
                    @foreach($p->specs as $k=>$v)
                    <li><span class="font-semibold">{{ $k }}:</span> {{ $v }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
