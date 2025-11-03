@extends('layouts.public')

@section('content')
<div class="container mx-auto px-4 py-12 max-w-3xl">
    <h1 class="text-3xl font-bold text-slate-800 mb-6">Certificates</h1>

    @if($certs->count() === 0)
        <div class="text-slate-500 text-sm">No certificates published yet.</div>
    @else
        <div class="space-y-4 text-sm">
            @foreach($certs as $c)
                <div class="border rounded-xl p-4 bg-white flex flex-col gap-2">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <div>
                            <div class="font-semibold text-slate-800">{{ $c->title }}</div>
                            <div class="text-[11px] text-slate-500">
                                {{ $c->issuer }} 
                                @if($c->issue_date)
                                    • {{ $c->issue_date }}
                                @endif
                            </div>
                        </div>
                        <div class="text-[10px] px-2 py-0.5 rounded-full {{ $c->is_published ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-200 text-slate-600' }}">
                            {{ $c->is_published ? 'Published' : 'Hidden' }}
                        </div>
                    </div>

                   @if($c->file_path)
    @php
        use Illuminate\Support\Str;
        $isImage = Str::endsWith(Str::lower($c->file_path), ['.jpg','.jpeg','.png','.webp']);
    @endphp

    @if($isImage)
        <img
            src="{{ $c->file_path }}"
            alt="certificate"
            class="rounded-lg bg-slate-100 max-h-60 w-full object-contain border"
        >
    @else
        <a class="text-emerald-600 text-xs underline break-words"
           href="{{ $c->file_path }}"
           target="_blank">
            View / Download certificate
        </a>
    @endif
@endif

                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
