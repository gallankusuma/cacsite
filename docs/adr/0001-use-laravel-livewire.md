# ADR 0001 — Use Laravel + Livewire

## Status
Accepted

## Context
SPA penuh tidak dibutuhkan; SSR + interaktivitas ringan cukup. Tim nyaman di ekosistem Laravel.

## Decision
Gunakan Laravel 11 + Livewire 3 + Tailwind + Vite.

## Consequences
+ Cepat membangun
+ SEO baik (SSR)
- Untuk interaksi sangat kompleks, mungkin perlu Alpine/Stimulus tambahan
