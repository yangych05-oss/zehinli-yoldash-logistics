<?php

namespace App\Policies;

use App\Models\ContactMessage;
use App\Models\User;

class ContactMessagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view leads');
    }

    public function view(User $user, ContactMessage $record): bool
    {
        return $user->can('view leads');
    }

    public function create(User $user): bool
    {
        return false; // Contacts originate only from validated public intake.
    }

    public function update(User $user, ContactMessage $record): bool
    {
        return false; // Preserve originals as intake audit records.
    }

    public function delete(User $user, ContactMessage $record): bool
    {
        return false; // Retention/deletion requires a separately approved workflow.
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }
}
