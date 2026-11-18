<?php

namespace Tests\Feature;

use App\Models\Client;
use App\Models\ContactMessage;
use App\Models\Lead;
use App\Models\Request as CrmRequest;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class CrmAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_unprivileged_account_cannot_access_crm_resources(): void
    {
        $this->seed(RolePermissionSeeder::class);
        $guestRoleUser = $this->createUser('ordinary@example.test');

        foreach ([Client::class, Lead::class, CrmRequest::class, Shipment::class, ShipmentEvent::class, ContactMessage::class] as $model) {
            $this->assertFalse(Gate::forUser($guestRoleUser)->allows('viewAny', $model));
            $this->assertFalse(Gate::forUser($guestRoleUser)->allows('create', $model));
        }
    }

    public function test_role_permissions_are_enforced_for_crm_resources(): void
    {
        $this->seed(RolePermissionSeeder::class);
        $admin = $this->createUser('admin@example.test');
        $admin->assignRole('admin');

        $manager = $this->createUser('manager@example.test');
        $manager->assignRole('manager');

        $mapping = [
            Client::class => 'view clients',
            Lead::class => 'view leads',
            CrmRequest::class => 'view requests',
            Shipment::class => 'view shipments',
            ShipmentEvent::class => 'view shipment events',
        ];

        foreach ($mapping as $model => $permission) {
            $this->assertTrue(Gate::forUser($admin)->allows('viewAny', $model), $model);
            $this->assertTrue(Gate::forUser($manager)->allows('viewAny', $model), $model);
            $this->assertTrue(Gate::forUser($admin)->allows('create', $model), $model);
            $this->assertTrue(Gate::forUser($manager)->allows('create', $model), $model);
        }
        $this->assertTrue(Gate::forUser($manager)->allows('viewAny', ContactMessage::class));
        $this->assertFalse(Gate::forUser($manager)->allows('create', ContactMessage::class));
    }

    public function test_delete_is_denied_even_to_admin_until_separate_retention_policy(): void
    {
        $this->seed(RolePermissionSeeder::class);
        $admin = $this->createUser('admin2@example.test');
        $admin->assignRole('admin');

        $this->assertFalse(Gate::forUser($admin)->allows('delete', new Lead()));
        $this->assertFalse(Gate::forUser($admin)->allows('delete', new Shipment()));
        $this->assertFalse(Gate::forUser($admin)->allows('delete', new ContactMessage()));
    }

    private function createUser(string $email): User
    {
        return User::query()->create([
            'name' => 'Test operator',
            'email' => $email,
            'password' => bcrypt('not-a-real-password-used-only-in-memory'),
        ]);
    }
}
