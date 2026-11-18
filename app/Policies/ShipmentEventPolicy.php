<?php

namespace App\Policies;

use App\Models\ShipmentEvent;
use App\Models\User;

class ShipmentEventPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view shipment events');
    }

    public function view(User $user, ShipmentEvent $record): bool
    {
        return $user->can('view shipment events');
    }

    public function create(User $user): bool
    {
        return $user->can('manage shipment events');
    }

    public function update(User $user, ShipmentEvent $record): bool
    {
        return $user->can('manage shipment events');
    }

    public function delete(User $user, ShipmentEvent $record): bool
    {
        return false; // Deletion requires a separate retention policy and approval.
    }

    public function deleteAny(User $user): bool
    {
        return false;
    }

    public function restore(User $user, ShipmentEvent $record): bool
    {
        return false;
    }

    public function forceDelete(User $user, ShipmentEvent $record): bool
    {
        return false;
    }
}
