<?php

namespace App\Policies;

use App\Models\Shipment;
use App\Models\User;

class ShipmentPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view shipments');
    }

    public function view(User $user, Shipment $record): bool
    {
        return $user->can('view shipments');
    }

    public function create(User $user): bool
    {
        return $user->can('manage shipments');
    }

    public function update(User $user, Shipment $record): bool
    {
        return $user->can('manage shipments');
    }

    public function delete(User $user, Shipment $record): bool
    {
        return false; // Deletion requires a separate retention policy and approval.
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, Shipment $record): bool
    {
        return false;
    }

    public function forceDelete(User $user, Shipment $record): bool
    {
        return false;
    }
}
