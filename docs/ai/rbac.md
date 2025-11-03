# RBAC

## Roles
- **admin**: full CRUD seluruh modul admin.
- **editor**: edit konten (tanpa delete/critical ops). (WIP)
- **viewer**: read-only. (WIP)

## Gate
```php
Gate::define('admin-only', fn($user = null) => $user?->role === 'admin');
