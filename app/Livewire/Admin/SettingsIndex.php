<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class SettingsIndex extends Component
{
    public function render()
    {
        return view('admin.settings-index')
            ->layout('layouts.admin');
    }
}
