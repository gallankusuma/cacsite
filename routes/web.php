<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\UsersIndex;
use App\Livewire\Admin\SettingsIndex;

// ... route publik Anda tetap di sini

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth']) // tambahkan 'verified' jika Anda pakai verifikasi email
    ->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');

        // Contoh halaman lain (untuk demonstrasi menu aktif)
        Route::get('/users', UsersIndex::class)->name('users.index');
        Route::get('/settings', SettingsIndex::class)->name('settings.index');
    });
