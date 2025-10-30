<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\Customer;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $customers = Customer::all();

        if ($customers->isEmpty()) {
            $this->command->warn('⚠️  No customers found. Run CustomerSeeder first.');
            return;
        }

        $propertyTypes = ['residential', 'commercial', 'industrial', 'government'];
        $cities = [
            ['city' => 'Jakarta', 'province' => 'DKI Jakarta'],
            ['city' => 'Bandung', 'province' => 'Jawa Barat'],
            ['city' => 'Surabaya', 'province' => 'Jawa Timur'],
            ['city' => 'Semarang', 'province' => 'Jawa Tengah'],
            ['city' => 'Medan', 'province' => 'Sumatera Utara'],
        ];

        foreach ($customers as $customer) {
            // Each customer gets 1-2 properties
            $propertiesCount = rand(1, 2);
            
            for ($i = 0; $i < $propertiesCount; $i++) {
                $cityData = $cities[array_rand($cities)];
                Property::create([
                    'customer_id' => $customer->id,
                    'property_name' => $customer->full_name . ' Property ' . ($i + 1),
                    'property_type' => $propertyTypes[array_rand($propertyTypes)],
                    'address' => 'Jl. Property Street No. ' . rand(1, 200),
                    'city' => $cityData['city'],
                    'province' => $cityData['province'],
                    'postal_code' => (string)rand(10000, 99999),
                    'latitude' => (string)(-6.2 + (rand(-1000, 1000) / 1000)),
                    'longitude' => (string)(106.8 + (rand(-1000, 1000) / 1000)),
                    'area_size' => rand(50, 500),
                    'occupants' => rand(1, 10),
                    'status' => 'active',
                ]);
            }
        }

        $this->command->info('✅ Properties created for all customers!');
    }
}
