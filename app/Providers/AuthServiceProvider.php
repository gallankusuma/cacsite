<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // Model::class => Policy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

    // null-safe: kalau belum login, can('admin-only') = false (tidak error)
    Gate::define('admin-only', function ($user = null) {
        return $user?->role === 'admin';
    });
    }
}
