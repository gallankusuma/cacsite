@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-5xl">
    <h1 class="text-3xl font-bold text-slate-800 mb-2">{{ $cat->name }}</h1>
    <div class="text-slate-500 text-sm max-w-xl mb-8">{{ $cat->short_desc }}</div>

    <div class="grid md:grid-cols-2 gap-6 text-sm">
        @foreach($items as $p)
        <a href="{{ route('products.show',$p->slug) }}" class="border rounded-xl bg-white hover:shadow p-5 flex gap-4">
            @if($p->hero_image)
            <img src="{{ $p->hero_image }}" class="w-24 h-24 rounded-lg object-cover bg-slate-100 flex-shrink-0">
            @endif
            <div>
                <div class="font-semibold text-slate-800">{{ $p->name }}</div>
                <div class="text-xs text-slate-500 line-clamp-3">{{ $p->summary }}</div>
            </div>
        </a>
        @endforeach
    </div>

    <div class="mt-8 text-xs text-slate-500">
        {{ $items->links() }}
    </div>
</div>
@endsection
