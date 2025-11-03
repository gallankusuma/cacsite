# CAC Site — Context Pack (v2025-11-03)

## Stack
- Laravel 11, PHP 8.2
- Livewire 3, Tailwind 3 + Vite
- Breeze (Livewire stack) untuk auth
- DB: MariaDB/MySQL

## Arsitektur
- Public pages: Home, Pages (CMS), Products, Certificates, Contact/Careers
- Admin (/admin/*): Dashboard, Pages, PageSections, Products, Categories, Certificates, Branches, SiteStats, Inquiries
- Layout: resources/views/components/layouts/app.blade.php (@vite + @livewire)


## Routes (ringkas)
- `/` -> App\Livewire\Home\Index  (layout app)
- `/products` -> ...CategoryIndex
- `/admin/*` -> protected by auth

## Konvensi Kode
- Jelaskan dulu, baru drop full code saat diminta.
- Livewire v3: satu root <div>, .layout('components.layouts.app').
- Upload -> storage/app/public, akses via asset('storage/...').

## Link permanen penting
- CONTEXT JSON: /docs/ai/context.json
- RBAC detail: /docs/ai/rbac.md
- Routes: /docs/ai/routes.md
- Skema DB: /docs/ai/db-schema.sql
## Struktur Inti
- Layout publik: `resources/views/components/layouts/app.blade.php` (memuat `@vite`, `@livewireStyles/Scripts`).
- Komponen publik: `App\Livewire\Home`, `Pages`, `Products`, `Certificates`, `Contact`.
- Panel Admin: `App\Livewire\Admin\{Dashboard,Pages,PageSections,ProductCategories,Products,Certificates,Branches,Stats,Inquiries}`.
- Upload helper: `app/Support/Uploads.php` → `storage/app/public/...` → akses via `asset('storage/...')`.
## RBAC (ringkas)
- Kolom `users.role` ∈ {`admin`,`editor`,`viewer`}.
- Gate: `admin-only` → `return $user?->role === 'admin';`
- Semua komponen **admin** wajib guard di `mount()`:
  ```php
  if (!auth()->check() || !auth()->user()->can('admin-only')) abort(403);