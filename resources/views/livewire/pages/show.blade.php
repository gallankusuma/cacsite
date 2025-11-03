@extends('layouts.public')

@section('content')
<div class="bg-mist">
    <div class="container mx-auto px-4 py-12 max-w-3xl">
        <h1 class="text-3xl font-bold text-slate-800">{{ $page->title }}</h1>
        @if($page->subtitle)
        <div class="text-slate-500 mt-2">{{ $page->subtitle }}</div>
        @endif

        @if($page->hero_image)
        <img src="{{ $page->hero_image }}" class="rounded-xl mt-6 max-h-[360px] w-full object-cover">
        @endif

        @if($page->hero_video_url)
        <video class="rounded-xl mt-6 w-full max-h-[360px] object-cover" controls poster="{{ $page->hero_video_poster }}">
            <source src="{{ $page->hero_video_url }}" type="video/mp4">
        </video>
        @endif

        <article class="prose prose-slate max-w-none mt-8 text-slate-700 text-sm leading-relaxed">
            {!! $page->body !!}
        </article>
    </div>
</div>

<div class="container mx-auto px-4 py-12 max-w-3xl space-y-8">
    @foreach($page->sections as $s)
    @if($s->is_published)
    <section class="rounded-xl border p-6 bg-white text-sm">
        @if($s->title)
        <h2 class="text-lg font-semibold text-slate-800">{{ $s->title }}</h2>
        @endif
        @if($s->media_path)
        <div class="mt-4">
            @if(Str::endsWith(Str::lower($s->media_path), ['.jpg','.jpeg','.png','.webp']))
                <img src="{{ $s->media_path }}" class="rounded-lg w-full max-h-64 object-cover">
            @else
                <a class="text-emerald-600 underline text-xs break-all" href="{{ $s->media_path }}" target="_blank">Download attachment</a>
            @endif
        </div>
        @endif
        <div class="text-slate-700 mt-4 leading-relaxed">{!! $s->body !!}</div>
    </section>
    @endif
    @endforeach
</div>
@endsection
