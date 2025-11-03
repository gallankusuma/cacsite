@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-5xl">
    <h1 class="text-3xl font-bold text-slate-800 mb-8">Product Categories</h1>

    <div class="grid md:grid-cols-3 gap-6 text-sm">
        @foreach($cats as $c)
        <a href="{{ route('products.by-category',$c->slug) }}" class="border rounded-xl p-5 hover:shadow bg-white">
            <div class="text-slate-800 font-semibold">{{ $c->name }}</div>
            <div class="text-slate-500 text-xs leading-snug line-clamp-4 mt-2">{{ $c->short_desc }}</div>
        </a>
        @endforeach
    </div>
</div>
@endsection
