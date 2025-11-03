@extends('layouts.public')

@section('content')
<div class="bg-mist">
    <div class="container mx-auto px-4 py-12 max-w-xl">
        <h1 class="text-3xl font-bold text-slate-800 mb-6">Contact Us</h1>

        @if(session('ok'))
            <div class="bg-emerald-50 text-emerald-700 text-sm p-3 rounded mb-4">{{ session('ok') }}</div>
        @endif

        <form wire:submit.prevent="submit" class="space-y-4 text-sm">
            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Name *</label>
                <input class="ap-input" type="text" wire:model="name">
                @error('name')<div class="ap-err">{{ $message }}</div>@enderror
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Email *</label>
                <input class="ap-input" type="email" wire:model="email">
                @error('email')<div class="ap-err">{{ $message }}</div>@enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Phone</label>
                    <input class="ap-input" type="text" wire:model="phone">
                </div>
                <div>
                    <label class="text-xs font-medium text-slate-700 block mb-1">Subject</label>
                    <input class="ap-input" type="text" wire:model="subject">
                </div>
            </div>

            <div>
                <label class="text-xs font-medium text-slate-700 block mb-1">Message *</label>
                <textarea class="ap-input" rows="4" wire:model="message"></textarea>
                @error('message')<div class="ap-err">{{ $message }}</div>@enderror
            </div>

            <button class="ap-btn-primary font-semibold w-full text-center">
                Send Message
            </button>
        </form>
    </div>
</div>
@endsection
