# How to Start (Dev Quickstart)

## 1) Clone & env

## 2) Dependencies

## 3) DB & storage

## 4) Run (dev)

## 5) Build (prod)

## 6) Login admin
User `admin@cac.test` (password sesuai seeding/tinker), role `admin`.

## 7) Troubleshooting
- CSS polos → cek `@vite(...)` di layout & jalankan `npm run dev` atau `npm run build`.
- 500 di home setelah Breeze → gate `admin-only` harus null-safe (`$user = null`).
