<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Device;
use App\Models\Property;
use Carbon\Carbon;

class DeviceSeeder extends Seeder
{
    public function run(): void
    {
        $properties = Property::all();

        if ($properties->isEmpty()) {
            $this->command->warn('⚠️  No properties found. Run PropertySeeder first.');
            return;
        }

        $deviceTypes = ['prepaid', 'postpaid'];
        $brands = ['Itron', 'Sensus', 'Arad', 'Elster'];
        $statuses = ['active', 'maintenance', 'inactive'];

        foreach ($properties as $property) {
            // Each property gets 1-2 devices
            $devicesCount = rand(1, 2);
            
            for ($i = 0; $i < $devicesCount; $i++) {
                Device::create([
                    'property_id' => $property->id,
                    'device_type' => $deviceTypes[array_rand($deviceTypes)],
                    'brand' => $brands[array_rand($brands)],
                    'model' => 'Model-' . strtoupper(substr(md5(rand()), 0, 6)),
                    'serial_number' => 'SN' . strtoupper(substr(md5(rand()), 0, 12)),
                    'installation_date' => Carbon::now()->subDays(rand(30, 365)),
                    'last_maintenance_date' => Carbon::now()->subDays(rand(1, 90)),
                    'status' => $statuses[array_rand($statuses)],
                    'health_score' => rand(70, 100),
                ]);
            }
        }

        $this->command->info('✅ Devices created for all properties!');
    }
}
