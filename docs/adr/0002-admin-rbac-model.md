# ADR 0002 — Admin RBAC Model

## Status
Accepted

## Context
Panel admin harus private dan aman, dengan peran berbeda.

## Decision
`users.role` ∈ {admin, editor, viewer}. Gate `admin-only`. Policy granular opsional.

## Consequences
+ Implementasi cepat & jelas
+ Mudah diperluas nanti ke permission matrix
