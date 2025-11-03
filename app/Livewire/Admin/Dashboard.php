<?php
namespace App\Livewire\Admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function mount()
    {
        // kalau belum login / bukan admin -> stop
        if (!auth()->check() || !auth()->user()->can('admin-only')) {
            abort(403);
        }
    }

    public function render()
    {
        return view('livewire.admin.dashboard')
            ->layout('components.layouts.app') // atau layout admin khusus nanti
            ->title('Admin Dashboard • CAC');
    }
}
