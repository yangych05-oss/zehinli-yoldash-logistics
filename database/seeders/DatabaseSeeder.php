<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Lead;
use App\Models\Request as CrmRequest;
use App\Models\Shipment;
use App\Models\ShipmentEvent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RolePermissionSeeder::class,
            AdminUserSeeder::class,
        ]);

        $client = Client::query()->updateOrCreate([
            'email' => 'client@example.com',
        ], [
            'name' => 'Demo Client',
            'company' => 'Demo Import LLC',
            'phone' => '+99361234567',
            'address' => 'Ashgabat',
            'status' => 'active',
        ]);

        Lead::query()->updateOrCreate([
            'email' => 'lead@example.com',
        ], [
            'name' => 'Potential Customer',
            'company' => 'Trade Group',
            'phone' => '+99369876543',
            'origin' => 'Istanbul',
            'destination' => 'Ashgabat',
            'cargo_details' => 'Electronics, 4 pallets',
            'status' => 'new',
            'locale' => 'en',
        ]);

        CrmRequest::query()->updateOrCreate([
            'subject' => 'Ocean freight quote request',
        ], [
            'client_id' => $client->id,
            'type' => 'quote',
            'status' => 'new',
            'details' => 'Need 40ft container pricing from Mersin to Turkmenbashi.',
        ]);

        $shipment = Shipment::query()->updateOrCreate([
            'tracking_code' => 'ZYL-2026-0001',
        ], [
            'tracking_number' => 'ZYL-2026-0001',
            'public_access_code' => 'PUBLIC-1234',
            'client_id' => $client->id,
            'origin' => 'Istanbul',
            'destination' => 'Ashgabat',
            'status' => 'in_transit',
            'current_location' => 'Baku',
            'details' => 'Expected delivery in 2 days.',
        ]);

        ShipmentEvent::query()->updateOrCreate([
            'shipment_id' => $shipment->id,
            'status' => 'Departed origin',
        ], [
            'location' => 'Istanbul',
            'description' => 'Truck departed from origin warehouse.',
            'event_time' => now()->subDays(2),
        ]);
    }
}
