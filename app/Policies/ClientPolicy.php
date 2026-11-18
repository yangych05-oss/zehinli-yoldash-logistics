<?php

namespace App\Policies;

use App\Models\Client;
use App\Models\User;

class ClientPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view clients');
    }

    public function view(User $user, Client $record): bool
    {
        return $user->can('view clients');
    }

    public function create(User $user): bool
    {
        return $user->can('manage clients');
    }

    public function update(User $user, Client $record): bool
    {
        return $user->can('manage clients');
    }

    public function delete(User $user, Client $record): bool
    {
        return false; // Deletion requires a separate retention policy and approval.
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Client $record): bool
    {
        return false;
    }

    public function forceDelete(User $user, Client $record): bool
    {
        return false;
    }
}
