<?php

namespace Tests\Feature;

use App\Filament\Resources\ClientResource;
use App\Filament\Resources\LeadResource;
use App\Filament\Resources\RequestResource;
use App\Filament\Resources\ShipmentEventResource;
use App\Filament\Resources\ShipmentResource;
use App\Models\User;
use Database\Seeders\RolePermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilamentCompatibilityTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Server-rendering smoke test only: real bundled assets are validated
        // separately during the staging/browser acceptance.
        $this->withoutVite();
    }

    public function test_public_locale_pages_and_login_render(): void
    {
        foreach (['/ru', '/tm', '/en', '/admin/login'] as $path) {
            $this->get($path)->assertOk();
        }
    }

    public function test_admin_resource_list_and_create_pages_render(): void
    {
        $this->seed(RolePermissionSeeder::class);

        $admin = User::query()->create([
            'name' => 'Isolated CI Administrator',
            'email' => 'ci-operator@example.test',
            'password' => bcrypt('ci-only-not-a-production-password'),
        ]);
        $admin->assignRole('admin');

        $this->actingAs($admin);

        foreach ([
            ClientResource::class,
            LeadResource::class,
            RequestResource::class,
            ShipmentResource::class,
            ShipmentEventResource::class,
        ] as $resource) {
            $this->get($resource::getUrl('index'))->assertOk();
            $this->get($resource::getUrl('create'))->assertOk();
        }
    }
}
