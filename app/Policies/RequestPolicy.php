<?php

namespace App\Policies;

use App\Models\Request;
use App\Models\User;

class RequestPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view requests');
    }

    public function view(User $user, Request $record): bool
    {
        return $user->can('view requests');
    }

    public function create(User $user): bool
    {
        return $user->can('manage requests');
    }

    public function update(User $user, Request $record): bool
    {
        return $user->can('manage requests');
    }

    public function delete(User $user, Request $record): bool
    {
        return false; // Deletion requires a separate retention policy and approval.
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Request $record): bool
    {
        return false;
    }

    public function forceDelete(User $user, Request $record): bool
    {
        return false;
    }
}
