<?php
namespace App\Policies;

use App\Models\User;

class CrudPolicy
{
    public function viewAny(User $u): bool  { return in_array($u->role, ['admin','editor','viewer']); }
    public function view(User $u): bool     { return $this->viewAny($u); }
    public function create(User $u): bool   { return in_array($u->role, ['admin','editor']); }
    public function update(User $u): bool   { return in_array($u->role, ['admin','editor']); }
    public function delete(User $u): bool   { return $u->role === 'admin'; }
}
