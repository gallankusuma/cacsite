<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\UsersIndex;
use App\Livewire\Admin\SettingsIndex;

// ... route publik Anda tetap di sini

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth']) // sementara bisa kosongin [] untuk test tanpa login
    ->group(function () {
        Route::get('/', Dashboard::class)->name('dashboard');
        Route::get('/users', UsersIndex::class)->name('users.index');
        Route::get('/settings', SettingsIndex::class)->name('settings.index');

        // Ping test (hapus nanti)
        Route::get('/ping', fn () => 'admin ok')->name('ping');
    });
