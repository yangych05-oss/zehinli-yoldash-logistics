<?php

namespace App\Policies;

use App\Models\Lead;
use App\Models\User;

class LeadPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view leads');
    }

    public function view(User $user, Lead $record): bool
    {
        return $user->can('view leads');
    }

    public function create(User $user): bool
    {
        return $user->can('manage leads');
    }

    public function update(User $user, Lead $record): bool
    {
        return $user->can('manage leads');
    }

    public function delete(User $user, Lead $record): bool
    {
        return false; // Deletion requires a separate retention policy and approval.
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Lead $record): bool
    {
        return false;
    }

    public function forceDelete(User $user, Lead $record): bool
    {
        return false;
    }
}
