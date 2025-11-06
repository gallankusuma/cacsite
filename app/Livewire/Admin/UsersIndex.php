<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class UsersIndex extends Component
{
    public function render()
    {
        return view('admin.users-index')
            ->layout('layouts.admin');
    }
}
