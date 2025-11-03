<?php

namespace App\Livewire\Certificates;

use Livewire\Component;
use App\Models\Certificate;

class Index extends Component
{
    public function render()
    {
        // cuma ambil sertifikat yang published
        $certs = Certificate::where('is_published', true)
            ->orderByDesc('issue_date')
            ->orderByDesc('id')
            ->get();

        return view('livewire.certificates.index', [
            'certs' => $certs,
        ])->title('Certificates • CAC');
    }
}
