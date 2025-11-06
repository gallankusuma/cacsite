<?php

return [
    // Simple section-less menu. Tambah/ubah sesuai kebutuhan.
    [
        'label' => 'Dashboard',
        'icon'  => 'home',
        'route' => 'admin.dashboard',
        // Opsional: daftar pola aktif tambahan
        'active'=> ['admin.dashboard'],
    ],
    [
        'label' => 'Users',
        'icon'  => 'users',
        'route' => 'admin.users.index',
        'active'=> ['admin.users.*'],
    ],
    [
        'label' => 'Settings',
        'icon'  => 'cog',
        'route' => 'admin.settings.index',
        'active'=> ['admin.settings.*'],
    ],
];
