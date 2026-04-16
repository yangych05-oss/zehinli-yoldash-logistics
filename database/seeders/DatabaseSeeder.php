<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $admin = User::query()->updateOrCreate(
            ['email' => 'admin@zehinliyoldash.com'],
            ['name' => 'System Admin', 'password' => Hash::make('password')]
        );
        $admin->assignRole('admin');

        $client = Client::query()->create([
            'name' => 'Demo Client',
            'company' => 'Demo Import LLC',
            'email' => 'client@example.com',
            'phone' => '+99361234567',
            'address' => 'Ashgabat',
            'status' => 'active',
        ]);

        Lead::query()->create([
            'name' => 'Potential Customer',
            'company' => 'Trade Group',
            'email' => 'lead@example.com',
            'phone' => '+99369876543',
            'origin' => 'Istanbul',
            'destination' => 'Ashgabat',
            'cargo_details' => 'Electronics, 4 pallets',
            'status' => 'new',
            'locale' => 'en',
        ]);

        Shipment::query()->create([
            'tracking_number' => 'ZYL-2026-0001',
            'client_id' => $client->id,
            'origin' => 'Istanbul',
            'destination' => 'Ashgabat',
            'status' => 'in_transit',
            'current_location' => 'Baku',
            'details' => 'Expected delivery in 2 days.',
        ]);
    }
}
